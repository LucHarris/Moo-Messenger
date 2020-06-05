<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->helper('cookie'); //For base URL
?>

<DOCTYPE! html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<!-- Mobile friendly viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>			Sample		</title>
		<!--Style Sheet-->
		<link rel="stylesheet"		href="<?php echo base_url(); ?>css/properties.css" />
		<link rel="stylesheet"		href="<?php echo base_url(); ?>css/mobile.css" />
		<link rel="stylesheet"		href="<?php echo base_url(); ?>css/desktop.css"  media="only screen and (min-width : 720px)" />
		<link rel="shortcut icon"	href="<?php echo base_url(); ?>images/test.jpg"   type="image/ico"    />

		<meta charset="utf-8">
		<title>Basic html layout example</title>
	</head>
	<body class="theme<?php 
		$theme = $this->session->themeId ?? 1; 		echo $theme;  
	?>" >
		<header>
			<h1>
			Messenger 
			<?php
				if( $this->session->userdata('email')  )
				{
					echo " - ".$this->session->forename . " ". $this->session->surname;
				
				}
			?>
			
			</h1>
		</header>

		<main>
			
