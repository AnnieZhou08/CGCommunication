<?php
include 'connect.php';
include 'header_volunteer.php';

if(isset($_SESSION['signed_in']))  //Notice: Undefined index, 'user_level'
{
	echo '<br><p style = "margin-top: 5%"> Hello. <b>' . htmlentities($_SESSION['user_name']) . '</b><span>|</span></p></b> <a class="item" href="signout.php" style="right:0px;">Sign out</a> <br> </br>';
	echo '<a class = "item" href="create_event.php"> Create an Event </a> <br>';
	echo '<a class = "item" href="calendar_front.php"> View events </a> <br>';
	echo '<a class = "item" href="create_post.php"> Create a Post </a> <br>';
	echo '<a class = "item" href="all_posts.php"> View All Posts </a> <br>';
	echo '<a class = "item" href="create_msg.php"> Create a Message </a> <br>';
	echo '<a class = "item" href="view_message.php"> View messages </a> <br>';
	echo '<a class = "item" href="list_users.php"> Edit Users </a> <br>';
	echo '<a class = "item" href="change_settings.php?id='.$_SESSION['user_id'].'"> Account Settings </a> <br>';
	/*
	echo '<h2>Create a Message</h2>';
	
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
		
		echo '<form method="post" action="">
			  Subject: <input type="text" name="message_title"> </br> </br>
			 ';
						
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
		echo '<a href = "view_message.php"> View your messages </a>';
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
			echo 'Success with creating your message.. <br>';
			$messageid = rand(1000, 10000);
			$sql = "INSERT INTO
						messages(message_title, message_content, message_to, message_from, message_link_id)
					VALUES('" . mysqli_real_escape_string($link, $_POST['message_title']) . "',
						   '" . mysqli_real_escape_string($link, $_POST['message_content']) . "',
						   '" . mysqli_real_escape_string($link, $_POST['message_to']) . "',
						   '" . $_SESSION['user_id'] . "',
						   '" . mysqli_real_escape_string($link, $messageid) . "'
					       )";
					 
			$result = mysqli_query($link, $sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occurred while inserting your message. Please try again later.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$result = mysqli_query($link, $sql);
			}
			else
			{
				$sql = "COMMIT;";
				$result = mysqli_query($link, $sql);
				//after a lot of work, the query succeeded!
				echo 'You have successfully created <a href="message.php?id='. $messageid . '">your new post</a>.';
			}
		}
	}*/
}
else
{
	echo '<a class="item" href="signin-admin.php">Sign in</a> or <a class="item" href="signup.php">Sign up</a>';
}
?>