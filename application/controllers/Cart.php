<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        LoadCssAndJs($this->layouts);
        $this->load->library('customCart');
    }

    function index()
    {
        $sessionData = $this->session->userdata('cartItems');
        $this->layouts->set_title('Wrench');
        $this->layouts->set_description('Customer Journey');
        $data = array();
        $data['pageTitle'] = "My Cart";
        $data['products'] = $this->customcart->getCart();

        $this->form_validation->set_rules('quantity', ' quantity', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->layouts->view('cart/index_view.php', array(), $data, TRUE);
        }
        else {
//            debugMe($this->input->post(),1);
            $this->layouts->view('cart/index_view.php', array(), $data, TRUE);
        }
    }
}