<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    //$this->load->helper('url'); //For base URL

    
    if(!empty($user))
    {
        echo "<div class=\"profile\">";
        
        $iconId = $user->iconId ?? 0;
        $iconFile =   "images/icons/icon".sprintf('%04d',$iconId).".png";
        
        //large profile icon 
        echo "<div class=\"profile-icon\" style=\"";
        if(file_exists($iconFile))
        {
            echo "background-image: url('"  .base_url($iconFile) .   "'); ";
        }
        echo "background-color: ".$user->iconColour,";\">";
        echo "</div>";
        
        
        echo "<div class=\"details\">";

        foreach($userTable AS $field=>$value)
        {
            echo "<p>";
            echo "<span>";
            echo $field;
            echo " : ";
            echo "</span>"; 
            echo "<span>"; 
            echo $value;
            echo "</span>"; 
            echo "</p>";
        }

        echo "</div>"; //details class end
        
        echo "</div>"; // profile icon

    }
    else
    {
        echo "Profile does not exist or has been removed.";
    }





?>

