<?php

include("dbconnection.php");;

$name1="hitesh";
$name2="raj";

$name3=$name1.$name2;

echo "<h1>Our tables</h1><br>";

$query="show tables from chat";
$result=mysqli_query($connection,$query);


while($row=mysqli_fetch_array($result))
{
	if($name3==$row[0])
	echo "Table found";
	else
	{
		$query="create table ".$name3." ( name varchar(20))";
		$rs=mysqli_query($connection,$query);
	echo "Table not found<br>";
}
}

?>