<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('customCart');
        $this->load->model('products_model');
    }

    function index()
    {
        redirect(base_url(), 'refresh');
    }

    function addToCart() {
        if($this->input->is_ajax_request()) {
            $productId = (int)$this->input->post('productId');
            $quantity = (int)$this->input->post('quantity');
            $cartArray = $this->prepareCartArray($productId, $quantity);
            if(!empty($cartArray) && !$cartArray['error']) {

                $this->customcart->setItems(array($cartArray['data']));

                $jsonResponse = array(
                    'status' => 1,
                    'msg' => 'Product added to Cart',
                    'cartTotalCount' => $this->customcart->getTotalItems(),
                );
            }
            else if(!empty($cartArray) && $cartArray['error']) {
                $jsonResponse = array(
                    'status' => 0,
                    'msg' => $cartArray['msg']
                );
            }
            echo json_encode($jsonResponse);
        } else {
            redirect(base_url(), "refresh");
        }
    }

    function removeFromCart() {
        if($this->input->is_ajax_request()) {
            $productId = 1;//(int)$this->input->post('productId');
            $isRemoved = $this->customcart->removeItem($productId);
            if($isRemoved) {
                $jsonResponse = array(
                    'status' => 1,
                    'msg' => 'Product Removed',
                        'cartTotalCount' => $this->customcart->getTotalItems(),
                );
                echo json_encode($jsonResponse);
            }
        } else {
            redirect(base_url(), "refresh");
        }
    }

    function prepareCartArray($productId, $quantity) {
        if(!empty($quantity) && is_integer($quantity)) {
            $productDetails = $this->products_model->getProduct($productId);
            if(!empty($productDetails)) {
                $cartArray = array_merge($productDetails, array('subTotal' => $productDetails['price'] * $quantity));
                $cartArray = array_merge($cartArray, array('quantity' => $quantity));
                $returnArray = array('error' => false, 'data' => $cartArray);
            }
            else {
                $returnArray = array('error' => true, 'msg' => 'No Product Data.');
            }
        }
        else {
            $returnArray = array('error' => true, 'msg' => 'Invalid data.');
        }
        return $returnArray;
    }

    //New classes starts here.
    function otpDetail()
    {
        if (1 || $this->input->is_ajax_request()) {
            $mobileNumber = $this->input->post('mobileNumber');
            if (!empty($mobileNumber)) {
                $otp = mt_rand(100000, 999999);
                $otpDetailArray = array(
                    'otp' => $otp,
                    'mobile' => $mobileNumber,
                );
                $isOTPInserted = $this->save_update_model->save_update_otp_details($otpDetailArray, $mobileNumber);

                if ($isOTPInserted === true) { // send otp message only if mobile number not registered with us.
                    echo json_encode(
                        array(
                            'status' => 2,
                        )
                    );
                } else if ($isOTPInserted === false) {
                    echo json_encode(
                        array(
                            'status' => 3,
                        )
                    );
                } else { //inserted.
                    $message = "Use OTP " . $otp . " To register to LIMPO. Thank you";
//                    $isMessageSent = sendOTP($otp, $message);
                    echo json_encode(
                        array(
                            'status' => 1,
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        'status' => 0,
                    )
                );
            }
        } else {
            redirect(base_url(), "refresh");
        }
    }
}