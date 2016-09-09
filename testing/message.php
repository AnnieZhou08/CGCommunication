<?php
//message.php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_volunteer.php';

echo '<p>Your Messages</p>';
echo '<a class = "item" href = "index.php"> Home </a> - <a class = "item" href = "view_message.php"> Your Contacts </a> <br> <br>';

$sql = "SELECT
			message_id,
			message_to,
			message_from,
			message_link_id,
			message_content,
			message_sent_date
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
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($messages_row = mysqli_fetch_assoc($result))
		{
			$sql2 = "SELECT
						User_ID,
						Username,
						Sent_Date
					 FROM
						user
					 WHERE
						User_ID = " . mysqli_real_escape_string($link, $messages_row['message_from']);
			$result1 = mysqli_query($link, $sql2);
			if(!$result1)
			{
				echo 'Message sender information cannot be retrieved.';
			}
			else
			{
				$messages_row1 = mysqli_fetch_assoc($result1);
				echo '<br> <br> <tr class="message">
					<td class="user-message">' . htmlentities(stripslashes($messages_row1['Username'])) . '</td>
					<td class="message-content">' . htmlentities(stripslashes($messages_row['message_content'])) . '</td>
					</tr>';
				echo '<td class="sent-date">';
				echo '<h4>' . htmlentities(stripslashes($messages_row['message_sent_date'])) . ' </h4>';
				echo '</td>';
			}
		}
	}
	//show reply box
	echo '<tr><td colspan="2"><h2>Reply:</h2><br />
		 <form method="post" action="reply.php?id=' . $_GET['id'] . '">
		 <textarea name="reply-content"></textarea><br /><br />
		 <input type="submit" value="Submit reply" />
		 </form></td></tr>';
			
	//finish the table
	echo '</table>';
}



?>