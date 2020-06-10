<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $passwordOld = array(
		'id'			=> 'passwordOld',
        'name'          => 'passwordOld',
        'type'          => 'password',
        'value'         => '', //todo remove default
        'placeholder'   => 'Current Password'
    );

    $passwordNew = array(
		'id'			=> 'passwordNew',
        'name'          => 'passwordNew',
        'type'          => 'password',
        'value'         => '', //todo remove default
        'placeholder'   => 'New Password'
    );

    $passwordConfirm = array(
		'id'			=> 'passwordConfirm',
        'name'          => 'passwordConfirm',
        'type'          => 'password',
        'value'         => '', //todo remove default
        'placeholder'   => 'Confirm New Password'
    );

    echo form_open("index.php/profile/changePassword"); //Todo
    //Input fields
    
    echo '<h1>Update Password</h1>';
    echo form_input($passwordOld);
    echo form_input($passwordNew);
    echo form_input($passwordConfirm);

    if($this->session->flashdata("error"))
    {
        echo "<p class=\"error\">";
        echo $this->session->flashdata("error");
        echo "</p>";
    }

    if($this->session->flashdata("success"))
    {
        echo "<p class=\"\">";
        echo $this->session->flashdata("success");
        echo "</p>";
    }

	echo form_error('passwordOld',      '<p class="error">','</p>'); 
	echo form_error('passwordNew',      '<p class="error">','</p>'); 
	echo form_error('passwordConfirm',  '<p class="error">','</p>'); 

	//submit
	echo form_submit("sumbit", "Update password");
    echo form_close();
?>