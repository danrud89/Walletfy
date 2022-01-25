<?php
session_start();

// initializing variables
$name = $email = "";
$password = $confpassword = "";
$register_validate = true;

if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_POST['sign_up']))) {

  $name = filter_input(INPUT_POST, 'name');
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $password = filter_input(INPUT_POST, 'password');
  $confpassword = filter_input(INPUT_POST, 'confpassword');

  if (!isset($name) || empty($name)) {
    $register_validate = false;
    $_SESSION['loginStatus'] = "Username is required !";
    $_SESSION['loginStatusCode'] = "error";
    header('location: register.php');
  }
  if (strlen($name) < 3) {
    $register_validate = false;
    $_SESSION['loginStatus'] = "Username must contain minimum 3 characters!";
    $_SESSION['loginStatusCode'] = "error";
    header('location: register.php');
  }
  if (preg_match('/^[a-zA-Z0-9_]+$/', $name) === false) {
    $register_validate = false;
    $_SESSION['loginStatus'] = "Must contain letters, numbers, and underscores.";
    $_SESSION['loginStatusCode'] = "error";
    header('location: register.php');
  }
  if (!isset($email) || empty($email)) {
    $register_validate = false;
    $_SESSION['emailStatus'] = "E-mail is required !";
    $_SESSION['emailStatusCode'] = "error";
    header('location: register.php');
  }
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $register_validate = false;
    $_SESSION['emailStatus'] = "Invalid e-mail syntax !";
    $_SESSION['emailStatusCode'] = "error";
    header('location: register.php');
  }
  if (!isset($password) || empty($password)) {
    $register_validate = false;
    $_SESSION['passwordStatus'] = "Password is required !";
    $_SESSION['passwordStatusCode'] = "error";
    header('location: register.php');
  }
  if ((strlen($password) < 8) || (strlen($password) > 20)) {
    $register_validate = false;
    $_SESSION['passwordStatus'] = "Must contain beetween 8 ÷ 20 characters!";
    $_SESSION['passwordStatusCode'] = "error";
    header('location: register.php');
  }
  if ($password != $confpassword) {
    $register_validate = false;
    $_SESSION['passwordStatus'] = "Passwords do not match";
    $_SESSION['passwordStatusCode'] = "error"; 
    header('location: register.php');
  }

  require_once "database.php";
  // check the database to make sure 
  // a user with the same login do not exist
  $user_existance_check_query = "SELECT name, email FROM users WHERE name = :name OR email = :email" ;
  $user_stmt = $db->prepare($user_existance_check_query);
  $user_stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $user_stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $user_stmt->execute();
  $user = $user_stmt->fetch();

  if ($user['name'] === $name) { 
    $_SESSION['loginStatus'] = "Login already taken !";
    $_SESSION['loginStatusCode'] = "error";
    $register_validate = false;
    header('location: register.php');
  }

  if ($user['email'] === $email) { 
    $_SESSION['emailStatus'] = "E-mail already taken !";
    $_SESSION['emailStatusCode'] = "error";
    $register_validate = false;
    header('location: register.php');
  }
  // register user if there are no errors in the form
  if ($register_validate) {
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); 

    try {
      $sql_insert_login = "INSERT INTO users 
      VALUES(NULL, :name, :encryptedPassword, :email)";
      $query_login = $db->prepare($sql_insert_login);
      $query_login->bindValue(':name', $name, PDO::PARAM_STR);
      $query_login->bindValue(':encryptedPassword', $encryptedPassword, PDO::PARAM_STR);
      $query_login->bindValue(':email', $email, PDO::PARAM_STR);
      $query_login->execute();
    } catch (PDOException $e) {
      echo "DataBase Error: Register failed.<br>" . $e->getMessage();
    } catch (Exception $error) {
      echo "Application Error: Register failed.<br>" . $error->getMessage();
    }

    //assign to user: incomes,expenses,payment defaults templates of db tables
    try {
      $sql_insert_incomes_template_default = "INSERT INTO incomes_category_assigned_to_users (user_id, name) 
        SELECT users.id, incomes_category_default.name 
        FROM users, incomes_category_default
        WHERE users.email= :email";
      $query_incomes = $db->prepare($sql_insert_incomes_template_default);
      $query_incomes->bindValue(':email', $email, PDO::PARAM_STR);
      $query_incomes->execute();
    } catch (PDOException $e) {
      echo "DataBase Error: Failed to complete request.<br>" . $e->getMessage();
    } catch (Exception $error) {
      echo "Application Error: Failed to complete request.<br>" . $error->getMessage();
    }

    try {
      $sql_insert_expenses_template_default = "INSERT INTO expenses_category_assigned_to_users (user_id, name) 
        SELECT users.id, expenses_category_default.name 
        FROM users, expenses_category_default 
        WHERE users.email= :email";
      $query_expenses = $db->prepare($sql_insert_expenses_template_default);
      $query_expenses->bindValue(':email', $email, PDO::PARAM_STR);
      $query_expenses->execute();
    } catch (PDOException $e) {
      echo "DataBase Error: Failed to complete request.<br>" . $e->getMessage();
    } catch (Exception $error) {
      echo "Application Error: Failed to complete request.<br>" . $error->getMessage();
    }
    try {
      $sql_insert_payment_template_default = "INSERT INTO payment_methods_assigned_to_users (user_id, name) 
        SELECT users.id, payment_methods_default.name 
        FROM users, payment_methods_default 
        WHERE users.email= :email";
      $query_payment = $db->prepare($sql_insert_payment_template_default);
      $query_payment->bindValue(':email', $email, PDO::PARAM_STR);
      $query_payment->execute();
    } catch (PDOException $e) {
      echo "DataBase Error: Failed to complete request.<br>" . $e->getMessage();
    } catch (Exception $error) {
      echo "Application Error: Failed to complete request.<br>" . $error->getMessage();
    }

    $_SESSION['logged_id'] = $user['id'];
    $_SESSION['logged_user'] = $user['name'];
    $_SESSION['successfullyRegistered'] = true;
    unset($_POST['sign_up']);
    header('location: welcomeMessage.php');
    exit();
  }
} else {
  $_SESSION['serwerStatus'] = "Oooops...something went wrong ! Please try again later.";
  $_SESSION['serwerStatusCode'] = "error";
  header('Location: register.php');
  exit();
}
