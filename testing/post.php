<?php
//message.php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_volunteer.php';

$postid = $_GET['id'];
$sql = "SELECT
			post_id,
			post_title,
			post_from,
			post_link_id,
			post_content
		FROM
			posts
		WHERE
			post_link_id = $postid ";
			
$result = mysqli_query($link, $sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This post doesn&prime;t exist.';
	}
	else
	{
		while($posts_row = mysqli_fetch_assoc($result))
		{
			$sql2 = "SELECT
						User_ID,
						Username
					 FROM
						user
					 WHERE
						User_ID = " . mysqli_real_escape_string($link, $posts_row['post_from']);
			$result1 = mysqli_query($link, $sql2);
			if(!$result1)
			{
				echo 'Poster information cannot be retrieved.';
			}
			else
			{
				$posts_row1 = mysqli_fetch_assoc($result1);
				echo '<p>'. htmlentities(stripslashes($posts_row['post_title'])) .' <span>_</span></p>';
				echo '<a class="item" href = "index.php">Home</a>-<a class = "item" href = "create_msg.php">Send a Message</a>-<a class = "item" href = "all_posts.php">Go Back</a><br> <br> <br>';
				echo '<br> <br>
					<h5>' . htmlentities(stripslashes($posts_row1['Username'])) . ' </h5>
					<h2>' . htmlentities(stripslashes($posts_row['post_content'])) . '</h2>
					';
			}
		}
	}
	//show reply box
	/*
	echo '<tr><td colspan="2"><h2>Reply:</h2><br />
		 <form method="post" action="reply.php?id=' . $_GET['id'] . '">
		 <textarea name="reply-content"></textarea><br /><br />
		 <input type="submit" value="Submit reply" />
		 </form></td></tr>';
	*/
	//finish the table
	echo '</table>';
}



?>
