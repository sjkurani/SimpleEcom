<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$actionUrl = base_url().'cart/index';
echo form_open($actionUrl,'id=cart' );
?>

<div class="container">
    <div class="py-5 text-center">
        <h2><?php echo $pageTitle;?></h2>
        <hr class="mb-4">
    </div>
    <div class="row">
        <div class="container pb-5 mb-2">
            <?php
//            debugMe($products,1);
            if(empty($products['items'])) {
                echo " No Products Found, <a href=".base_url()." class='text-center'> Add Products</a>";
            }
            foreach($products['items'] as $product):?>
                <div class="cart-item d-md-flex justify-content-between">
                    <div class="px-3 my-3">
                        <a class="cart-item-product" href="#">
                            <div class="cart-item-product-thumb"><img src="<?php echo $product['imageUrl']; ?>" alt="<?php echo $product['title']; ?>"></div>
                            <div class="cart-item-product-info">
                                <h4 class="cart-item-product-title"><?php echo $product['title']; ?></h4>
                                <span><?php echo $product['shortDescription']; ?></span>
                            </div>
                        </a>
                    </div>
                    <div class="px-3 my-3 text-center top-pad">
                        <div class="cart-item-label">Price</div>
                        <div class="count-input">
                            <span><?php echo "₹ " .$product['price']; ?></span>
                        </div>
                    </div>
                    <div class="px-3 my-3 text-center top-pad">
                        <div class="cart-item-label">Subtotal</div><span class="text-xl font-weight-medium">
                            <span><?php echo "₹ " .$product['subTotal']; ?></span>
                    </div>
                    <div class="px-3 my-3 text-center top-pad">
                        <div class="cart-item-label">Quantity</div><span class="text-xl font-weight-medium">
                            <span><?php echo $product['quantity']; ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php
echo form_close();
?>