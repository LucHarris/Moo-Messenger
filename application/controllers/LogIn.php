<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class LogIn extends CI_Controller {

	public function index()
	{
		$this->load->view("header");
		$this->load->view("nav"); 
		$this->load->view("log_in"); 
		$this->load->view("footer");
	}
}
