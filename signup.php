<?php
session_start();

// initializing variables
$login = "";
$password = "";
$confpassword = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'walletfy');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $login = mysqli_real_escape_string($db, strip_tags(trim($_POST['login'])));
  $password = mysqli_real_escape_string($db, strip_tags(trim($_POST['password'])));
  $confpassword = mysqli_real_escape_string($db, strip_tags(trim($_POST['confpassword'])));

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($login)) { array_push($errors, "Username is required !"); }
  if (empty($password)) { array_push($errors, "Password is required !"); }
  if ((strlen($login) < 3) || (strlen($login) > 20)) { array_push($errors, "Login must contain beetween 3 and 20 marks!"); }
  if ((strlen($password)<8) || (strlen($password)>20)) { array_push($errors, "Password must contain beetween 3 and 20 marks!"); }
  if (ctype_alnum($nick) == false) { array_push($errors, "Login must contain only letters !"); } 
  if ($password != $confpassword) {array_push($errors, "The passwords do not match");}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM accounts WHERE LOGIN ='$login' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['LOGIN'] === $login) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$encPassword = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database

  	$query = "INSERT INTO accounts 
  			  VALUES(NULL, '$login', '$encPassword')";
  	mysqli_query($db, $query);
  	$_SESSION['LOGIN'] = $login;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: menu.php');
  }
}