<?php

//USED TO REFRESH THE BODY OF THE MESSAGE CONTAINER, THIS FILE IS CALLED CONTINOUSLY AFTER 1.5 SECONDS

include("dbconnection.php");
$output="";
$fromUser=$_POST["fromUser"];
$toUser=$_POST["toUser"];

$chats=mysqli_query($connection,'select * from messages where (fromUser="'.$fromUser.'"AND toUser="'.$toUser.'")OR(fromUser="'.$toUser.'"AND toUser="'.$fromUser.'");') or die("Failed to query db ".mysqli_error()) ;
           
        
        while( $chat = mysqli_fetch_assoc($chats)){
            if($chat["fromUser"]==$fromUser){
                $output .= "<div style='text-align:right;'>
                <p style='background-color:rgb(0, 131, 113);color:white;word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22);margin-right:10px; '>
                    ".$chat["message"]."
                </p>
                </div>";
            }
            else {
                $output .= "<div style='text-align:left;'>
                <p style='background-color:rgb(77, 75, 75);color:white;word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22);margin-left:10px; '>
                    ".$chat["message"]."
                </p>
                </div>";
            }
        }
        echo $output;
    ?>
    
