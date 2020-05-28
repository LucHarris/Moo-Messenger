<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->helper('url'); //For base URL

	echo validation_errors();

	$username = array(
        'type'          => 'text',
        'name'          => 'username',
        'value'         => ''/*$projectData->Title*/,
        'placeholder'   => 'Username'
    );

?>


