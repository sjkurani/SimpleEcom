<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$url = base_url().'checkout';
echo form_open($url,'id=checkout');

$address = (isset($address)) ? $address : ($sessionData['address'] ?  $sessionData['address'] : '');
//debugMe($sessionData,1);
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

                    <span class="text-success"><?php echo ($cartTotalItems > 0) ? 'Total (INR)' : "Your cart is empty."  ?></span>
                    <strong class="text-success">
                    <?php echo ($cartTotalItems > 0) ? "₹ " .$cartTotal : "<a href=".base_url()." class='btn btn-warning'>Add Products</a>";  ?>
                    </strong>
                </li>
            </ul>
        </div>
        <div class="col-md-7 order-md-1 ">
            <h4 class="mb-3">Billing address</h4>
            <section class="needs-validation form-body " novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName" class="required">First name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="<?php echo set_value('firstName', isset($sessionData['firstName']) ? $sessionData['firstName'] : '') ?>" required_later>
                        <span class="form-error"><?php echo form_error('firstName'); ?></span>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName" class="required">Last name</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="<?php echo set_value('lastName', isset($sessionData['lastName']) ? $sessionData['lastName'] : '') ?>" required_later>
                        <span class="form-error"><?php echo form_error('lastName'); ?></span>
                        <div class="invalid-feedback">Valid last name is required.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="<?php echo set_value('email', isset($sessionData['email']) ? $sessionData['email'] : '') ?>">
                    <span class="form-error"><?php echo form_error('email'); ?></span>
                    <div class="invalid-feedback">Please enter a valid email address for shipping updates.</div>
                </div>

                <div class="mb-3">
                    <label for="address" class="required">Address</label>
                    <textarea class="form-control" name="address" id="address" placeholder="1234 Main St" required_later><?php if(isset($address)) echo $address;?></textarea>
                    <span class="form-error"><?php echo form_error('address'); ?></span>
                    <div class="invalid-feedback">Please enter your shipping address.</div>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" value="credit" type="radio" class="custom-control-input" checked required_later>
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" value="debit" type="radio" class="custom-control-input" required_later>
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <span class="form-error"><?php echo form_error('paymentMethod'); ?></span>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name" class="required">Name on card</label>
                        <input type="text" class="form-control" name="cardName" value="<?php echo set_value('cardName', isset($sessionData['cardName']) ? $sessionData['cardName'] : '') ?>" id="cc-name" placeholder="" required_later>
                        <small class="text-muted">Full name as displayed on card</small>
                        <span class="form-error"><?php echo form_error('cardName'); ?></span>
                        <div class="invalid-feedback">Name on card is required</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number" class="required">Credit card number</label>
                        <input type="text" class="form-control" name="cardCcNumber" value="<?php echo set_value('cardCcNumber', isset($sessionData['cardCcNumber']) ? $sessionData['cardCcNumber'] : '') ?>" id="cc-number" placeholder="" required_later>
                        <span class="form-error"><?php echo form_error('cardCcNumber'); ?></span>
                        <div class="invalid-feedback">Credit card number is required</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration" class="required">Expiration</label>
                        <input type="text" class="form-control" name="cardExpiry" value="<?php echo set_value('cardExpiry', isset($sessionData['cardExpiry']) ? $sessionData['cardExpiry'] : '') ?>" id="cc-expiration" placeholder="MM/YY" required_later>
                        <span class="form-error"><?php echo form_error('cardExpiry'); ?></span>
                        <div class="invalid-feedback">Expiration date required</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv" class="required">CVV</label>
                        <input type="text" class="form-control" name="cardCvNumber" value="<?php echo set_value('cardCvNumber', isset($sessionData['cardCvNumber']) ? $sessionData['cardCvNumber'] : '') ?>" id="cc-cvv" placeholder="123" required_later>
                        <span class="form-error"><?php echo form_error('cardCvNumber'); ?>
                        <div class="invalid-feedback">Security code required</div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-success btn-lg btn-block" type="submit">Place Order</button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?php echo base_url();?>" class='btn btn-warning'>Go Back</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>