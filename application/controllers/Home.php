<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->view("header");
		$this->load->view("nav");
		$this->load->view("sample_section");
		$this->load->view("footer");
		
		if($this->session->id)
		{
			$this->load->model("User");
			$this->User->update();
		}

	}
}
