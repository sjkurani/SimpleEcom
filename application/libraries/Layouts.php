<?php
class Layouts {

    public function __construct() {
        $this->CI =& get_instance();
    }

    //CI  instance
    private $CI;

    //Layout title
    private $layout_title = null;

    //Layout Description
    private $layout_description = null;

    //hold includes like css and js
    private $includes = array();

    public function set_title($title) {
        $this->layout_title = $title;
    }

    public function set_description($desc) {
        $this->layout_description = $desc;
    }

    public function set_breadcrumb_array($b_array) {
        $this->breadcrumb_array = $b_array;
    }

    public function add_includes($path, $prepend_base_url = true)
    {
        if($prepend_base_url) {
            $this->CI->load->helper('url'); //loads helper
            $this->includes[] =  base_url(). $path;
        }
        else {
            $this->includes[] = $path;
        }
        return $this;
    }

    public function print_includes() {
        $final_includes = "";
        foreach ($this->includes as $include) {
            if(preg_match('/js$/', $include)) {
                $final_includes .= '<script src="'.$include.'"></script>';
            }
            else if(preg_match('/css$/', $include)) {
                $final_includes .= '<link href="'.$include.'" rel="stylesheet"/>';
            }
        }
        return $final_includes;
    }

    /**
     * @param $view_name
     * @param array $layouts
     * @param array $params
     * @param bool $default
     * @param bool $default_sidebar
     */
    public function view($view_name, $layouts = array(), $params = array(), $default = true) {
        if($default) {
            $header_params['layout_title'] = $this->layout_title;
            $header_params['layout_description'] = $this->layout_description;
            if(isset($this->breadcrumb_array)) {
                $header_params['breadcrumb_array'] = '';// $this->breadcrumb_array;
            }
            $this->CI->load->view('layouts/header',$header_params);
            $this->CI->load->view('layouts/navbar',$header_params,$params);
            //load navbar and sidebars within the view.
            if($default == TRUE && is_array($layouts) && count($layouts) >= 1 ) {
                foreach ($layouts as $layout_key => $layout){
                    $this->CI->load->view($layout, $params);
                }
            }
            $this->CI->load->view($view_name, $params);
            $this->CI->load->view('layouts/footer');
        }
        else {
            //render viewer
            $this->CI->load->view($view_name, $params);
        }
    }
}
?>