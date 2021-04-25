<?php

function LoadCssAndJs($layoutsObj) {
    $layoutsObj->add_includes('assets/js/jquey-3.6.js')
        ->add_includes('assets/js/custom.js')
        ->add_includes('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css',false)
        ->add_includes('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',false)
        ->add_includes('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js',false)
        ->add_includes('//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',false)
        ->add_includes('assets/css/custom.css');
}

function asset_url(){
    return base_url().'assets/';
}


function getCartItemCount() {
    $CI = & get_instance();
    $cartItems = $CI->session->userdata('cartItems');
    $count = 0;
    if(!empty($cartItems) && !empty($cartItems['totalItems'])) {
        $count = $cartItems['totalItems'];
    }
    return $count;
}

function debugMe($val, $exit = false) {
    echo "<pre>";
    print_r($val);
    if($exit) {
        exit();
    }
}
