<?php
session_start();

// initializing variables
$login = $password = "";
$login_err = $password_login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_in'])) {
    // LOG IN USER
        // receive all input values from the form
        $login = strip_tags(trim($_POST['login']));
        $password = strip_tags(trim($_POST['password']));

        // form validation: ensure that the form is correctly filled ...
        if (empty($login)) {
            $_SESSION['login_err'] =  "Username is required !";
            header('Location: index.php');
            exit();
        }
        if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['login'])) == false){
            $_SESSION['login_err'] = "Login can only contain letters, numbers, and underscores.";
            header('Location: index.php');
            exit();
        }

        if (empty($password)) {
            $_SESSION['password_login_err'] = "Password is required !";
            header('Location: index.php');
            exit();
        }
            
        if (empty($login_err) && empty($password_login_err)) {
                // connect to the database
            require_once 'database.php';
            mysqli_report(MYSQLI_REPORT_STRICT);
            $user_check_query = "SELECT * FROM users WHERE login ='$login' LIMIT 1";
            $query = $db->prepare($user_check_query);
            $query->bindValue(':login', $login, PDO::PARAM_STR);
            $query->execute();

            $user = $query->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged_id'] = $user['id'];
                $_SESSION['logged_user'] = $user['login'];
                $_SESSION['loggedin'] = true;
                $_SESSION['login_message'] = "Succesfully login! Redirecting...";
                header('Location: menu.php');
                exit();
            } else {
                $_SESSION['loggedin'] = false;
                header('Location: index.php');
                exit();
            }
        }
}
 else {
    echo "Oops! Something went wrong. Please try again later.";
    exit();
}
