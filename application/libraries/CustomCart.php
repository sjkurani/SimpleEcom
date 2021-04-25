<?php
class CustomCart {

    /**
     * Contents of the cart
     *
     * @var array
     */
    protected $cart = array();

    protected  $cartTotal;
    protected  $totalItems;
    protected  $items;
    protected $existingProducts;

    public function __construct()
    {
        // Set the super object to a local variable for use later
        $this->CI =& get_instance();

        // Load the Sessions class
        $this->CI->load->library('session');

        $existingSessionData = $this->CI->session->userdata('cartItems');
        $this->updateCart($existingSessionData);
    }

    public function getCartTotal() {
        return $this->cartTotal;
    }

    public function setCartTotal($total) {
        $this->cartTotal = $total;
    }

    public function getTotalItems() {
        return $this->totalItems;
    }

    public function setTotalItems($totalItems) {
        $this->totalItems = $totalItems;
    }

    public function getItems() {
        return $this->items;
    }

    public function getExistingProducts() {
        return $this->existingProducts;
    }

    public function setExistingProducts($existingProducts) {
        $this->existingProducts = $existingProducts;
    }


    public function setItems($item) {
        $sessionData = $this->CI->session->userdata('cartItems');
        if (empty($sessionData) || $sessionData === NULL)
        {
            $items['items'] = $item;
        }
        else {
            $items['items'] = array_merge($sessionData['items'], $item);
        }

        $this->items = $items;

        $this->updateCart($this->items);
    }

    public function removeItem($productId) {
        $itemsArray = $this->cart['items'];
        $updatedItemsArray = array();
        if(!empty($itemsArray)) {
            foreach ($itemsArray as $item) {
                if($item['id'] != $productId) {
                    $updatedItemsArray['items'][] = $item;
                }
            }
            $this->updateCart($updatedItemsArray);
            return 1;
        } else {
            return 0;
        }
    }

    public  function getCart() {
        return $this->cart;
    }

    public function updateCart($items) {
        $cartTotal = $totalItems =  0;
        $existingProducts = array();
        if(!empty($items)) {
            foreach ($items['items'] as $item) {
                $totalItems++;
                $cartTotal += $item['subTotal'];
                $existingProducts[] = $item['id'];
            }
        }
        $this->existingProducts = $existingProducts;
        $this->cart['items'] = !empty($items['items']) ? $items['items'] : array();
        $this->cart['cartTotal'] = $cartTotal;
        $this->cart['totalItems'] = $totalItems;
        $this->setCartTotal($cartTotal);
        $this->setTotalItems($totalItems);
        $this->CI->session->set_userdata(array('cartItems' => $this->cart));
    }

    public function destroy()
    {
//        $this->cartItems = array('cart_total' => 0, 'total_items' => 0);
        $this->CI->session->unset_userdata('cartItems');
    }
}