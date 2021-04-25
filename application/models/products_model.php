<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class products_model extends CI_Model
{
    private $productsArray = array();

    function __construct()
    {
        parent::__construct();
        $this->productsArray = $this->setProducts();
    }

    function getProduct($productId) {
        return $this->productsArray[$productId];
    }
    function getProducts() {
        return $this->productsArray;
    }

    function setProducts() {
        /*$this->db->select('*');
        $this->db->from('products');
        $query = $this->db->get();*/
        $productArray = array(
            array(
                'id'    => 1,
                'title' => 'Product 1 Title',
                'shortDescription' => 'Short Description 1 - 128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display',
                'imageUrl'  => 'https://i.imgur.com/5Aqgz7o.jpg',
                'price' => 10000,

            ),
            array(
                'id'    => 2,
                'title' => 'Product 2 Title',
                'shortDescription' => 'Short Description 2 - 128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display',
                'imageUrl'  => 'https://i.imgur.com/Aj0L4Wa.jpg',
                'price' => 20000,

            ),
            array(
                'id'    => 3,
                'title' => 'Product 3 Title',
                'shortDescription' => 'Short Description 3 - 128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display',
                'imageUrl'  => 'https://i.imgur.com/Aj0L4Wa.jpg',
                'price' => 30000,

            ),
            array(
                'id'    => 4,
                'title' => 'Product 4 Title',
                'shortDescription' => 'Short Description 4 - 128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display',
                'imageUrl'  => 'https://i.imgur.com/5Aqgz7o.jpg',
                'price' => 40000,

            ),
            array(
                'id'    => 5,
                'title' => 'Product 5 Title',
                'shortDescription' => 'Short Description 5 - 128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display',
                'imageUrl'  => 'https://i.imgur.com/Aj0L4Wa.jpg',
                'price' => 50000,

            ),
            array(
                'id'    => 6,
                'title' => 'Product 6 Title',
                'shortDescription' => 'Short Description 6 - 128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display',
                'imageUrl'  => 'https://i.imgur.com/Aj0L4Wa.jpg',
                'price' => 60000,

            ),
        );
        return $productArray;
    }

}