<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        LoadCssAndJs($this->layouts);
        $this->load->library('customCart');
        $this->load->library('encryption');
    }

    function index()
    {
        $this->layouts->set_title('Wrench');
        $this->layouts->set_description('Customer Journey');
        $data = array();
        $data['pageTitle'] = "Checkout Page";
        $data['cartProducts'] = $this->customcart->getCart();
        $data['cartTotal'] = $this->customcart->getCartTotal();
        $data['cartTotalItems'] = $this->customcart->getTotalItems();
        $data['sessionData'] = array();
        $sessionData = $this->session->userdata('userDetails');
        if(!empty($sessionData)) {
            $paymentString = $this->encryption->decrypt($sessionData['payment']);
            $userPaymentDetails = json_decode($paymentString, true);
            $data['sessionData'] = array_merge($sessionData['personal'], $userPaymentDetails);
        }

        $data['address'] = ($this->input->post('address')) ? $this->input->post('address') : '';
        $this->_index_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->layouts->view('checkout/index_view.php', array(), $data, TRUE);
        } else {
            // save to session and then redirect to summary page.
//            debugMe($this->input->post(),1);


            $paymentDetails = array(
                'paymentMethod' => $this->input->post('paymentMethod'),
                'cardName' => $this->input->post('cardName'),
                'cardCcNumber' => $this->input->post('cardCcNumber'),
                'cardExpiry' => $this->input->post('cardCvNumber'),
            );

            $plain_text = json_encode($paymentDetails);
            $ciphertext = $this->encryption->encrypt($plain_text);
            $userData = array(
                'personal'  => array(
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                ),
                'payment'   => $ciphertext,
            );

            $this->session->unset_userdata('userDetails');
            $this->session->set_userdata(array('userDetails' => $userData));
            redirect(base_url().'checkout/summary','refresh');

        }
    }


    function _isAllowedToAccessSummaryPage() {

        $totalItems = $this->customcart->getTotalItems();
        $userDetails = $this->session->userdata('userDetails');

        if( !empty($totalItems) && !empty($userDetails)) {
            return true;
        }
        else {
            $this->session->set_flashdata('errorMsg', "Personal Details or cart items are not present.");
            redirect(base_url());
        }
    }

    function summary() {
        $this->_isAllowedToAccessSummaryPage();

        $this->layouts->set_title('Wrench');
        $this->layouts->set_description('Customer Journey');
        $data = array();
        $data['pageTitle'] = "Summary Page";

        $userDetails = $this->session->userdata('userDetails');
        $paymentString = $this->encryption->decrypt($userDetails['payment']);

        $data['cartProducts'] = $this->customcart->getCart();
        $data['cartTotal'] = $this->customcart->getCartTotal();
        $data['cartTotalItems'] = $this->customcart->getTotalItems();
        $data['userPaymentDetails'] = json_decode($paymentString,true);
        $data['userPersonalDetail'] = $userDetails['personal'];

//        debugMe($data,1);
        $data['address'] = $this->input->post('address');
        $this->_index_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->layouts->view('checkout/summary_view.php', array(), $data, TRUE);
        } else {
            // save to session and then redirect to summary page.

//        debugMe($post,1);
            $this->layouts->view('checkout/summary_view.php', array(), $data, TRUE);
        }
    }

    function _index_rules(){
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('paymentMethod', 'Payment Method', 'trim|required');

        $this->form_validation->set_rules('cardName', 'Name on card', 'trim|required');
        $this->form_validation->set_rules('cardCcNumber', 'Credit card number', 'trim|required|exact_length[16]');
        $this->form_validation->set_rules('cardExpiry', 'Expiration', 'trim|required');
        $this->form_validation->set_rules('cardCvNumber', 'CVV', 'trim|required|exact_length[3]');
    }
}