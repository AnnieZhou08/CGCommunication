<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';

//TESTING
//first select the category based on $_GET['cat_id']
$sql = "SELECT
			message_from,
			message_content,
			message_link_id,
			message_to
		FROM
			messages
		WHERE
			message_to = " . htmlentities($_SESSION['user_id']) . "
		AND
			message_from = " . mysqli_real_escape_string($link, $_GET['id']) ."
		OR
			message_from = " . htmlentities($_SESSION['user_id']) . "
		AND
			message_to = ". mysqli_real_escape_string($link, $_GET['id']); 

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
		$sql2 = "SELECT
					User_ID,
					Username
				FROM
					user
				WHERE
					User_ID = " . mysqli_real_escape_string($link, $_GET['id']);
				
					
		$result2 = mysqli_query($link, $sql2);
		$row2 = mysqli_fetch_assoc($result2);
		
		echo '<h2>Messages from &nbsp;' . $row2['Username'] . '</h2><br />';
		//display category data
		while($row = mysqli_fetch_assoc($result))
		{
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3>' . $row['message_content'] . '<br /><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo 'got em';
						echo '</td>';
					echo '</tr>';
		}
					
	}
}


?>