<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_volunteer.php';

if (isset($_SESSION['signed_in'])){
echo '<p> Create a Message <span>|</span></p>';
echo '<a class = "item" href = "index_volunteer.php"> Home</a>-<a class = "item" href = "view_message_volunteer.php"> Your Messages </a>';

	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the drop-down
		$sql2 = "SELECT
					User_ID,
					Username
				FROM
					user";
		
		$result2 = mysqli_query($link,$sql2);
		
		echo '<form style = "margin-top: 10% " method="post" action="">';		
		echo 'To:'; 
		echo '<select name="message_to">';
		while($row = mysqli_fetch_assoc($result2))
		{
			echo '<option value="' . $row['User_ID'] . '">' . $row['Username'] . '</option>';
		}
		echo '</select><br /><br />';					
						
		echo 'Message: <br /><textarea name="message_content" /></textarea><br /><br />
		
			 <input type="submit" value="Create Message" />
			 </form>';
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysqli_query($link, $query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occurred while creating your topic. Please try again later.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			//echo 'Success with creating your message.. <br>';
			$sql = "INSERT INTO
						messages(message_content, message_to, message_from, message_link_id, message_sent_date)
					VALUES('" . mysqli_real_escape_string($link, $_POST['message_content']) . "',
						   '" . mysqli_real_escape_string($link, $_POST['message_to']) . "',
						   '" . mysqli_real_escape_string($link, $_SESSION['user_id']) . "',
						   '" . mysqli_real_escape_string($link, $_POST['message_to']) . "',
						   NOW()
					       )";
			$msgfrom = $_SESSION['user_id'];
			$sql2 = "UPDATE user SET Sent_Date = NOW() WHERE User_ID = '$msgfrom'";
					
					 
			$result = mysqli_query($link, $sql);
			$result1 = mysqli_query($link, $sql2);
			if(!$result || !$result1)
			{
				//something went wrong, display the error
				echo 'An error occurred while inserting your message. Please try again later.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$sql2 = "ROLLBACK;";
				$result = mysqli_query($link, $sql);
				$result1 = mysqli_query($link, $sql2);
			}
			else
			{
				$sql = "COMMIT;";
				$sql2 = "COMMIT;";
				$result = mysqli_query($link, $sql);
				$result1 = mysqli_query($link, $sql2);
				//after a lot of work, the query succeeded!
				echo '<div id = "wrapper" style = "margin-top: 5%"> <br> You have successfully created <a href="message.php?id='. $_POST['message_to'] . '">your new message.</a> <br>(Click on "your new message" to view the message you have sent)</br> </div>';
			}
		}
	}
}
else
{
	echo 'Please Login to Proceed';
}

?>