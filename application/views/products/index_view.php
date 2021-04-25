<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--<div class="alert alert-primary" role="alert">
    This is a primary alert—check it out!
</div>-->
<div class="container">
    <div class="py-5 text-center">
        <h2><?php echo $pageTitle;?></h2>
        <hr class="mb-4">
    </div>

    <div class="row">
        <div class="container pb-5 mb-2">
            <?php
                foreach($products as $product):
                    $quantityVal = 1;
//                debugMe(array_keys($productsWithQuantity),1);
                    if(in_array($product['id'], array_keys($productsWithQuantity))) {
                        $quantityVal = $productsWithQuantity[$product['id']];
                    }
                    ?>
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
                    <div class="px-3 my-3 text-center top-pad cart-row">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                      <span class="fa fa-minus"></span>
                                    </button>
                                </span>
                            <input type="text" name="quantity" disabled="disabled" class="quantity form-control input-number" value="<?php echo $quantityVal;?>" min="1" max="5">
                            <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                        <span class="fa fa-plus"></span>
                                    </button>
                            </span>
                        </div>
                        <br>
                        <?php
                        if(!in_array($product['id'], $existingProductsInCart)){
                        ?>

                        <button type="button" data-id="<?php echo $product['id'] - 1;?> " id="<?php echo $product['id'] - 1;?> " class="addToCartBtn btn btn-info">
                            <span class="fa fa-shopping-cart">  Add To Cart</span>
                        </button>
                        <button type="button" hidden="hidden"  data-id="<?php echo $product['id'] - 1;?> " id="<?php echo $product['id'] - 1;?> " class="removeCartBtn btn btn-danger">
                            <span class="fa fa-shopping-cart">  Remove From Cart</span>
                        </button>
                        <?php
                        } else {
                        ?>
                        <button type="button" hidden="hidden" data-id="<?php echo $product['id'] - 1;?> " id="<?php echo $product['id'] - 1;?> " class="addToCartBtn btn btn-info ">
                            <span class="fa fa-shopping-cart">  Add To Cart</span>
                        </button>
                        <button type="button" data-id="<?php echo $product['id'] - 1;?> " id="<?php echo $product['id'] - 1;?> " class="removeCartBtn btn btn-danger">
                            <span class="fa fa-shopping-cart">  Remove From Cart</span>
                        </button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>