<?php
//create_cat.php
error_reporting(E_ALL ^ E_NOTICE);

include 'connect.php';
include 'header_volunteer.php';

echo '<p>Create an event</p>';
echo '<a class = "item" href = "index.php">Home</a>-<a class = "item" href = "calendar.php">Event Calendar</a>';

if(isset($_SESSION['signed_in'])&& $_SESSION['user_level']==1)
{
//the user has admin rights
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
		//the form hasn't been posted yet, display it
	echo '<form style = "margin-top:5% " method="post" action="">
	      <table style="color:black;"> 
			<tr>
				<td align="right">Event title:</td>
				<td><input class="input" type="text" name="title" /></td>
			</tr>
			<tr>
			    <td align="right">Event description:</td>
				<td><textarea name="event_details" /></textarea></td>
			</tr>	
			<tr>
				<td align="right">Event date (yyyy-mm-dd):</td>
				<td><input class="input" type="text" name="event_date" /></td>
			</tr>
			   
			<br /><br />
			</table>	
			<input type="submit" value="Add event" />
		 </form>';
}
else
{
		//the form has been posted, so save it
		$sql = "INSERT INTO events(title, event_details, event_date, event_creation_date)
		   VALUES('" . mysqli_real_escape_string($link,$_POST['title']) . "',
				 '" . mysqli_real_escape_string($link,$_POST['event_details']) . "',
				 '" . mysqli_real_escape_string($link,$_POST['event_date']) . "',
				 NOW()
				 )";
		$result = mysqli_query($link, $sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysqli_error();
		}
		else
		{
			echo '<br> <br> New event successfully added.';
		}
}
}
else
{
	echo 'Please login from an administrative account to proceed';
}


?>