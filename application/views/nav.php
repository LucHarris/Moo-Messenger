<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    //$this->load->helper('url'); //For base URL
?>

<nav>
				Conversations
				<ul>
					<a href="<?php echo base_url(); ?>"><li><div class="icon"></div> <h4>index</h4></li></a>
					<a href="<?php echo base_url("index.php/Home"); ?>"><li><div class="icon"></div> <h4>Home</h4></li></a>
					<a href="<?php echo base_url("index.php/Login"); ?>"><li><div class="icon"></div> <h4>Log in</h4></li></a>
					<li><div class="icon"></div> <h4>Two</h4></li>
					<li><div class="icon"></div> <h4>Three</h4></li>
				</ul>
			</nav>

