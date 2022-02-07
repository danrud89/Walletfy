<?php
session_start();
$register_validate = true;


if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_POST['sign_up']))) {


  if (!isset($_POST['username']) || empty($_POST['username'])) {
    $register_validate = false;
    $_SESSION['loginStatus'] = "Username is required !";
    $_SESSION['loginStatusCode'] = "error";
    header('location: register.php');
  }
  if (strlen($_POST['username']) < 3) {
    $register_validate = false;
    $_SESSION['loginStatus'] = "Username must contain minimum 3 characters!";
    $_SESSION['loginStatusCode'] = "error";
    header('location: register.php');
  }
  if (preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']) === false) {
    $register_validate = false;
    $_SESSION['loginStatus'] = "Must contain letters, numbers, and underscores.";
    $_SESSION['loginStatusCode'] = "error";
    header('location: register.php');
  }
  if (!isset($_POST['email']) || empty($_POST['email'])) {
    $register_validate = false;
    $_SESSION['emailStatus'] = "E-mail is required !";
    $_SESSION['emailStatusCode'] = "error";
    header('location: register.php');
  }
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
    $register_validate = false;
    $_SESSION['emailStatus'] = "Invalid e-mail syntax !";
    $_SESSION['emailStatusCode'] = "error";
    header('location: register.php');
  }
  if (!isset($_POST['password']) || empty($_POST['password'])) {
    $register_validate = false;
    $_SESSION['passwordStatus'] = "Password is required !";
    $_SESSION['passwordStatusCode'] = "error";
    header('location: register.php');
  }
  if ((strlen($_POST['password']) < 8) || (strlen($_POST['password']) > 20)) {
    $register_validate = false;
    $_SESSION['passwordStatus'] = "Password must contain beetween 8 ÷ 20 characters!";
    $_SESSION['passwordStatusCode'] = "error";
    header('location: register.php');
  }
  if ($_POST['password'] != $_POST['confpassword']) {
    $register_validate = false;
    $_SESSION['passwordStatus'] = "Passwords do not match";
    $_SESSION['passwordStatusCode'] = "error"; 
    header('location: register.php');
  }

  $name = filter_input(INPUT_POST, 'username');
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $password = filter_input(INPUT_POST, 'password');
  $confpassword = filter_input(INPUT_POST, 'confpassword');

  require_once "database.php";
  // check the database to make sure user with the same login or email do not exist
  $user_name_check_query = "SELECT COUNT(name) AS userLoginCounter FROM users WHERE name = :name" ;
  $user_name_stmt = $db->prepare($user_name_check_query);
  $user_name_stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $user_name_stmt->execute();
  $userName = $user_name_stmt->fetch(PDO::FETCH_ASSOC);

  if ($userName['userLoginCounter'] > 0) { 
    $_SESSION['loginStatus'] = "Login already taken !";
    $_SESSION['loginStatusCode'] = "error";
    $register_validate = false;
    header('location: register.php');
    exit();
  } 

  $user_email_check_query = "SELECT COUNT(email) AS userEmailCounter FROM users WHERE email = :email" ;
  $user_email_stmt = $db->prepare($user_email_check_query);
  $user_email_stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $user_email_stmt->execute();
  $userEmail = $user_email_stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($userEmail['userEmailCounter'] > 0) { 
    $_SESSION['emailStatus'] = "E-mail already taken !";
    $_SESSION['emailStatusCode'] = "error";
    $register_validate = false;
    header('location: register.php');
    exit();
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
    $new_user_query = $db -> prepare("SELECT id, name FROM users WHERE email = :email");
    $new_user_query->bindValue(':email', $email, PDO::PARAM_STR);
    $new_user_query -> execute();
    $newUser = $new_user_query -> fetch();

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
      $sql_insert_expenses_template_default = "INSERT INTO expenses_category_assigned_to_users (user_id, purpose) 
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
    header('location: welcomeMessage.php');
    exit();
  }
} else {
  $_SESSION['serwerStatus'] = "Oooops...something went wrong ! Please try again later.";
  $_SESSION['serwerStatusCode'] = "error";
  header('Location: register.php');
  exit();
}
