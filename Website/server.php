<?php
session_start();

$username = "";
$email = "";
$errors = array();

// connect to database
$db = mysqli_connect("localhost", "root", "", "lexicom");

// register user
if (isset($_POST['register'])) {
	// receives all values from the form
	$acct_id = rand(0, getrandmax());
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$birth_date = mysqli_real_escape_string($db, $_POST['birth']);
	$email = mysqli_real_escape_string($db, $_POST['email_setup']);
	$username = mysqli_real_escape_string($db, $_POST['username_setup']);
	$password = mysqli_real_escape_string($db, $_POST['password_setup']);

	// make sure form is completely filled
	if (empty($name)) { array_push($errors, "Full name is required."); }
	if (empty($birth_date)) { array_push($errors, "Birthday is required."); }
	if (empty($email)) { array_push($errors, "Email address is required."); }
	if (empty($username)) { array_push($errors, "Username is required."); }
	if (empty($password)) { array_push($errors, "Password is required."); }

	$account_check_query = "SELECT * FROM account WHERE acct_id = '$acct_id' OR username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $account_check_query);
	$account = mysqli_fetch_assoc($result);

	if($account) {
		if ($account['acct_id'] == $acct_id) {
			$acct_id = rand(0, getrandmax());
		}
		if ($account['username'] == $username) {
			array_push($errors, "Username already taken.");
		}
		if ($account['email'] == $email) {
			array_push($errors, "This email address is already in use.");
		}
	}

	if(count($errors) == 0) {
		//$password = md5($password); // encrypt the password
		$query = "INSERT INTO account(acct_id, name, birth_date, email, username, password) VALUES ('$acct_id', '$name', '$birth_date', '$email', '$username', '$password')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in.";
		header('location: messaging.php');
	}
}

// login user
if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($username)) {
		array_push($errors, "Username required.");
	}
	if (empty($password)) {
		array_push($errors, "Password required.");
	}

	if (count($errors) == 0) {
		//$password = md5($password);
		$query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in.";
			header("location: messaging.php");
		}
		else {
			//array_push($errors, "Your username and/or password is incorrect.");
            echo "<script type='text/javascript'>alert('Incorrect username or password');</script>";
            die("Incorrect username or password.");
		}
	}
}
?>


