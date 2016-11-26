<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template{

    protected $CI;

    function __construct()
    {
        $this->CI =& get_instance();

    }

    public function view($view,$view_data = array())
    {
        $data['content'] = $this->CI->load->view($view,$view_data,true);
        return $this->CI->load->view('template_view',$data);
    }






}

