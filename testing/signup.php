<?php
//signup.php
error_reporting(E_ALL ^ E_NOTICE);
include 'connect.php';
include 'header_signup.php';

/*
$EAL = isset($_POST["EAL"]) ? $_POST["EAL"] : 0;
$AL = isset($_POST["AL"]) ? $_POST["AL"] : 0;
*/

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	/*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
	
    echo '<form method="post" action="" >
    <table> 
       <tr>
              <td align="right">Username:</td>
              <td><input class="input" type="text" name="Username" /></td>
       </tr>
	   
	   <tr>
			  <td align="right">Password: </td>
			  <td><input class="input" type="password" name="Password" /></td>
	   </tr>
	   
	   <tr>
			   <td align="right">E-mail:</td>
               <td><input class="input" type="email" name="Email"></td>
	   </tr>
	</table> 
	<br>
 		<input type="submit" value="Submit"/>
 	 </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['Username']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['Username']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['Username']) > 50)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
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
		
		
		$sql = "INSERT INTO
					user(Username, Email, Password, User_Level)
				VALUES('" . mysqli_real_escape_string($link, $_POST['Username']) . "',
					   '" . mysqli_real_escape_string($link, $_POST['Email']) . "',
					   '" . mysqli_real_escape_string($link, $_POST['Password']) . "',
					   0
					  )";
		/*
						'" . mysqli_real_escape_string($link, $_POST['sfname']) . "',
						'" . mysqli_real_escape_string($link, $_POST['slname']) . "'		
						'" . mysqli_real_escape_string($link, $_POST['DOB']) . "',
						'" . mysqli_real_escape_string($link, $_POST['enrolldate']) . "',
						$EAL, $AL
		*/	
		$result = mysqli_query($link, $sql);
		
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo 'Successfully registered. Please wait for approval.';
		}
	}
}

?>