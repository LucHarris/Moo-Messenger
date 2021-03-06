<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Log_In extends CI_Controller {

	public function index()
	{

		if(  !$this->session->id )
		{
			$this->load->view("header");
			$this->load->view("nav"); 
			$this->load->view("log_in_form"); 
			$this->load->view("footer");
		
		}
		else
		{
			redirect("index.php");
		}
	}

	public function validate()
	{
		$this->load->view("header");
		$this->load->view("nav"); 

		$this->load->library('form_validation');
		$this->load->helper('cookie');

		$this->form_validation->set_rules("email", "Email", 'required');
		$this->form_validation->set_rules("password", "Password", 'required');

		if($this->form_validation->run())
		{
			$email = $this->input->post("email");
            $password = $this->input->post("password");

			$this->load->model("User");

			if($this->User->validate($email,$password))
			{


				$user = $this->User->get('email',$email);
				
				if(!$user->removed)
				{

					
					//remove unwanted fields such as password
					$userDetails = array( 
						'id'			=> $user->id , 
						'email'			=> $user->email , 
						'forename'		=> $user->forename , 
						'surname'		=> $user->surname , 
						'themeId'		=> $user->themeId , 
						'pictureUrl'	=> $user->pictureUrl , 
						'lastActive'	=> $user->lastActive ,
						
					);
					
					$themeCookie = array(
						'name'   => 'theme',
						'value'  => $user->themeId,
						'expire' =>  time()+60*60*24*7
					);

					
					
					$this->session->set_userdata($userDetails);

					$this->User->updateContactLists(); //user 

					redirect("index.php/Home");
				}
				else
				{
					$this->session->set_flashdata("error","email blocked");
					redirect("index.php/Log_In");
				}
				
			}
			else 
			{
				$this->session->set_flashdata("error","email invalid");
                redirect("index.php/Log_In");
			}
		}
		

	}

	public function enter()
	{
		if($this->session->userdata("id") != '')
        {
            redirect("index.php/Home");
            //echo "Welcome ".$this->session->userdata('username');
        }
        else{
            redirect("index.php/Log_In");
        }
	}

	public function test()
	{
		if ($this->session->has_userdata('id'))
		{
			redirect("index.php/Home");

		}
		else 
		{
            redirect("index.php/Log_In");
		}
	}
}

