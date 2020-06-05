<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    //$this->load->helper('url'); //For base URL
?>

<nav>
	Conversations
	<ul>
		<a href="<?php echo base_url(); ?>"><li><div class="icon"></div> <h4>index</h4></li></a>
		
		<a href="<?php echo base_url("index.php/Home"); ?>"><li><div class="icon"></div> <h4>Home</h4></li></a>
		
		<?php 
			if( $this->session->email  )
			{
				echo "<a href=". base_url("index.php/logout") . "><li><div class=\"icon\"></div> <h4>Log out</h4></li></a>";
			}
			else
			{
				echo "<a href=" . base_url("index.php/Log_In")  . "><li><div class=\"icon\"></div> <h4>Log In</h4></li></a>";
				echo "<a href=" . base_url("index.php/signup")  . "><li><div class=\"icon\"></div> <h4>Sign Up</h4></li></a>";
			}
			//Private contacts
			if($this->session->pmList)
			{
				echo "<h2>Private Contacts</h2>";

				foreach($this->session->pmList AS $row)
				{
					
					echo "<a href=" . base_url("index.php/profile?userId=".$row['otherUserId'])  . "><li><div class=\"icon\"></div> <h4>";
					echo $row['otherUserId']." ".$row['otherForename']." ".$row['otherSurname'];
					if ($row['unread'] == 1) echo " New ";
					echo " </h4></li></a>";
				}
			}
			if($this->session->teamList)
			{
				echo "<h2>Team Contacts</h2>";

				foreach($this->session->teamList AS $row)
				{
					//echo "<a href=" . base_url("index.php/profile?userId=".$row['chatId'])  . "><li><div class=\"icon\"></div> <h4>";
					echo $row['chatId']. " ". $row['chatName'] ;
					if ($row['unread'] == 1) echo " New ";
					//echo " </h4></li></a>";
				}
			}



		?>
		<li><div class="icon"></div> <h4>Two</h4></li>
		<li><div class="icon"></div> <h4>Three</h4></li>
	</ul>
</nav>
<section>					

