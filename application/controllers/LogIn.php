<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class LogIn extends CI_Controller {

	public function index()
	{
		$this->load->view("header");
		$this->load->view("nav"); 
		$this->load->view("log_in_form"); 
		$this->load->view("footer");
	}

	public function validate()
	{
		$this->load->view("header");
		$this->load->view("nav"); 


		$this->load->library('form_validation');

		
		$this->form_validation->set_rules("name", "Name", 'required');

		if($this->form_validation->run())
		{
			$name = $this->input->post("name");
			$this->load->model("User");

			echo 'console.log("Moo")';


			if($this->User->validate($name))
			{
				$user = $this->User->get($name);


				//Create user session
				$sessionData = array(
					'id' => $id,
                    'name' => $name
                );

				$this->session->set_userdata($sessionData);

				redirect("index.php/Home");
			}
			else 
			{
				$this->session->set_flashdata("error","Username invalid");
                redirect("index.php/LogIn");
			}
		}
		
		
		/*
		$this->load->view("log_in"); 
		$this->load->view("footer");
		*/
	}

	public function enter()
	{
		if($this->session->userdata("id") != '')
        {
            redirect("Home");
            //echo "Welcome ".$this->session->userdata('username');
        }
        else{
            redirect("LogIn");
        }
	}

}
