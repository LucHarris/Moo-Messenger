<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    //$this->load->helper('url'); //For base URL
?>

<nav>
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
					$iconId = $row['iconId'] ?? 0;

					$iconFile =   "images/icons/icon".sprintf('%04d',$iconId).".png";
					
					//item
					echo "<a href=" . base_url("index.php/chat/id/".$row['chatId']).">";
					echo "<li>";

					//icon
					echo "<div class=\"icon\" ";

					// icon style
					echo "style=\"";
					if(file_exists($iconFile))
						echo " background-image: url('".base_url($iconFile)."');";
					if(!empty($row['iconColour']))
						echo " background-color: #".$row['iconColour']."\" ";
					echo "\"></div>";

					//Contact name
					echo "<h4>";	
					echo $row['otherForename']." ".$row['otherSurname'];
					if ($row['unread'] == 1) echo " New ";
					echo "</h4>";

					//close item
					echo "</li>";
					echo "</a>";
				}
			}
			if($this->session->teamList)
			{
				echo "<h2>Team Contacts</h2>";

				foreach($this->session->teamList AS $row)
				{


					$iconId = $row['iconId'] ?? 0;
					$iconFile =   "images/icons/icon".sprintf('%04d',$iconId).".png";
					
					//item
					echo "<a href=" . base_url("index.php/chat/id/".$row['chatId']).">";
					echo "<li>";

					//icon
					echo "<div class=\"icon\" ";

					// icon style
					echo "style=\"";
					if(file_exists($iconFile))
						echo " background-image: url('".base_url($iconFile)."');";
					if(!empty($row['iconColour']))
						echo " background-color: #".$row['iconColour']."\" ";
					echo "\"></div>";


					//team contact details
					echo "<h4>";	
					echo $row['chatName'];
					if ($row['unread'] == 1) echo " New ";
					echo "</h4>";

					//close item
					echo "</li>";
					echo "</a>";

				}
			}



		?>
		<!--<li><div class="icon"></div> <h4>Sample</h4></li>
		<li><div class="icon"></div> <h4>todo remove</h4></li> --> 
	</ul>
</nav>
<section>					

