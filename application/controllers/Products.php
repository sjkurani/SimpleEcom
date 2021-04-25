<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        LoadCssAndJs($this->layouts);
        $this->load->library('customCart');

        $this->load->model('products_model');
    }

    function index()
    {
        $this->layouts->set_title('Wrench');
        $this->layouts->set_description('Customer Journey');
        $data = array();
        $data['pageTitle'] = "List Of Products";
        $data['products'] = $this->products_model->getProducts();
        $data['existingProductsInCart'] = $this->customcart->getExistingProducts();
        $cartDetails = $this->customcart->getCart();
        $productsWithQuantityArray = array();
        foreach ($cartDetails['items'] as $item) {
            $productsWithQuantityArray[$item['id']] = $item['quantity'];
        }
        $data['productsWithQuantity'] = $productsWithQuantityArray;
//        debugMe($data,1);


        $this->layouts->view('products/index_view.php', array(), $data, TRUE);
    }
}