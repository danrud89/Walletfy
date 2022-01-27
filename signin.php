<?php
session_start();

$email = $password = "";

if ((isset($_POST['sign_in'])) && $_SERVER["REQUEST_METHOD"] === "POST") {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    if (empty($email)) {
        $_SESSION['loginStatus'] = "Field is required!";
        $_SESSION['loginStatusCode'] = "error";
        header('location: index.php');
    }

    if (empty($password)) {
        $_SESSION['passwordStatus'] = "Field is required!";
        $_SESSION['passwordStatusCode'] = "error";
        header('location: login.php');
    }

    if (preg_match('/^[a-zA-Z0-9_]+$/', trim($password) == false)) {
        $_SESSION['passwordStatus'] = "Password can only contain letters, numbers, and underscores.";
        $_SESSION['passwordStatusCode'] = "error";
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
        unset($_POST['sign_in']);
        header('Location: menu.php');
        exit();
    } else {
        $_SESSION['logged_in'] = true;
        $_SESSION['passwordStatus'] = "Incorrect e-mail/password ! Please check Your details and try again";
        $_SESSION['passwordStatusCode'] = "error";
        unset($_POST['sign_in']);
        header('Location: index.php');
        exit();
    }
} else {
    $_SESSION['serwerStatus'] = "Oooops...something went wrong ! Please try again later.";
    $_SESSION['serwerStatusCode'] = "error";
    header('Location: index.php');
    exit();
}
