<?php
session_start();

// initializing variables
$login = $password = "";

// connect to the database
require_once "config.php";
mysqli_report(MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_in'])) {
        $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($db === false) {
            exit("ERROR: Could not connect. " .mysqli_connect_error());
        } else {
            // LOG IN USER
                // receive all input values from the form
                $login = strip_tags(trim($_POST['login']));
                $password = strip_tags(trim($_POST['password']));

                // form validation: ensure that the form is correctly filled ...
                if (empty($login)) {
                    $_SESSION['username_err'] =  "Username is required !";
                }
                if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['login'])) == false){
                    $_SESSION['username_err'] = "Login can only contain letters, numbers, and underscores.";
                }

                if (empty($password)) {
                    $_SESSION['password_err'] = "Password is required !";
                }
            }
            if (empty($username_err) && empty($password_err)) {
                $user_check_query = "SELECT * FROM accounts WHERE LOGIN ='$login' LIMIT 1";
                $result = mysqli_query($db, $user_check_query);
                $user = mysqli_fetch_assoc($result);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['logged_id'] = $user['ID'];
                    $_SESSION['logged_user'] = $user['LOGIN'];
                    $_SESSION['loggedin'] = true;
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
