<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_volunteer.php';

if (isset($_SESSION['signed_in'])){
echo '<p>Create a Post <span>_</span></p>';
echo '<a class = "item" href = "index_volunteer.php">Home</a>-<a class="item" href = "all_posts_volunteer.php">View Posts</a>';
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
		
		echo '<form style = "margin-top: 10%" method="post" action="">
			  Post Title: <input type="text" name="post_title"> </br> </br>
			 ';				
						
		echo 'Post Content: <br /><textarea name="post_content" /></textarea><br /><br />
		
			 <input type="submit" value="Create Post" />
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
			echo 'An error occurred while creating your post. Please try again later.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			//echo 'Success with creating your post.. <br>';
			$postid = rand(1000, 10000);
			$sql = "INSERT INTO
						posts(post_title, post_content, post_link_id, post_from, post_user, post_date)
					VALUES('" . mysqli_real_escape_string($link, $_POST['post_title']) . "',
						   '" . mysqli_real_escape_string($link, $_POST['post_content']) . "',
						   '" . mysqli_real_escape_string($link, $postid) . "',
						   '" . $_SESSION['user_id'] . "',
						   '" . $_SESSION['user_name'] . "',
						   NOW()
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
				echo '<br> <br>You have successfully created <a href="post.php?id='. $postid . '">your new post</a>.';
				echo '<br> (Click on "your new post" to view your status)';
			}
		}
	}
}
else
{
	echo 'Please Login to Proceed';
}




?>