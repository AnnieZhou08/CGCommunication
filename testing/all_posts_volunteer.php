<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_volunteer.php';

if (isset($_SESSION['signed_in'])){
//first select the category based on $_GET['cat_id']
$sql = "SELECT
			post_title,
			post_from,
			post_content,
			post_link_id,
			post_id,
			post_user,
			post_date
		FROM
			posts
		ORDER BY
			post_id
		DESC
		";
$result = mysqli_query($link, $sql);


if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysqli_error();
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{		
		echo '<p>All posts<span>_</span></p>';
		echo '<a class ="item" href = "index_volunteer.php"> Home </a> - <a class = "item" href = "create_post_volunteer.php"> Create a Post </a> <br> <br> <br>';
		
		
		//display category data
		while($post_row = mysqli_fetch_assoc($result))
		{
					echo '<tr>';
							echo '<h2><a href="post.php?id=' . $post_row['post_link_id'] . '">' . $post_row['post_title'] . '</a><br /><h2>';
							echo '<h5 style = "margin-top: -1.5%; color: #8B8B8B;">'.$post_row['post_user'] .'&nbsp;&nbsp;&nbsp;'.$post_row['post_date'].'<h5>';
							echo '<h4>'.$post_row['post_content'].'</h4>';
					echo '</tr>';
	
		}
					
	}
}
}
else
{
	echo 'Please Login to Proceed';
}

?>