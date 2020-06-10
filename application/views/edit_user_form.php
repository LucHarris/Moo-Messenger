<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $email = array(
		'id'			=> 'email',
        'type'          => 'email',
        'name'          => 'email', 
        //'value'         => $currentDetails['email'], 
        'value'         => $currentDetails->email, 
        'placeholder'   => 'Email'
    );

    $forename = array(
        'id'			=> 'forename',
        'type'          => 'text',
        'name'          => 'forename',
        'value'         => $currentDetails->forename, 
        'placeholder'   => 'First name'
    );

    $surname = array(

        'id'			=> 'surname',
        'type'          => 'text',
        'name'          => 'surname',
        'value'         => $currentDetails->surname, 
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
        'value'     =>  $currentDetails->iconColour,  //todo load
    );

    echo form_open('index.php/profile/settings');
    echo '<h1>Edit Profile</h1>';
    echo $this->session->flashdata('error');
    echo form_input($forename);
	echo form_input($surname);
	echo form_input($email);
    echo form_dropdown('themeId', $themeId, $currentDetails->themeId);
    echo form_dropdown('iconId', $iconId, $currentDetails->iconId);
    echo form_input($iconColour);

    echo form_error('forname',         '<p class="error">','</p>'); 
	echo form_error('surname',         '<p class="error">','</p>'); 
	echo form_error('email',           '<p class="error">','</p>'); 
	echo form_error('themeId',         '<p class="error">','</p>'); 
	echo form_error('iconId',          '<p class="error">','</p>'); 
    echo form_error('iconColour',      '<p class="error">','</p>');
    
    echo form_submit("sumbit", "Save Changes");
	echo form_close();


?>