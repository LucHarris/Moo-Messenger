<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    //chat container
    
    if(!empty($conversation))
    {
        echo "<ul>";

        //title

        if(!empty($chatDetails->name))
        {
            echo $chatDetails->name." - ".$chatDetails->creationDate; //todo heading tags
        }
        else
        {
            echo "Chat with ";
            if(count($otherUsers) === 1 )
            {
                foreach($otherUsers as $row)
                {
                    echo $row['otherForename']." ".$row['otherSurname'];
                }
            }
            else
            {
               echo  "<p class=\"error\"> Chats with no name should only have 2 users  </p>";
            }
            echo " started on ".$chatDetails->creationDate;
        }

        //other users
        if(!empty($otherUsers))
        {
            foreach($otherUsers as $row)
                {
                    echo "<a href=\"".base_url("index.php/profile/id/".$row['otherId'])."\">";
                    echo "<p>".$row['otherForename']." ".$row['otherSurname']."</p>";
                    echo "</a>";
                }
        }

        //conversation bubbles

        foreach($conversation as $row)
        {

            echo ($this->session->id === $row['userId'])? "<li class=\"me\">": "<li>";
            echo "<h5>"; // open title
            echo $row['forename']." ".$row['surname']; // name and date
            echo " - ".$row['postedDate']; // name and date
            if(isset($row['editedDate']))
            {
                echo "</h5>";
                echo "<h5>"; // open title
                echo "edited on ".$row['postedDate'];
            }
            echo "</h5>";
            echo $row['messageBody']; //message
            echo "</li>";
            
        }
        echo "</ul>";
    }
    else
    {
        
        echo "No Chat";
    }
    
    

?>