<?php
session_start();

// initializing variables
$name = $email = "";
$password = $confpassword = "";
$username_err = $email_err =  $password_err = $confirm_password_err = $wrong_validation =  "";
$success = "";
$register_validate = true;

if (($_SERVER["REQUEST_METHOD"] === "post") && (isset($_POST['reg_user']))) {

    // REGISTER USER
    //receive all input values from the form
    $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $confpassword = !empty($_POST['confpassword']) ? trim($_POST['confpassword']) : null;
    
    // form validation: ensure that the form is correctly filled 

    if (!isset($_POST['name']) || empty($_POST['name'])) {
      $register_validate = false;
      $_SESSION['username_err'] = "Username is required !";
      header('location: register.php');
    }
    if (strlen($_POST['name']) < 3) {
      $register_validate = false;
      $_SESSION['username_err'] = "Login must contain minimum 3 characters!";
      header('location: register.php');
    }
    if (preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name']) == false) {
      $register_validate = false;
      $_SESSION['username_err'] = "Login can only contain letters, numbers, and underscores.";
      header('location: register.php');
    }
    if (!isset($_POST['email']) || empty($_POST['email'])) {
      $register_validate = false;
      $_SESSION['email_err'] = "E-mail is required !";
      header('location: register.php');
    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
      $_SESSION['email_err'] = "Invalid e-mail syntax !";
      header('location: register.php');
    }
    if (!isset($_POST['password']) || empty($_POST['password'])) {
      $register_validate = false;
      $_SESSION['password_err'] = "Password is required !";
      header('location: register.php');
    }
    if ((strlen($_POST['password']) < 8) || (strlen($_POST['password']) > 20)) {
      $register_validate = false;
      $_SESSION['password_err'] = "Password must contain beetween 8 and 20 characters!";
      header('location: register.php');
    }
    if ($_POST['password'] != $_POST['confpassword']) {
      $register_validate = false;
      $_SESSION['confirm_password_err'] = "Passwords do not match"; 
      header('location: register.php');
    }

    // check the database to make sure 
    // a user with the same login do not exist
    $user_check_query = "SELECT COUNT(name) AS num FROM users WHERE name = :name";
    $user_stmt = $db->prepare($user_check_query);
    $user_stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $user_stmt->execute();
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user['num'] > 0) { // if userName exists in db
        $_SESSION['username_err'] = "Login already taken !";
        $register_validate = false;
        header('location: register.php');
    }

    // check the database to make sure 
    // a user with the same email do not exist
    $user_check_query = "SELECT COUNT(name) AS num FROM users WHERE email = :email";
    $user_stmt = $db->prepare($user_check_query);
    $user_stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $user_stmt->execute();
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user['num'] > 0) { // if email exists in db
        $_SESSION['email_err'] = "E-mail already taken !";
        $register_validate = false;
        header('location: register.php');
    }
    // register user if there are no errors in the form
    if ($register_validate) {
      // connect to the database
      require_once "database.php";
      $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); //hash the password before saving in the database

      try{
      $sql_insert_login = "INSERT INTO users 
      VALUES(NULL, :name, :encryptedPassword, :email)";
      $query_login = $db->prepare($sql_insert_login);
      $query_login->bindValue(':name', $name, PDO::PARAM_STR);
      $query_login->bindValue(':encryptedPassword', $encryptedPassword, PDO::PARAM_STR);
      $query_login->bindValue(':email', $email, PDO::PARAM_STR);
      $query_login->execute();
      }
      catch (PDOException $e) {
        echo "DataBase Error: Register failed.<br>".$e->getMessage();
      }
      catch(Exception $error)
      {
        echo "Application Error: Register failed.<br>".$error->getMessage();
      }

      if($query_login){
        header('location:welcomeMessage.php');
      }

      //assign to user incomes,expenses,payment default template of db
      try{
        $sql_insert_incomes_template_default = "INSERT INTO incomes_category_assigned_to_users (user_id, name) 
        SELECT users.id, incomes_category_default.name 
        FROM users, incomes_category_default
        WHERE users.email= :email";
        $query_incomes = $db->prepare($sql_insert_incomes_template_default);
        $query_incomes->bindValue(':email', $email, PDO::PARAM_STR);
        $query_incomes->execute();
      }
      catch (PDOException $e) {
        echo "DataBase Error: Failed to complete request.<br>".$e->getMessage();
      }
      catch(Exception $error)
      {
        echo "Application Error: Failed to complete request.<br>".$error->getMessage();
      }

      try{
        $sql_insert_expenses_template_default ="INSERT INTO expenses_category_assigned_to_users (user_id, name) 
        SELECT users.id, expenses_category_default.name 
        FROM users, expenses_category_default 
        WHERE users.email= :email";
        $query_expenses = $db->prepare($sql_insert_expenses_template_default);
        $query_expenses->bindValue(':email', $email, PDO::PARAM_STR);
        $query_expenses->execute();
      }
      catch (PDOException $e) {
        echo "DataBase Error: Failed to complete request.<br>".$e->getMessage();
      }
      catch(Exception $error)
      {
        echo "Application Error: Failed to complete request.<br>".$error->getMessage();
      }
      try{
        $sql_insert_payment_template_default ="INSERT INTO payment_methods_assigned_to_users (user_id, name) 
        SELECT users.id, payment_methods_default.name 
        FROM users, payment_methods_default 
        WHERE users.email= :email";
        $query_payment = $db->prepare($sql_insert_payment_template_default);
        $query_payment->bindValue(':email', $email, PDO::PARAM_STR);
        $query_payment->execute();
      }
      catch (PDOException $e) {
        echo "DataBase Error: Failed to complete request.<br>".$e->getMessage();
      }
      catch(Exception $error)
      {
        echo "Application Error: Failed to complete request.<br>".$error->getMessage();
      }

        $_SESSION['login'] = $user['name'];
        $_SESSION['logged_id'] = $user['id'];
        unset($_POST['reg_user']);
        header('location: index.php');
        exit();
    }  
} 
else {
  echo "<span> Oops! Something went wrong. Please try again later. </span>";
  exit();
}
?>