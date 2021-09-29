<?php
session_start();

if ( !isset($_POST['email'], $_POST['password']) ) {
    header('Location: index.php');
	exit('Please fill both the email and password fields!');
}
// Prepare SQL to prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	//remember to use password hash i register form !
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions => the user is loggedin
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['id'] = $id;
		echo 'Welcome ' . $_SESSION['email'] . '!';
	} else {
		// Incorrect password
		echo 'Incorrect username and/or password!';
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
}

	$stmt->close();
}
?>
