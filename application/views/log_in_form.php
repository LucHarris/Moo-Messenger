<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->helper('url'); //For base URL
	$this->load->helper('form');

	echo validation_errors();

	$name = array(
        'type'          => 'text',
        'name'          => 'name',
        'value'         => ''/*$projectData->Title*/,
        'placeholder'   => 'your name'
    );
	
	//controller validation
	echo form_open("index.php/Login/validate"); //Todo
	//Input fields
	echo form_input($name);
	//error message
	//echo form_error('name','<p class="error">','</p>'); 

	//submit
	echo form_submit("sumbit", "Login");
	//echo $this->session->flashdata("error");
	echo form_close();

	
?>


