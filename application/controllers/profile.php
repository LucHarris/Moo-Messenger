<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller {

	public function index()
	{
        redirect("index.php/Home/status/404");
        
    }
    
    public function id($id= 0) 
    {
        
        
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        
        if($id > 0)
        {
            $this->load->model('User');
            
            $user = $this->User->get('id',$id);
            $profile['user'] = $user;
            
            $this->load->view("header");
            $this->load->view("nav"); 
            $this->load->view("profile",$profile);
            $this->load->view("footer");
        }
        else
        {
            redirect("index.php/Home/status/404");
        }
        
    }

}