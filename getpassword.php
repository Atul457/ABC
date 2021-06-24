<?php

//SENDS THE PASSWORD OF THE ENTERED EMAIL, WHEN THE AJAX FROM INDEX FILE REQUESTS

include("dbconnection.php");
$email=$_POST["email"];

$query="select * from registration where email='$email'";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($result))
{
	echo 'Your password is: '.$row["password"];
}



?>