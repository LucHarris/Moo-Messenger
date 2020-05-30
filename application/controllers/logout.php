<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class logout extends CI_Controller {
		
		//removes user data from session
		public function index()
		{
			
			$this->session->unset_userdata('moo'				);
			$this->session->unset_userdata('id'				);
			$this->session->unset_userdata('email'			);
			$this->session->unset_userdata('forename'		);
			$this->session->unset_userdata('forname'		);
			$this->session->unset_userdata('surname'		);
			$this->session->unset_userdata('themeId'		);
			$this->session->unset_userdata('pictureUrl'		);
			$this->session->unset_userdata('lastActive'		);
		
			$this->load->view("header");
			$this->load->view("nav"); 
			$this->load->view("footer");
		}
}
