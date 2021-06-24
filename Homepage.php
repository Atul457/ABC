<?php
session_start();
$name="name";
$val=$_GET["sender"];                                     //GETS THE NAME OF THE SENDER WHO HAVE LOGED IN

include("dbconnection.php");
$row1=mysqli_query($connection,'select * from registration where username="'.$val.'";') ;
    $user=mysqli_fetch_assoc($row1);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>          <?PHP //SOURCE FILE FOR AJAX   ?>

<meta charset="UTF-8">                                                             <?PHP //VARIOUS LIKNKS FOR STYLES AND ICONS   ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<link rel="stylesheet" href="Homepagestyle.css"/>                                        
<link rel="stylesheet" type="text/css" href="C:\Users\AJ\Downloads\fontawesome-free-5.15.3-web\fontawesome-free-5.15.3-web\css\all.css">
<link rel="stylesheet"
href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
crossorigin="anonymous"/>



<title>Homepage</title>
<style>                                                                             /* INTERNAL CSS */
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  top: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;

}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
  
}
</style>
</head>



<body>
<div class="banner_container" style="border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22);">
<div class="menu"><span><a href="Index.php" class="social">Logout<i class="fas fa-sign-out-alt"></i></a></span></div>
<div class="menu">    

<div style="color:#fff;font-size:15px;font-weight: bold;text-align: center;" class="popup" onclick="myFunction()">
Profile
<i class="fas fa-user" style="margin-right:10px"></i>


<p class="popuptext" id="myPopup" style="align-item:center;">                             <?php //SHOWS FADED FLOAING USERID// ?>
  @<?php echo $_GET["sender"]?>
</p>
</div>
</div>

<?php //ICONS ?>

<div class="menu" id="load" style="display: flex; flex-direction: column;"></div>       <?php //HERE SEARCH BOX WILL BE LOADED ?>
<div class="menu"><span><a href="#" class="social" id="searchbox">Search<i class="fas fa-search"></i></a></span></div>
<div class="menu"><span><a href="#" class="social">Inbox<i class="fas fa-envelope"></i></a></span></div>
<div class="info">Welcome <?php echo $user["name"];?></div>
</div>

<?php //CONTAINER FOR USERS AND MESSAGE BOX ?>

<div class="user_message_container">
<div class="user">
<div class="online_num">USERS</div>

<?php //SHOWS THE LIST OF THE USERS ?>
    
<?php
    include("dbconnection.php");
    $row[]='';
    $sql="Select * from registration;";
    $query=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_assoc($query)){
        if($row["username"]!=$val){
        echo '<a class="links" href="Homepage.php?sender='.$_GET["sender"].'&'.'username='. $row["username"].'">'.'@'.$row["username"].'</a>';
                                  }
                                          }
 ?> 
</div>

<div class="message" >
<div class="message-touser" style="position:absolute;font-size: 25px;font-weight: bold;color:rgb(185, 66, 72);background:white;margin:5px;">


<?php //SHOWS THE NAME OF THE PERSON TO WHOM WE ARE MESSAGING ?>
    <?php
        $toUser='';
        if(isset($_GET["username"])){
            $toUser=$_GET["username"];
            echo '<input type="text" value="'.$_GET["username"].'"id="toUser"hidden/>';
            echo '<input type="text" value="'.$val.'"id="fromUser"hidden/>';
            echo 'To:      @'.$toUser;
        }
    ?>
</div>



<?php //CONTAINER WHERE MESSAGES ARE SHOWN ?>

<div class="modal-body" id="msgBody" style="overflow-y:scroll;overflow-x:hidden;margin:40px 15% 0px 15%;height:400px;width:90%;background:rgb(77, 144, 153);border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22);">
        
<?php
  if(isset($_GET["username"])){
     $chats=mysqli_query($connection,'select * from messages where (fromUser="'.$val.'"AND toUser="'.$_GET["username"].'")OR(fromUser="'.$_GET["username"].'"AND toUser="'.$_SESSION["username"].'");') or die("Failed to query db ".mysqli_error()) ;
           
        
    while( $chat = mysqli_fetch_assoc($chats)){                                                         //FETCHING THE MESSAGES
      if($chat["fromUser"]==$val){
         echo "<div style='text-align:right;'>
                <p style='background-color:rgb(0, 131, 113);color:white;word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22);margin-right:10px; '>
                    ".$chat["message"]."
                </p>
                </div>";
                                  }
        else{
           echo "<div style='text-align:left;'>
                <p style='background-color:rgb(77, 75, 75);color:white;word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22);margin-left:10px; '>
                    ".$chat["message"]."
                </p>
                </div>";
            }
                                              }
                                }
 ?>

<?php //FOOTER IS THE CONTAINER FOR MESSAGE BOX AND SEND BUTTON ?>

</div>                                                           
    <div class="footer" style="display:flex;flex-direction:row;margin-top:10px; padding:0 10px;width:70%; margin-top:20px;">
        <textarea id="message" placeholder="Enter Your Message" class="form" style ="height:45px;flex-basis:70%;background:#fff;border-radius: 10px;box-shadow: 0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22); border:none;font-family: 'Montserrat',sans-serif;outline:none;padding:13px;font-Size:18px;" ></textarea>
        <button id="send" class="btn-send" style="height:75%;margin-top:6px;flex-basis:20%;margin-left:5px border: radius 10px;border:none;background:#ff4b2b;color:#fff;font-size:12px;font-weight: bold;padding:12px 10px;letter-spacing: 1px;text-transform: uppercase;transition: transform 80ms ease-in;outline:none;float:;">send</button>
    </div>


<?php //SHOWS THE DESCRIPTION OF THE SITE ?>

<div class="points" style="position:absolute;font-size: 13px; top:20%; left:45%; ">
<?php
        if(isset($_GET["username"])){
            echo "<style> .points{z-index:-1;} </style>";                   //SENDS THE DIVISION BACKWARD WHEN WE CLICK THE USERNAME
        }
?>
<ul style=" display: flex; font-weight: bold; flex-direction: column; justify-content: center; margin-top: 120px; margin-left: 70px; letter-spacing: 1px;">
        <li>Our site is Free & will always stay free :)
        <li>Start chatting to anyone, just by clicking his\her id!
        <li>Well, Enjoy!
        <li>Stay at home, Stay safe!
        <li>Be social.!
</ul> 
</div>
</div>
</div>
</body>


<?php //ALL SCRIPTS ARE WRITTEN HERE ?>

<?php 
                                                                      //FUNCTIONS AND AJAX CODE
 ?>
<script>
                                                                      // When the user clicks on div, open the popup
  function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
  }
</script>

<script>


$(document).ready(function(){                                          //CREATES SEARCH BOX
  $('#searchbox').click(function(){
    $.get('createbox.php',function(data,status){
      $('#load').html(data);
         });
       });
     });


 $(document).ready(function(){                                        //INSERTS MESSAGE TO MESSAGE TABLE
   $('#send').click(function(){
      $.ajax({
         url:"InsertMessage.php",
           method:"POST",
              data:{
                      fromUser:$("#fromUser").val(),
                      toUser:$("#toUser").val(),
                      message:$("#message").val()
                    },
               datatype:"text",
               success:function(data){
                       $("#message").val("");
                                     }
            });
         });


      <?php                                                           //SHOWS MESSAGES AS WE DO, REFRESHES THE PAGE IN 1.5 SEC
         if(isset($_GET["username"])){
             
            echo' setInterval(function(){
               $.ajax({
                  url:"realTimeChat.php",
                     method:"POST",
                        data:{
                               fromUser:$("#fromUser").val(),
                               toUser:$("#toUser").val()
                              },
                        datatype:"text",
                        success:function(data){
                            $("#msgBody").html(data);
                                              }
                     });
                   }, 1500);';
                                          }
       ?>
    });
</script>


<script type="text/javascript">                       //CREATES A DROPDOWN SHOWING NAMES OF USERS EXIST WITH THE PATTERN IN SEARCH
                                                      //BOX      

    function keydown(value)
      {
        $.ajax({
           url:'dropdown.php',
           type:'POST',
           data: {
                   name:value
                 },
           datatype:'text',
           success:function(result){
              $('#sel').html(result);
                                   }
               });
        }
              
</script>
</html>
