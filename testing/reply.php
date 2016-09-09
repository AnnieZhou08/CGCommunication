<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_volunteer.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		$messageid = mysqli_real_escape_string($link, $_GET['id']);
		$sql1 = "SELECT
					message_to,
					message_from,
					message_link_id,
					message_sent_date
				 FROM
					messages
				 WHERE
				    message_link_id = $messageid
				";
		$result = mysqli_query($link, $sql1);
		
		if(!$result)
		{
			echo 'Sorry, the message cannot be retrieved';
		}
		else
		{
			$message_row= mysqli_fetch_assoc($result);
			$messageto = mysqli_real_escape_string($link, $_GET['id']);
			//a real user posted a real reply
				$sql = "INSERT INTO
						messages(message_content, message_to, message_from, message_link_id, message_sent_date)
					VALUES('" . mysqli_real_escape_string($link, $_POST['reply-content']) . "',
						   '" . mysqli_real_escape_string($link, $_GET['id']) . "',
						   '" . $_SESSION['user_id'] . "',
						   '" . mysqli_real_escape_string($link, $_GET['id']) . "',
						   NOW()
					       )";
				$msgfrom = $_SESSION['user_id'];
				$sql2 = "UPDATE user SET Sent_Date = NOW() WHERE User_ID = '$msgfrom'";
						
			$result = mysqli_query($link, $sql);
			$result1 = mysqli_query($link, $sql2);
						
			if(!$result||!$result1)
			{
				echo 'Your reply has not been saved, please try again later.';
			}
			else
			{
				echo '<p>Message Sent </p><a class ="item" href = "index.php"> Home </a> - <a class = "item" href = "view_message.php"> Your Contacts </a> <br> <br> <br>';
				echo 'Your reply has been saved, check out <a href="message.php?id=' . $messageto . '">your messages.</a> <br> (Click on "your messages" to view the message you have sent)';
			}
		}
	}
}


?>