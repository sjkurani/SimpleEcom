// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(document).ready(function(){
    $('.addToCartBtn').click(function () {
        $(this).attr('hidden', true);
        $(this).siblings('.removeCartBtn').attr('hidden', false);
        var cartQuantity = $(this).siblings('.input-group').children('.quantity').val();
        if(cartQuantity > 0) {
            $.ajax({
                method: "POST",
                url: base_url+"ajax/addToCart",
                data: {'productId' : $(this).attr('id'), 'quantity' : cartQuantity},
                success: function(data){
                    var data = $.parseJSON(data);
                    $("#lblCartCount").text(data.cartTotalCount);
                    alert(data.msg);
                }
            });

        }
    });
    $('.removeCartBtn').click(function () {
        $(this).attr('hidden', true);
        $(this).siblings('.addToCartBtn').attr('hidden', false);
        var productId = $(this).attr("data-id");

        $.ajax({
            method: "POST",
            url: base_url+"ajax/removeFromCart",
            data: {'productId' : productId + 1},
            success: function(data){
                var data = $.parseJSON(data);
                $("#lblCartCount").text(data.cartTotalCount);
                alert(data.msg);
            }
        });
    });

    $('.remove-item').click(function () {
        var cartItem = $(this).parent('.cart-item');
        cartItem.removeClass('d-md-flex');
        cartItem.hide();
    });

    $('.quantity-right-plus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($(this).parent().siblings('.quantity').val());

        // If is not undefined

        $(this).parent().siblings('.quantity').val(quantity + 1);


        // Increment

    });

    $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($(this).parent().siblings('.quantity').val());

        // If is not undefined
        // Increment
        if(quantity > 1){
            $(this).parent().siblings('.quantity').val(quantity - 1);
        }
    });

});