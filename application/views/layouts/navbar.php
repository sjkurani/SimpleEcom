<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url();?>">Wrench</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav w-100">
            <li class="nav-item ml-auto">
                <a class="nav-item nav-link" href="<?php echo base_url()."products";?>">Products</a>
            </li>
            <li class="nav-item ml-auto">
                <a class="nav-item nav-link" href="<?php echo base_url()."checkout";?>">Checkout</a>
            </li>
            <li class="nav-item ml-auto">
                <a class="nav-item nav-link " href="<?php echo base_url()."checkout/summary";?>">Summary</a>
            </li>
            <li class="nav-item ml-auto">
                <a class="nav-item nav-link " href="<?php echo base_url()."cart";?>">Cart &nbsp
                    <span class='badge badge-warning' id='lblCartCount'> <?php echo getCartItemCount();?> </span> </a>
            </li>
        </ul>
    </div>
</nav>

<?php
if($this->session->flashdata('msg')){
    echo ' <div class="alert alert-success row text-center">';
    echo $this->session->flashdata('msg');
    echo '</div>';
}
if($this->session->flashdata('errorMsg')){
    echo ' <div class="alert alert-danger row text-center">';
    echo $this->session->flashdata('errorMsg');
    echo '</div>';

}
?>