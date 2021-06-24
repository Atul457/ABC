<?php

//SENDING ITEMS TO THE SELECT LIST BOX 

require_once("dbconnection.php");
$name=$_POST["name"];
$query="select * from registration where username like '$name%'";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($result))
{
	
	?>
		<option value="<?php echo $row['username']; ?>.html"><?php echo $row["username"] ?></option> 
	<?php

}


?>