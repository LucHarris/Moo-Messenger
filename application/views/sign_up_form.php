<?php
	//Field names passed in as "fields"
	//records passed in as "records"

    defined('BASEPATH') OR exit('No direct script access allowed');


	echo validation_errors();


    $forename = array(
        'id'			=> 'forename',
        'type'          => 'text',
        'name'          => 'forename',
        'value'         => '', //todo remove default
        'placeholder'   => 'First name'
    );

    $surname = array(

        'id'			=> 'surname',
        'type'          => 'text',
        'name'          => 'surname',
        'value'         => '', //todo remove default
        'placeholder'   => 'Surname'
    );

    $themeId = array(
        '1'			=> 'Dark',
        '2'			=> 'Light',
        '3'			=> 'Kobi',
        '4'			=> 'Red Navy',
        '5'			=> 'Duke Jam',
        '6'			=> 'Carcoal',
        '7'			=> 'Cool Grey',
        '8'			=> 'Kitchen Garden'
    ); //radio button

    $iconId = array(
        '0'     => 'Solid Colour',
        '1'     => 'Male',
        '2'     => 'Female',
        '3'     => 'Grass',
        '4'     => 'Palm Tree',
        '5'     => 'Heart',
        '6'     => 'Hearts',
        '7'     => 'Checker',
        '8'     => 'Tree',
        '9'     => 'Leaf',
        '10'    => 'Wing',
        '11'    => 'Bolt Nut',
        '12'    => 'Glasses',
        '13'    => 'Square',
        '14'    => 'Wireframe',
        '15'    => 'Cow',
    );

    $iconColour = array(
        'id'        =>  'iconColour',
        'name'      =>  'iconColour',
        'type'      =>  'color',
        'value'     =>  '#ffffff',  //todo load
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
    echo '<h1>Sign Up</h1>';
    echo '<p>Please fill out the boxes below</p>';
	echo $this->session->flashdata("error");
	echo form_input($forename);
	echo form_input($surname);
	echo form_input($email);
    echo form_input($password);
    echo form_input($passwordConfirm);
    echo form_dropdown('themeId', $themeId, '1');
    echo form_dropdown('iconId', $iconId, '1');
	echo form_input($iconColour);
    
	echo form_error('forname',          '<p class="error">','</p>'); 
	echo form_error('surname',          '<p class="error">','</p>'); 
	echo form_error('email',            '<p class="error">','</p>'); 
	echo form_error('password',         '<p class="error">','</p>'); 
	echo form_error('passwordConfirm',  '<p class="error">','</p>'); 
	echo form_error('themeId',          '<p class="error">','</p>'); 
	echo form_error('iconId',           '<p class="error">','</p>'); 
	echo form_error('iconColour',       '<p class="error">','</p>'); 

	//submit
	echo form_submit("sumbit", "Sign Up");
	echo form_close();

?>