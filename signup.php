<?php
session_start();

// initializing variables
$login = "";
$password = $confpassword = "";
$username_err = $password_err = $confirm_password_err = $wrong_validation =  "";
$success = "";
$register_validate = true;
// connect to the database
require_once "database.php";
mysqli_report(MYSQLI_REPORT_STRICT);
//if (($_SERVER["REQUEST_METHOD"] === "post") && (isset($_POST['reg_user']))) {

    // REGISTER USER
    //receive all input values from the form
    $login = !empty($_POST['login']) ? trim($_POST['login']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $confpassword = !empty($_POST['confpassword']) ? trim($_POST['confpassword']) : null;
    
    // form validation: ensure that the form is correctly filled 

    if (!isset($_POST['login']) || empty($_POST['login'])) {
      $register_validate = false;
      $_SESSION['username_err'] = "Username is required !";
      header('location: register.php');
    }
    if (strlen($_POST['login']) < 3) {
      $register_validate = false;
      $_SESSION['username_err'] = "Login must contain minimum 3 characters!";
      header('location: register.php');
     
    }
    if (preg_match('/^[a-zA-Z0-9_]+$/', $_POST['login']) == false) {
      $register_validate = false;
      $_SESSION['username_err'] = "Login can only contain letters, numbers, and underscores.";
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

    // first check the database to make sure 
    // a user with the same login do not exist
    $user_check_query = "SELECT COUNT(login) AS num FROM users WHERE login = :login";
    $user_stmt = $db->prepare($user_check_query);
    $user_stmt->bindValue(':login', $login, PDO::PARAM_STR);
    $user_stmt->execute();
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user['num'] > 0) { // if user exists in db
        $_SESSION['username_err'] = "login already exists !";
        $register_validate = false;
        header('location: register.php');
    }

    // register user if there are no errors in the form
    if ($register_validate) {
      $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); //hash the password before saving in the database

      $sql_insert_login = "INSERT INTO users 
      VALUES(NULL, :login, :encryptedPassword)";
      $query_login = $db->prepare($sql_insert_login);
      $query_login->bindValue(':login', $login, PDO::PARAM_STR);
      $query_login->bindValue(':encryptedPassword', $encryptedPassword, PDO::PARAM_STR);
      $query_login->execute();

      if($query_login){
       echo "Thank you for registering with our website. You can now login !";
      }
      //assign to user incomes,expenses,payment default template of db
        $sql_insert_incomes_template_default = "INSERT INTO incomes_category_assigned_to_users (user_id, name) 
        SELECT users.id, incomes_category_default.name 
        FROM users, incomes_category_default
        WHERE users.login= :login";
        $query_incomes = $db->prepare($sql_insert_incomes_template_default);
        $query_incomes->bindValue(':login', $login, PDO::PARAM_STR);
        $query_incomes->execute();

        $sql_insert_expenses_template_default ="INSERT INTO expenses_category_assigned_to_users (user_id, name) 
        SELECT users.id, expenses_category_default.name 
        FROM users, expenses_category_default 
        WHERE users.login= :login";
        $query_expenses = $db->prepare($sql_insert_expenses_template_default);
        $query_expenses->bindValue(':login', $login, PDO::PARAM_STR);
        $query_expenses->execute();

        $sql_insert_payment_template_default ="INSERT INTO payment_methods_assigned_to_users (user_id, name) 
        SELECT users.id, payment_methods_default.name 
        FROM users, payment_methods_default 
        WHERE users.login= :login";
        $query_payment = $db->prepare($sql_insert_payment_template_default);
        $query_payment->bindValue(':login', $login, PDO::PARAM_STR);
        $query_payment->execute();
    
        $_SESSION['login'] = $login;
        //unset($_POST['reg_user']);
        header('location: index.php');
        exit();
    }  
//} 
else {
  echo "<span> Oops! Something went wrong. Please try again later. </span>";
  exit();
}
?>