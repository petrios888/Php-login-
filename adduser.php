<?php   // adduser.php

// PHP code

$forename = $surname = $username = $password = $age = $email = "";


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


* Class for executing external commands.
 *
 * @category Jyxo
 * @package Jyxo\Shell
 * @copyright Copyright (c) 2005-2011 Jyxo, s.r.o.
 * @license https://github.com/jyxo/php/blob/master/license.txt
 * @author Ondřej Procházka
 * @author Matěj Humpál
 */
class Client
{
	/**
	 * List of running processes.
	 *
	 * @var array
	 */
	protected $processList;
	/**
	 * Actual working directory.
	 *
	 * @var string
	 */
	protected $cwd;
	/**
	 * Environment properties.
	 *
	 * @var array
	 */
	protected $env = [];
	/**
	 * Stdout output.
	 *
	 * @var string
	 */
	protected $out;
	/**
	 * Stderr output.
	 *
	 * @var string
	 */
	protected $error;
	/**
	 * Constructor.
	 *
	 * @param string $cwd Working directory
	 * @param array $env Array of environment properties
	 */
	public function __construct(string $cwd = '', array $env = [])
	{
		$this->setCwd($cwd);
		$this->env = $_ENV;
		$this->setEnv($env);
	}
	/**
	 * Returns a list of processes.
	 *
	 * Works only on Linux.
	 *
	 * @return \Jyxo\Shell\Client
	 */
	public function loadProcessList(): self
	{
		$output = shell_exec('ps aux');
		$data = explode("\n", $output);
		foreach ($data as $value) {
			$value = preg_replace('/ +/', ' ', $value);
			$list = explode(' ', $value);
			$commands[$list[10]][] = $list[1];
		}
		$this->processList = $commands;
		return $this;
	}
	/**
	 * Checks if there is a process of the given name.
	 *
	 * Works only on Linux.
	 *
	 * @param string $name Process name
	 * @return boolean
	 */
	public function processExists(string $name): bool
	{
		return array_key_exists($name, $this->processList);
	}
	/**
	 * Kills all processes of the given name.
	 *
	 * Works only on Linux.
	 *
	 * @param string $name Process name
	 * @return \Jyxo\Shell\Client
	 */
	public function killProcess(string $name): self
	{
		shell_exec('killall -s KILL ' . $name);
		return $this;
	}
	/**
	 * Sets working directory.
	 *
	 * Defaults to null.
	 *
	 * @param string $cwd Working directory
	 * @return \Jyxo\Shell\Client
	 */
	public function setCwd(string $cwd = ''): Client
	{
		$this->cwd = $cwd;
		return $this;
	}
	/**
	 * Adds one or more environment properties.
	 *
	 * @param array $env Array of properties
	 * @return \Jyxo\Shell\Client
	 */
	public function setEnv(array $env): Client
	{
		$this->env = array_merge($this->env, $env);
		return $this;
	}
	/**
	 * Removes environment properties.
	 *
	 * @return \Jyxo\Shell\Client
	 */
	public function clearEnv(): Client
	{
		$this->env = $_ENV;
		return $this;
	}
	/**
	 * Executes an external command.
	 *
	 * Captures stdout and stderr.
	 * Throws an exception on status code != 0.
	 *
	 * @param string $cmd Command to execute
	 * @param integer $status Status code
	 * @return \Jyxo\Shell\Client
	 * @throws \Jyxo\Shell\Exception On execution error
	 */
	public function exec(string $cmd, int &$status = null): Client
	{
		static $descriptorSpec = [
			0 => ['pipe', 'r'],
			1 => ['pipe', 'w'],
			2 => ['pipe', 'w']
		];
		$env = $this->env;
		if (ini_get('safe_mode')) {
			// If the safe_mode is set on, we have to check which properties we are allowed to set.
			$allowedPrefixes = explode(',', ini_get('safe_mode_allowed_env_vars'));
			$protectedVars = explode(',', ini_get('safe_mode_protected_env_vars'));
			// Throw away protected properties.
			$env = array_diff_key($env, array_fill_keys($protectedVars, true));
			// Throw away properties that do not have the allowed prefix.
			foreach ($env as $name => $value) {
				foreach ($allowedPrefixes as $prefix) {
					// Empty prefix - allow all properties.
					if ($prefix === '') {
						break 2;
					}
					if (substr($name, 0, strlen($prefix)) == $prefix) {
						continue 2;
					}
				}
				unset($env[$name]);
			}
		}
		$cmd = (string) $cmd;
		$process = proc_open($cmd, $descriptorSpec, $pipes, !empty($this->cwd) ? $this->cwd : null, !empty($env) ? $env : null);
		if (!is_resource($process)) {
			throw new Exception('Unable to start shell process.');
		}
		$this->out = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
		$this->error = stream_get_contents($pipes[2]);
		fclose($pipes[2]);
		$status = proc_close($process);
		if ($status !== 0) {
			throw new Exception(
				'Command ' . $cmd . ' returned code ' . $status
					. '. Output: ' . $this->error
			);
		}
		return $this;
	}
	/**
	 * Returns stdout contents.
	 *
	 * @return string
	 */
	public function getOut(): string
	{
		return $this->out;
	}
	/**
	 * Returns stderr contents.
	 *
	 * @return string
	 */
	public function getError(): string
	{
		return $this->error;
	}
}




?>
