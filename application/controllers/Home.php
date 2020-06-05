<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		//todo
		//load user model
		//get 121 array
		//get group array
		//pass to view

		$this->load->view("header");
		$this->load->view("nav");
		$this->load->view("sample_section");
		$this->load->view("footer");
		
		if($this->session->id)
		{


			$this->load->model("User");
			//$this->load->model("Chat");

			$this->User->update();
		}

	}
	public function defaultTheme()
	{
		$this->session->unset_userdata('themeId');

		$this->index();
	}

	public function setTheme($theme = 1)
	{
		$this->session->set_userdata('themeId', $theme);
		$this->index();
	}

	public function status($code)
	{
		$code = filter_var($code, FILTER_SANITIZE_NUMBER_INT);
		
		$this->load->view("header");
		$this->load->view("nav");
		$message = "error";
		switch($code)
		{
			case 301: $message = "Moved"; break;
			case 302: $message = "Moved";break;
			case 303: $message = "See Other";break;
			case 403: $message = "Forbidden";break;

			case 404: $message = "Not found";break;
			case 451: $message = "Unavailable For Legal Reasons";break;
			default: $message = "Unable to process statuc code";break;
		}

		$bodyData['message'] = $message;
		$this->load->view("status_code", $bodyData);

		$this->load->view("footer");
	}



}
