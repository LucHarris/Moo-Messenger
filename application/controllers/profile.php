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

            $profile = array(
                'ID' => $user->id,
                'Name' => $user->forename." ".$user->surname,
                'Email' => $user->email,
                'Tag'   => "@".$user->forename.$user->surname.$user->id,
                'Last Active' => $user->lastActive
            );

            $data['user'] = $user;
            $data['userTable'] = $profile;
            
            $this->load->view("header");
            $this->load->view("nav"); 
            $this->load->view("profile",$data);
            $this->load->view("footer");
        }
        else
        {
            redirect("index.php/Home/status/404");
        }
        
    }

    public function settings()
    {
        if($this->session->id)
        {

            $this->load->library('form_validation');


            //set rules
            $this->form_validation->set_rules('forename', 'Forename', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            $this->form_validation->set_rules('themeId', 'ThemeId', 'required');
            $this->form_validation->set_rules('iconId', 'IconId', 'required');
            $this->form_validation->set_rules('iconColour', 'IconColour', 'required');

            

            $this->load->Model("User");

            if($this->form_validation->run())
            {
                //post
                $forename           = $this->input->post('forename'     ,true);
                $surname            = $this->input->post('surname'      ,true);
                $email              = $this->input->post('email'        ,true);
                $themeId              = $this->input->post('themeId'     ,true);
                $iconId             = $this->input->post('iconId'       ,true);
                $iconColour         = $this->input->post('iconColour'  ,true);

                
                //post variables to array
                $updateUser = array(
                    'forename'   => filter_var($forename, FILTER_SANITIZE_STRING)  ,
                    'surname'    => filter_var($surname, FILTER_SANITIZE_STRING)   ,
                    'email'      => filter_var($email, FILTER_SANITIZE_EMAIL)    ,
                    'themeId'    => filter_var($themeId, FILTER_SANITIZE_NUMBER_INT)   ,
                    'iconId'     =>  filter_var($iconId, FILTER_SANITIZE_NUMBER_INT) ,
                    'iconColour' =>  filter_var($iconColour, FILTER_SANITIZE_NUMBER_INT)
                );
            
                // if User->edit(array) successful
                if($this->User->edit($updateUser))
                {
                    redirect("index.php/profile/id/".$this->session->id); 
                }
                else
                {
                    //todo flashdata error
                    redirect("index.php/profile/settings/"); //fail 
                }

            }
            else
            {

                $data['currentDetails'] = $this->User->getRecord($this->session->id);
                $this->load->view("header");
                $this->load->view("nav"); 
                $this->load->view("edit_user_form", $data); 
                $this->load->view("footer");
            }
        }
    }

    public function changePassword()
    {
        if($this->session->id)
        {

            $this->load->library('form_validation');

            //todo change to old pw, new pw, confirmNewPW
            $this->form_validation->set_rules('passwordOld', 'Password', 'required' );
            $this->form_validation->set_rules('passwordNew', 'Password', 'required|min_length[2]|matches[passwordConfirm]|differs[passwordOld]' );
            $this->form_validation->set_rules('passwordConfirm', 'PasswordConfirm', 'required');

            $this->load->Model("User");

            if($this->form_validation->run())
            {
                //post
                $passwordOld           = $this->input->post('passwordOld' ,true);
                $passwordNew          = $this->input->post('passwordNew' ,true);
                $passwordConfirm   = $this->input->post('passwordConfirm' ,true); //new

                if($this->User->verifyPassword($passwordOld) && ($passwordNew === $passwordConfirm) )
                {

                    $updateData = array(
                        'password' => password_hash($passwordNew,PASSWORD_DEFAULT)
                    );
                    
                    
                    if($this->User->edit($updateData))
                    {
                        $this->session->set_flashdata("success","Password successfully changed");

                        //redirect("index.php/profile/id/".$this->session->id);
                        redirect("index.php/profile/changepassword");
                    }
                    else
                    {
                        $this->session->set_flashdata("error"," Unable to change password.");
                        redirect("index.php/profile/changepassword");
                    }
                }
                else
                {
                    $this->session->set_flashdata("error","Please enter the correct password");
                    redirect("index.php/profile/changepassword");
                }

                //array
            }
            else
            {
                $this->load->view("header");
                $this->load->view("nav"); 
                $this->load->view("change_password_form"); 
                $this->load->view("footer"); 
        
                //load normal views
            }
        }
    }
}