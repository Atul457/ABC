<?php

$connection=mysqli_connect("localhost","root","","chat");

if($connection)
{
	?>
	<script type="text/javascript">
		
	</script>
	<?php
}
else
{
	?>
	<script type="text/javascript">
		alert("Failed to conneet");
	</script>
	<?php
}

?>