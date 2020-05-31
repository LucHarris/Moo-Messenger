<?php
	//Field names passed in as "fields"
	//records passed in as "records"

    defined('BASEPATH') OR exit('No direct script access allowed');


	echo validation_errors();


    $forename = array(
        'id'			=> 'forename',
        'type'          => 'text',
        'name'          => 'forename',
        'value'         => 'Moo', //todo remove default
        'placeholder'   => 'First name'
    );

    $surname = array(

        'id'			=> 'surname',
        'type'          => 'text',
        'name'          => 'surname',
        'value'         => 'Baa', //todo remove default
        'placeholder'   => 'Surname'
    );

    $theme = array(
        '1'			=> 'dark'
    ); //radio button

    $picture = array(
        'id'			=> 'pictureUrl',
        'type'          => 'text',
        'name'          => 'pictureUrl',
        'value'         => '', //todo remove default
        'placeholder'   => 'Picture URL'
    );

	$email = array(
		'id'			=> 'email',
        'type'          => 'email',
        'name'          => 'email',
        'value'         => 'moobaa@domain.com', //todo remove default
        'placeholder'   => 'Email'
    );

	$password = array(
		'id'			=> 'password',
        'type'          => 'password',
        'name'          => 'password',
        'value'         => '123', //todo remove default
        'placeholder'   => 'Password'
    );
    
    $passwordConfirm = array(
		'id'			=> 'passwordConfirm',
        'type'          => 'password',
        'name'          => 'passwordConfirm',
        'value'         => '123', //todo remove default
        'placeholder'   => 'Confirm password'
    );

	//controller validation
	echo form_open("index.php/signup"); //Todo
	//Input fields
	echo $this->session->flashdata("error");
	echo form_input($forename);
	echo form_input($surname);
	echo form_input($email);
    echo form_input($password);
    echo form_input($passwordConfirm);
    echo form_dropdown('theme', $theme, '1');
	echo form_input($picture);
    
	echo form_error('forname',          '<p class="error">','</p>'); 
	echo form_error('surname',          '<p class="error">','</p>'); 
	echo form_error('email',            '<p class="error">','</p>'); 
	echo form_error('password',         '<p class="error">','</p>'); 
	echo form_error('passwordConfirm',  '<p class="error">','</p>'); 
	echo form_error('picture',          '<p class="error">','</p>'); 

	//submit
	echo form_submit("sumbit", "Sign Up");
	echo form_close();

?>