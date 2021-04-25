<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$url = base_url().'checkout';
echo form_open($url,'id=summary');
//debugMe($userPaymentDetails);
?>
<div class="container">
    <div class="py-5 text-center">
        <h2><?php echo $pageTitle;?></h2>
        <hr class="mb-4">
    </div>

    <div class="row">
        <div class="col-md-5 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill"><?php echo $cartTotalItems; ?></span>
            </h4>
            <ul class="list-group mb-3">

                <?php
                foreach($cartProducts['items'] as $product):
                    ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo ucwords($product['title']); ?></h6>
                            <small class="text-muted">Quantity : <?php echo $product['subTotal'] / $product['price']; ?></small>
                        </div>
                        <span class="text-muted"><?php echo "₹ " .$product['subTotal']; ?></span>
                    </li>

                <?php endforeach ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-success">Total (INR)</span>
                    <strong class="text-success"><?php echo "₹ " .$cartTotal; ?></strong>
                </li>
            </ul>
        </div>
        <div class="col-md-7 order-md-1 ">
            <h4 class="mb-3">Billing address</h4>
            <section class="needs-validation form-body " novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name :</label>
                        <b><span><?php echo $userPersonalDetail['firstName']; ?></span></b>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name :</label>
                        <b><span><?php echo $userPersonalDetail['lastName']; ?></span></b>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email :</label>
                    <b><span><?php echo $userPersonalDetail['email']; ?></span></b>
                </div>

                <div class="mb-3">
                    <label for="address" >Address :</label>
                    <b><span><?php echo $userPersonalDetail['address']; ?></span></b>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Payment Details</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="cc-name" class="required">Card Type</label>
                        <b><span><?php echo $userPaymentDetails['paymentMethod']; ?></span></b>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="cc-name" class="required">Name on card</label>
                        <b><span><?php echo $userPaymentDetails['cardName']; ?></span></b>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="cc-number" class="required">Credit card number</label>
                        <b><span><?php echo $userPaymentDetails['cardCcNumber']; ?></span></b>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="cc-expiration" class="required">Expiration</label>
                        <b><span><?php /*echo $userPaymentDetails['cardExpiry']; */?></span></b>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="cc-cvv" class="required">CVV</label>
                        <b><span><?php /*echo $userPaymentDetails['cardCvvNumber']; */?></span></b>
                    </div>
                </div>-->
                <hr class="mb-4">
            </section>
        </div>
    </div>
</div>