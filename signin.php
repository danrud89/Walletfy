<?php
session_start();

// initializing variables
$email = $password = "";

function filterInputEmail($input){
    $output = filter_input(INPUT_POST, $input, FILTER_VALIDATE_EMAIL);
    return $output;
}

function trimInputData($input){
    $output = trim($input);
    return $output;
}

function checkEmptyData($input){
    if(empty($input)) return true;
    else return false;
}

if (($_SERVER["REQUEST_METHOD"] === "post") && (isset($_POST['sign_in']))) {
    // LOG IN USER
    // receive all input values from the form
    $email = !empty($_POST['email']) ? trimInputData($_POST['email']) : null;
    $email = filterInputEmail($_POST['email']);
    $password = !empty($_POST['password']) ? trimInputData($_POST['password']) : null;

    // form validation: ensure that the form is correctly filled 
    if (empty($login)) {
        $_SESSION['login_err'] =  "Field is required !";
    }
    if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['password'])) == false) {
        $_SESSION['password_login_err'] = "Password can only contain letters, numbers, and underscores.";
    }
    if (empty($password)) {
        $_SESSION['password_login_err'] = "Password is required !";
    }
    // connect to the database
    require_once 'database.php';
    try{
        $user_check_query = 'SELECT * FROM users WHERE email = :login';
        $query = $db->prepare($user_check_query);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();
    }
    catch (PDOException $e) {
        echo "DataBase Error: Login failed.<br>".$e->getMessage();
      }
    catch(Exception $error){
        echo "Application Error: Login failed.<br>".$error->getMessage();
    }
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['logged_id'] = $user['id'];
            $_SESSION['logged_user'] = $user['name'];
            $_SESSION['loggedin'] = true;
            header('Location: menu.php');
            exit();
        } else {
            $_SESSION['loggedin'] = false;
            header('Location: index.php');
            exit();
        }
    }
 else {
    echo "Oops! Something went wrong. Please try again later.";
    exit();
}
