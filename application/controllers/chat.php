<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends CI_Controller {


	public function index()
	{
        redirect("index.php/Home/status/404");
    }

    public function id($chatId)
    {
        //form for submitting messages
        
        $chatId = filter_var($chatId, FILTER_SANITIZE_NUMBER_INT);

        //can user see chat - model
        $this->load->model('Chat_Model');

        $this->load->view("header");
        $this->load->view("nav"); 

        if($this->session->id)
        {
            if($this->Chat_Model->userHasAccess($this->session->id, $chatId))
            {
                //$conv = ;
                $bodyData['conversation'] = $this->Chat_Model->getMessagesInChat($chatId);
                $bodyData['chatDetails'] = $this->Chat_Model->get($chatId);
                $bodyData['otherUsers'] = $this->Chat_Model->getOtherUsers($chatId);


                $this->load->view("chat",$bodyData);
            }
            else
            {
                redirect("index.php/Home/status/404");
            }
        }
        else
        {
            redirect("index.php/Home/status/404");
        }
        
        $this->load->view("footer");
    }
        

}
