<?php
session_start();                                                                                             //STARTS THE SESSION
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
    crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Style.css"/>

	<title>Sign-up Sign-in</title>
    <?php

    include("dbconnection.php");
    $username='';
    if(isset($_POST["signup"]))                                     //CHECKS IS THE SIGNUP BUTTON IS CLICKED OR NOT, IF CLICKED THEN
    {                                                               //THE CODE EXECUTES
    $name=$_REQUEST["name"];
    $email=$_REQUEST["email"];
    $password=$_REQUEST["password"];
    for($i=0;$i<strlen($email);$i++){                               //CREATING THE USERNAME FROM THE EMAIL BY TAKING CHARCTERS
        if($email[$i]=='@'){                                        // BEFORE THE @ SYMBOL
            break;
        }
        else{
            $username=$username.$email[$i];
        }
    }
    $checkemail="select * from registration where email='$email'";  //CHECKS WHETHER THE ACCOUNT WITH SAME EMAIL ID EXISTS OR NOT
    $query=mysqli_query($connection,$checkemail);
    
    $emailcount=mysqli_num_rows($query);

    if($emailcount>0)                                               //IF ANY ACCOUNT MATCHES WITH THE EMAIL GIVEN THEN SHOWS ERROR
    {   
       echo'<script>alert("account already exist")</script>';
       header('location:index.php');
    }
    else
    {  
        $_SESSION["name"]=$name;
        $_SESSION["email"]=$email;
        $_SESSION["password"]=$password;
        $_SESSION["username"]=$username;
        
    ?>

    <?php
    $query1="insert into registration values('$name','$email','$password','$username')";    //INSERTING INTO REGISTRATION TABLE
                                                                                            //ON SUCCESS SHOWS USERNAME AND
    $checkregistered=mysqli_query($connection,$query1);                                     //PASSWORD ELSE ERROR

    if($checkregistered)
    {
        ?>
                <?php
                    include("dbconnection.php");
                    $q="select * from registration where username='$username'";
                    $result=mysqli_query($connection,$q);
                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<script> alert('Registered successfully, Your username=".$row['username']." and password=".$row['password']."'); </script>";
                    }

                    ?>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
            alert("Failed to register..");
        </script>
        <?php
    }
}
}

if(isset($_POST["signin"])){                                                        //CHECKING IS THE SIGNIN BUTTON CLICKED OR NOT
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql="Select * from registration where email='".$email."'AND password='".$password."'; ";
    $query=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($query);
    $emailcount=mysqli_num_rows($query);

    if($emailcount>0)               //IF THE NUMBER OF ROWS RETRIEVED IS MORE THAN ONE MEANS ACCOUNT EXITS WITH THE USERNAME & PASS
    {                                                            //AND TAKES US TO THE HOMEPAGE AND THE SENDER NAME IS ALSO BEING 
        $_SESSION["username"]=$row["username"];                  //PLACED IN THE URL
        $val= $_SESSION["username"];
       header('location:Homepage.php?sender='.$val.'');
    }
    else                                                                                         //SHOW ERROR ON ACCOUNT NOT FOUND
    {
        echo "<div style='color:red; border:2px red solid;margin-bottom:5px; border-radius:10px; padding:5px 5px;'>Invalid Inputs . Try again !!!</div>";    
    }
}
    ?>

</head>
<body>
    <h7 id="nu"></h7>
	<div class="container" id="container">
        <div class="form-container sign-up-container">                                 <?php //USED TO SEND DATA TO THE SAME PAGE ?>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
                <h1>Create Account</h1>
                <div class="social-container">                                 <?php //LINKS THE ICONS TO THE CORRESPONDING SITES ?>
                    <a href="https://touch.facebook.com/?stype=lo&jlou=AfdvBsPDbs-5IOMdltVGZKM8Zy5s5Qq6UTgVqtjnCK9sfGDdjtzRMK65xv31Wj4rddnF9tDA-Dt7Xtc5QJw459J60HyNGAvFyJkgS-GRV_rNXg&smuh=44410&lh=Ac9nCykZW9KmeZltf44&_rdr" class ="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://accounts.google.com/ServiceLogin/signinchooser?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="https://www.linkedin.com/login" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                
                <input type="text" placeholder="Name" name="name" autocomplete="off" required> 
                <input type="email" placeholder="Email" name="email" required autocomplete="off">
                <input type="password" placeholder="Password" name="password" required autocomplete="off">
                <input type="submit" value="Sign up" id="button3" name="signup" autocomplete="off"  >
            </form>
        </div>
            <div class="form-container sign-in-container">
                <form action="Index.php" method="post" autocomplete="false">
                    <h1>Sign in</h1>
                    <div class="social-container">                             <?php //LINKS THE ICONS TO THE CORRESPONDING SITES ?>
                        <a href="https://touch.facebook.com/?stype=lo&jlou=AfdvBsPDbs-5IOMdltVGZKM8Zy5s5Qq6UTgVqtjnCK9sfGDdjtzRMK65xv31Wj4rddnF9tDA-Dt7Xtc5QJw459J60HyNGAvFyJkgS-GRV_rNXg&smuh=44410&lh=Ac9nCykZW9KmeZltf44&_rdr" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://accounts.google.com/ServiceLogin/signinchooser?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="https://www.linkedin.com/login" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <div class="ghostwarn1" id="ghostwarn"> *successfully Registered </div>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="password" required>
                     <input type="button" id="gt" value="forgot password?" style="border:none; background-color: transparent;outline: none;">
                    <input type="submit" value="Sign In" id="button3" name="signin">
                    </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>
                            To keep connected with us please login with your personal info
                        </p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p> Enter your personel info </p>
                        <button class="ghost" id="signUp">Sign Up</button>
                        
                    </div>
                </div>
            </div>
        </div>  
<script src="main.js"></script>                                                <?php //FOR EVENTS CODE IS WRITTEN IN MAIN.JS FILE ?>
    <script type="text/javascript">   
        $(document).ready(function(){
             $('#gt').click(function(){
                    $.ajax({

                    url: 'getpassword.php',
                    type: 'POST',
                    data: { email : prompt("Enter your email id")},

                    success: function(result){
                        $('#nu').html(result);
                    }
                });
          });
      });
</script>
</body>
</html>