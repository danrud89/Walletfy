<?php
session_start();

// initializing variables
$login = "";
$password = $confpassword = "";
$username_err = $password_err = $confirm_password_err = $wrong_validation =  "";
$success = "";

// connect to the database
require_once "database.php";
mysqli_report(MYSQLI_REPORT_STRICT);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reg_user'])) {

    // REGISTER USER
    //receive all input values from the form
    $login = strip_tags(trim($_POST['login']));
    $password = strip_tags(trim($_POST['password']));
    $confpassword = strip_tags(trim($_POST['confpassword']));

    // form validation: ensure that the form is correctly filled ...

    if (empty($login)) {
      $_SESSION['username_err'] = "Username is required !";
      header('Location: register.php');
            exit();
    }
    if (empty($password)) {
      $_SESSION['password_err'] = "Password is required !";
      header('Location: register.php');
      exit();
    }
    if ((strlen($login) < 3)) {
      $_SESSION['username_err'] = "Login must contain minimum 3 characters!";
      header('Location: register.php');
      exit();
    }
    if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['login'])) == false) {
      $_SESSION['username_err'] = "Login can only contain letters, numbers, and underscores.";
      header('Location: register.php');
      exit();
    }
    if ((strlen($password) < 8) || (strlen($password) > 20)) {
      $_SESSION['password_err'] = "Password must contain beetween 8 and 20 characters!";
      header('Location: register.php');
      exit();
    }
    if (ctype_alnum($nick) == false) {
      $_SESSION['username_err'] = "Login must contain only letters !";
      header('Location: register.php');
      exit();
    }
    if ($password != $confpassword) {
      $_SESSION['confirm_password_err'] = "The passwords do not match";
      header('Location: register.php');
      exit();
    }

    // first check the database to make sure 
    // a user with the same login exists
        $user_check_query = "SELECT * FROM users WHERE login ='$login' LIMIT 1";
        $query = $db->prepare($user_check_query);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if ($user) { // if user exists in db
          if ($user['login'] === $login) {
            $_SESSION['username_err'] = "login already exists !";
            header('Location: register.php');
            exit();
          }
        }

        // register user if there are no errors in the form
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
          $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); //hash the password before saving in the database

          $query = "INSERT INTO users 
  			  VALUES(NULL, '$login', '$encryptedPassword')"; //save user data into db
          if ($db->query($query) === TRUE) {
            $_SESSION['success']  = "New user added successfully";
          } else {
            $_SESSION['wrong_validation'] = "Ooops! Something went wrong ! Please try again later.";
            header('Location: register.php');
            exit();
          }

          //assign to user incomes,expenses,payment default template of db
           $sql_insert_incomes_template_default = "INSERT INTO incomes_category_assigned_to_users (user_id, name) 
           SELECT users.id, incomes_category_default.name 
           FROM users, incomes_category_default
           WHERE users.login= :login";

           $sql_insert_expenses_template_default ="INSERT INTO expenses_category_assigned_to_users (user_id, name) 
           SELECT users.id, expenses_category_default.name 
           FROM users, expenses_category_default 
           WHERE users.login= :login";

           $sql_insert_payment_template_default ="INSERT INTO payment_methods_assigned_to_users (user_id, name) 
           SELECT users.id, payment_methods_default.name 
           FROM users, payment_methods_default 
           WHERE users.login= :login";

          $_SESSION['login'] = $login;
          $_SESSION['success'] = "You are now logged in";
          header('location: menu.php');
        }
} 
else {
  echo "Oops! Something went wrong. Please try again later.";
  exit();
}
