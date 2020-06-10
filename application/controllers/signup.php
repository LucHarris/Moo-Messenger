<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class signup extends CI_Controller {
	public function index()
	{
        //Stops signing up if already logged in
		if($this->session->id)
		{
            redirect("index.php/Home");
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('forename', 'Forename', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); //todo unique field rule not working. Unique field is apparently not unique. Requires model validation
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[2]|matches[passwordConfirm]' );
            $this->form_validation->set_rules('passwordConfirm', 'PasswordConfirm', 'required');
            
            
            $this->form_validation->set_rules('themeId', 'ThemeId', 'required');
            $this->form_validation->set_rules('iconId', 'IconId', 'required');
            $this->form_validation->set_rules('iconColour', 'IconColour', 'required');
            //todo set rules for password special character validation (even though it is hashed)
    
            if($this->form_validation->run())
            {
                //todo check post 
                $forename           = $this->input->post('forename' ,true);
                $surname            = $this->input->post('surname'  ,true);
                $email              = $this->input->post('email'    ,true);
                $password           = $this->input->post('password' ,true);

                $themeId              = $this->input->post('themeId'     ,true);
                $iconId             = $this->input->post('iconId'       ,true);
                $iconColour         = $this->input->post('iconColour'  ,true);

                
                //todo old delete deadcode
                //$newUser['forename'] = filter_var($forename, FILTER_SANITIZE_STRING);
                //$newUser['surname' ] = filter_var($surname, FILTER_SANITIZE_STRING);
                //$newUser['email'   ] = filter_var($email, FILTER_SANITIZE_EMAIL);
                //$newUser['password'] = password_hash($password,PASSWORD_DEFAULT);
                //$newUser['themeId' ] = filter_var($themeId, FILTER_SANITIZE_NUMBER_INT);
                //$newUser['picture' ] = filter_var($picture, FILTER_SANITIZE_NUMBER_INT);



                $newUser = array(
                    'forename'   => filter_var($forename, FILTER_SANITIZE_STRING)  ,
                    'surname'    => filter_var($surname, FILTER_SANITIZE_STRING)   ,
                    'email'      => filter_var($email, FILTER_SANITIZE_EMAIL)    ,
                    'password'   => password_hash($password,PASSWORD_DEFAULT)    ,
                    'themeId'    => filter_var($themeId, FILTER_SANITIZE_NUMBER_INT)   ,
                    'iconId'     =>  filter_var($iconId, FILTER_SANITIZE_NUMBER_INT) ,
                    'iconColour' =>  filter_var($iconColour, FILTER_SANITIZE_NUMBER_INT)
                );
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
