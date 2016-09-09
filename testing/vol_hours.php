<?php
include 'connect.php';
include 'header_volhours.php';

echo '<form method="post" action="" >
    <table> 
	   <tr>
			  <td align="right">Number of Hours: </td>
			  <td><input class="input" type="number" step="0.5" name="hours" /></td>
	   </tr>
	   <tr>
			  <td align="right">Username: </td>
			  <td><input class="input" type="text" name="username"/></td>
	   </tr>
	</table>
	 <br>
 		<input type="submit" value="Submit" name="submit"/>
	 </form>';
	 
if(isset($_POST['submit']))
{
	$hours = $_POST['hours'];
	$username = $_POST['username'];
	$query = mysqli_query($link, "SELECT Hours FROM user WHERE Username = '$username'");
	
	if(mysqli_num_rows($query)>0)
	{
		$row = mysqli_fetch_assoc($query);
		
		$db_hours = $row['Hours'];
		$new_hours = $db_hours + $hours;
		mysqli_query($link, "UPDATE user SET Hours = '$new_hours' WHERE Username = '$username'"); 
		echo "<br> <br> Your hours have been updated <br>";
		echo "You now have '$new_hours' Hours";
	}
	else {
		echo "That username is invalid.";
	}
	
}

?>