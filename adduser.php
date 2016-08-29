<?php   // adduser.php

// PHP code

$forename = $surname = $username = $password = $age = $email = "";what


if (isset($_POST['forename']))
	$forename = fix_string($_POST['forename']);
if (isset($_POST['surname']))
	$surname = fix_string($_POST['surname']);
if (isset($_POST['username']))
	$username = fix_string($_POST['username']);
if (isset($_POST['password']))
	$password = fix_string($_POST['password']);
if (isset($_POST['age']))
	$forename = fix_string($_POST['age']);
if (isset($_POST['email']))
	$surname = fix_string($_POST['email']);

$fail = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_username($username);
$fail .= validate_password($password);
$fail .= validate_age($age);
$fail .= validate_email($email);

echo "<!DOCTYPE html>\n<html><head><title>An Example Form<>/title";

if ($fail == "")
{
echo "</head><body>Form data successfully validated
	$forname,$surname,$username,$password,$age,$email.</body></html";
	
	
	
	// This is where you would enter the posted fields into a database,
	// preferably using hash encryption for the password

	exit;
}

echo <<<_END

<!-- The HTML/Javascript section -->
	

		<style>
			.signup {
			border: 1px solid #999999;
			font: normal 14px helvetica;
			color:#44444;
			}
		</style>  
		<script>
			function validate(form)
			{
			fail = validateForename(form.forename.value)
			fail += validateSurname(form.surname.value)
			fail += validateUsername(form.username.value)
			fail += validatePassword(form.password.value)
			fail += validateAge(from.age.value)
			fail += validateEmail(from.email.value)
	
			if (fail == "") return true
			else { alert(fail); return false}
			}
			function validateForename(field)
			{
				return (field == "") ? "No forename was entered.\n" : ""
			}
			
			function validateSurname(field)
			{
				return (field == "") ? "No Surname was entered.\n" : ""
			}
			
			function validateUsername(field)
			{
			if (field == "") return "No Username was entered.\n"
			else if (field.length < 5)
				return "Username must be at least 5 chracters. \n"
			else if (/[^a-zA-Z0-9_-]/.test(field))
				return "Only a-z,A-z,0-9, - and_allowed in Usernames.\n"
			return ""			
			}
			function validatePassword(field)
			{
				if (field == "") return "No Password was entered.\n"
					else if(field.length < 6)
						return "Password must be at least 6 characters.\n"
				else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) || !/[0-9]/.test(field))
					return "Password require on each of a=z, A-z, 0-9\n"
				return ""
			}
			function validateAge(field)
			{
				if (field == "" || isNaN(field)) return "No Age was entered.\n"
					else if (field < 18 || field > 110)
						return "Age must be between 18 and 110.\n"
				return ""
			}
			function validateEmail(field)
			{
				if (field =="") return "No Email was entered.\n"
					else if (!((field.index0f(".") > 0) && (field.index0f("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
						return "The email address is invalid. \n"
				return ""
			}
		
		</script>
		</head>
		<body>
			<table class = "signup" border = "0" cellpadding="2" cellspacing="10" bgcolor="#eeeeee">
				<th colspan="3" align="center" >Signup Form</th>
			<form method="post" action="adduser.php" onsubmit="return validate(this)">
				<tr><td>Forname</td>
					<td><input type="text" maxlength="32" name="forename"></td></tr>
				<tr><td>Surname</td>
					<td><input type="text" maxlength="32" name="surname"></td></tr>
				<tr><td>Username</td>
					<td><input type="text" maxlength="16" name="username"></td></tr> 
				<tr><td>Password</td>
					<td><input type ="text" maxlength="12" name="password"></td></tr>
				<tr><td>Age</td>
					<td><input type="text" maxlength="3" name="age"></td></tr> 
				<tr><td>Email</td>
					<td><input type ="text" maxlength="64" name="email"></td></tr>
		
				<tr><td colespan="2" align="center"><input type="submit"
				value="Signup"></td></tr>
			</form>
		</table>
	</body>
	</html>
	
_END;


// The PHP functions

function validate_forename($field)
{
	return ($field == "") ? "No forename was entered<br>": "";	
}

function validate_surname($field)
{	return ($field == "")  ? "No Surname was entered<br>" : "";

}


function validate_username($field)
{
	if ($field == "") return "No Username was entered<br>"; 
	else if (strlen($field) < 5)
		return "User names must be at least 5 characters<br>";
	else if(preg_match("/[a-zA-Z0-9_-]/", $field))
		return "Only letters, numbers,  - and_ in user names<br>";
	return "";
}
function validate_password($field)
	
{	
if ($field == "") return "No Password was entered<br>";	
else if (strlen($field) < 6)
	return "Password must longer than six chracters"
else if (!preg_match("/[a-z]/", $field) || !preg_match("/[A-Z]/", $field) || !preg_match("/[0-9]/", $field))
	return "Passwords require 1 each of a-z, A-Z, and 0-9 <br>" ;
return "";
	}

function validate_age($field)
{
	if($field == "") return "No Age was entered <br>";
	else if ($field < 18 || $field > 110 )
		return "Age must over 18 years old and 110<br>";
	return "";	
}

function validate_email($field)
{
	if ($field == ""             ) return "NO email was found!!!"
	else if(!((strpos($field, ".") > 0) && (strpos($field, "@"))) || preg_match("/[^a-zA-Z0-9.@_-]/", $field))
		return "The email address invalid<br>";
	
	return "";	
}

function fix_string($string)
{
	if (get_magic_quotes_gpc()) $string = stripsashes($string);
	return htmlentites ($string);
}

?>