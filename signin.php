<?php
session_start();

$email = $password = "";

if ((isset($_POST['sign_in'])) && $_SERVER["REQUEST_METHOD"] === "POST") {
   
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (empty($email)) {
        $_SESSION['login_err'] =  "Field is required !";
        header('location: index.php');
    }
    if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['password'])) == false) {
        $_SESSION['password_login_err'] = "Password can only contain letters, numbers, and underscores.";
        header('location: login.php');
    }
    if (empty($password)) {
        $_SESSION['password_login_err'] = "Password is required !";
        header('location: login.php');
    }
   
    require_once 'database.php';
    try {
        $user_check_query = 'SELECT * FROM users WHERE email = :email';
        $query = $db->prepare($user_check_query);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();
    } catch (PDOException $e) {
        echo "DataBase Error: Login failed.<br>" . $e->getMessage();
    } catch (Exception $error) {
        echo "Application Error: Login failed.<br>" . $error->getMessage();
    }
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_id'] = $user['id'];
        $_SESSION['logged_user'] = $user['name'];
        $_SESSION['logged_in'] = false;
        header('Location: menu.php');
        exit();
    } else {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
