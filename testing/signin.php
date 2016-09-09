<?php
//signin.php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_admin_signin.php';

//first, check if the user is already signed in. If that is the case, there is no need to display this page

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	echo 'Please sign out and then sign in again for security. <br> <a href = "signin.php"> sign in </a>';
}
else
{

	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		/*the form hasn't been posted yet, display it
		  note that the action="" will cause the form to post to the same page it is on */
		/* add table to align Input fields */ 
		echo '<form method="post" action="">
			    <table style="color:black;"> 
				<tr>
					<td align="center">Username:</td>
					<td><input type="text" name="user_name" /></td>
				</tr>

				<tr>
					<td align="center">Password:</td>
					<td><input type="password" name="user_pass"></td>
				</tr>
				</table> <br>
				<input type="submit" value="Sign in" />
		 </form>';
	}
	else
	{
		/* so, the form has been posted, we'll process the data in three steps:
			1.	Check the data
			2.	Let the user refill the wrong fields (if necessary)
			3.	Varify if the data is correct and return the correct response
		*/
		$errors = array(); /* declare the array for later use */
		
		if(!isset($_POST['user_name']))
		{
			$errors[] = 'The username field must not be empty.';
		}
		
		if(!isset($_POST['user_pass']))
		{
			$errors[] = 'The password field must not be empty.';
		}
		
		if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
		{
			echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
			echo '<ul>';
			foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
			{
				echo '<li>' . $value . '</li>'; /* this generates a nice error list */
			}
			echo '</ul>';
		}
		else
		{
			//the form has been posted without errors, so save it
			//notice the use of mysql_real_escape_string, keep everything safe!
			//also notice the sha1 function which hashes the password
			$sql = "SELECT 
						User_ID,
						Username,
						Password,
						User_Level
					FROM
						user
					WHERE
						Username = '" . mysqli_real_escape_string($link,$_POST['user_name']) . "'
					AND
						Password = '" . mysqli_real_escape_string($link,$_POST['user_pass']) . "'
					";
						
			$result = mysqli_query($link,$sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'Something went wrong while signing in. Please try again later.';
				//echo mysql_error(); //debugging purposes, uncomment when needed
			}
			else
			{
				//the query was successfully executed, there are 2 possibilities
				//1. the query returned data, the user can be signed in
				//2. the query returned an empty result set, the credentials were wrong
				if(mysqli_num_rows($result) == 0)
				{
					echo 'You have supplied a wrong user/password combination. Please try again.';
				}
				else
				{
					
					//we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
					while($row = mysqli_fetch_assoc($result))
					{
						if ($row['User_Level'] != 1){
							echo 'Your account is pending approval. Please wait until your account has been approved!';
							break;
						}
						else{
						$_SESSION['user_id'] 	= $row['User_ID'];
						$_SESSION['user_name'] 	= $row['Username'];
						$_SESSION['user_level'] = $row['User_Level'];
						echo 'Welcome, ' . $_SESSION['user_name'] . '. <br /><a href="index.php">Proceed to Your . Courtyard Gardens</a>.';
						//set the $_SESSION['signed_in'] variable to TRUE
						$_SESSION['signed_in'] = true;
						}
					}
					
				}
			}
		}
	}

}
?>