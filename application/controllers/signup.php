<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class signup extends CI_Controller {
	public function index()
	{
        //Stops signing up if already logged in
		if($this->session->id)
		{
			$this->load->model("User");
            $this->User->update();
            
            redirect("index.php/Home");
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('forename', 'Forename', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[2]|matches[passwordConfirm]' );
            $this->form_validation->set_rules('passwordConfirm', 'PasswordConfirm', 'required');
            
    
            if($this->form_validation->run())
            {

                //todo check post 
                $forename           = $this->input->post('forename' ,true);
                $surname            = $this->input->post('surname'  ,true);
                $email              = $this->input->post('email'    ,true);
                $password           = $this->input->post('password' ,true);
                $theme              = $this->input->post('theme'    ,true);
                //$picture            = $this->input->post('picture'  ,true);

                
                //todo ass array with new user data (password hash)
                $newUser['forename'] = $forename;
                $newUser['surname' ] = $surname ;
                $newUser['email'   ] = $email   ;
                $newUser['password'] = $password; // = password_hash($password,PASSWORD_DEFAULT);
                $newUser['themeId' ] = $theme   ;
               // $newUser['picture' ] = $picture ;

                //todo load model
                $this->load->Model("User");

                //todo call create in model passing array
                if($this->User->create($newUser))
                {
                    redirect("index.php/Home");
                }
                else{
                    redirect("index.php/signup");
                }
            }
            else
            {
                //load up page with form
                $this->load->view("header");
                $this->load->view("nav");
                $this->load->view("sign_up_form");
                $this->load->view("footer");
            }
        }

		
        


        



    }
    
}
