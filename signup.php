<?php
session_start();

// initializing variables
$login = "";
$password = $confpassword = "";
$username_err = $password_err = $confirm_password_err = "";

// connect to the database
require_once "config.php";
mysqli_report(MYSQLI_REPORT_STRICT);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reg_user'])) {
    $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($db === false) {
      die("ERROR: Could not connect. " .mysqli_connect_error());
    } 
    else {
      // REGISTER USER
        //receive all input values from the form
        $login = strip_tags(trim($_POST['login']));
        $password = strip_tags(trim($_POST['password']));
        $confpassword = strip_tags(trim($_POST['confpassword']));

        // form validation: ensure that the form is correctly filled ...

        if (empty($login)) {
          $_SESSION['username_err'] = "Username is required !";
        }
        if (empty($password)) {
          $_SESSION['password_err'] = "Password is required !";
        }
        if ((strlen($login) < 3)) {
          $_SESSION['username_err'] = "Login must contain minimum 3 characters!";
        }
        if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['login'])) == false){
          $_SESSION['username_err'] = "Login can only contain letters, numbers, and underscores.";
      }
        if ((strlen($password) < 8) || (strlen($password) > 20)) {
          $_SESSION['password_err'] = "Password must contain beetween 8 and 20 characters!";
        }
        if (ctype_alnum($nick) == false) {
          $_SESSION['username_err'] = "Login must contain only letters !";
        }
        if ($password != $confpassword) {
          $_SESSION['confirm_password_err'] = "The passwords do not match";
        }

        // first check the database to make sure 
        /* a user does not already exist with the same login
        $user_check_query = "SELECT * FROM accounts WHERE LOGIN ='$login' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
          if ($user['LOGIN'] === $login) {
            $_SESSION['username_err'] = "Username already exists !";
          }
        }

        // register user if there are no errors in the form
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
          $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database

          $query = "INSERT INTO accounts 
  			  VALUES(NULL, '$login', '$encryptedPassword')";
          mysqli_query($db, $query);
          $_SESSION['LOGIN'] = $login;
          $_SESSION['success'] = "You are now logged in";
          header('location: menu.php');
        }
        */
      }  
} 
else {
  echo "Oops! Something went wrong. Please try again later.";
  exit();
}
