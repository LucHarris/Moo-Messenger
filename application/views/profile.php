<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    //$this->load->helper('url'); //For base URL

    
    if(!empty($user))
    {
        //foreach ($user as $key=>$val)
        //		echo $key." ".$val."<br/>";
        

        echo $user->id;
        echo "<br>";
        echo $user->forename;
        echo "<br>";
        echo $user->surname;
        echo "<br>";
        echo $user->lastActive;
        echo "<br>";
        
        if(isset($user->pictureUrl))
        {
           
            
            //todo validate image
            if(file_exists($user->pictureUrl))
            {
            }
            
            
            list($width, $height, $type, $attr) = getimagesize($user->pictureUrl);
            $stretch = ($width > $height)? "auto 100%" :  "  100%  auto"; 
            echo "<div class=\"profile\" style=\"background-image: url('"  . $user->pictureUrl .   "'); background-size: ".$stretch.";\"></div>";

            
        }
        echo "<br>";
        

    }
    else
    {
        echo "Profile does not exist or has been removed.";
    }





?>

