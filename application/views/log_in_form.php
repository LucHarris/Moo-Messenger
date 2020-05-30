<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->helper('url'); //For base URL
	$this->load->helper('form');

	echo validation_errors();

	$email = array(

		'id'			=> 'email',
        'type'          => 'email',
        'name'          => 'email',
        'value'         => 'tom@domain.com', //todo remove default
        'placeholder'   => 'Email'
    );

	$password = array(
		'id'			=> 'password',
        'type'          => 'password',
        'name'          => 'password',
        'value'         => '123', //todo remove default
        'placeholder'   => 'Password'
    );
	
	//controller validation
	echo form_open("index.php/Log_In/validate"); //Todo
	//Input fields
	echo $this->session->flashdata("error");
	echo form_input($email);
	echo form_input($password);
	//error message
	echo form_error('name','<p class="error">','</p>'); 

	//submit
	echo form_submit("sumbit", "Log in");
	echo form_close();

	
?>


