<?php

include 'connect.php';
include 'header_volunteer.php';

if (isset($_SESSION['signed_in'])){
echo '<p> Your Contacts </p>';
echo '<br><a class = "item" href = "index.php">Home</a>-<a class = "item" href = "create_msg.php">Send a Message</a> <br> <br>';
//$result = mysql_query($sql);
//Note: mysql_connect, mysql_select_db, and mysql_query are deprecated.
$sql2 = "SELECT
			User_ID,
			Username,
			Sent_Date
		 FROM
			user
		"
		or die("Error in the consultation.." . mysqli_error($link));
$result1 = mysqli_query($link, $sql2);
			
if(!$result1)
{
	echo 'The categories could not be displayed, or there is no posts for you. Please try again later.';
}
else
{
	if(mysqli_num_rows($result1) == 0)
	{
		echo 'you do not have any contacts yet.';
	}
	else
	{
		//prepare the table
		
		echo '<table border="1">
			  <tr>
				<th>Your Contacts</th>
				<th>Last Message</th>
			  </tr>';

			while($row1 = mysqli_fetch_assoc($result1)){
				$sql = "SELECT
							message_id,
							message_content,
							message_to,
							message_from,
							message_link_id,
							message_sent_date
						FROM
							messages
						WHERE
							message_to  = " . htmlentities($_SESSION['user_id']) . "
						AND
							message_from = " . htmlentities($row1['User_ID']) . "
						OR
							message_from = ". htmlentities($_SESSION['user_id']) . "
						AND
							message_to = " . htmlentities($row1['User_ID']) . "
						ORDER BY
							message_id
						DESC
						"
				or die("Error in the consultation.." . mysqli_error($link));
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_assoc($result);
				
				echo '<tr>';
				echo '<td class="leftpart">';
				echo '<h4><a href="message.php?id=' . $row1['User_ID'] . '">' . $row1['Username'] . '</a></h4>';
				echo '</td>';
				if ($row1['User_ID']==$row['message_from'] || $row1['User_ID']==$row['message_to']){
					echo '<td class="rightpart">';
					echo '<h4>' .$row['message_content'] . ' at ' . $row['message_sent_date'] . '</h4>';
					echo '</td> </tr>';
				}
				else{
					echo '<td></td>';
				} 
			}
			echo '</tr>';
	}
		echo '</table>';
}
}
else
{
	echo 'Please Login to Proceed';
}

?>