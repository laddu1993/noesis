<?php
    class Login_hook {
    private $CI;
 
        function __construct(){
            $this->CI =& get_instance();
        }
     
        function validate_session(){
            if (empty($this->CI->session->userdata('email')) && ($this->CI->router->class != 'Login')) {
                //echo "<pre>";print_r($_SESSION);die;       
                header('location: ../Login/index');
            }
        }
    }