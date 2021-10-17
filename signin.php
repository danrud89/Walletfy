<?php
session_start();

// initializing variables
$username = $password = "";
$username_err = $login_err = "";

// connect to the database
require_once "config.php";
mysqli_report(MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($db === false) {
            exit("ERROR: Could not connect. " . mysqli_connect_error());
        } else {
            // LOG IN USER
            if (isset($_POST['sign_in'])) {
                // receive all input values from the form
                $login = mysqli_real_escape_string($db, strip_tags(trim($_POST['login'])));
                $password = mysqli_real_escape_string($db, strip_tags(trim($_POST['password'])));

                // form validation: ensure that the form is correctly filled ...
                if (empty($login)) {
                    $_SESSION['username_err'] =  "Username is required !";
                }
                if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['login']))){
                    $_SESSION['username_err'] = "Login can only contain letters, numbers, and underscores.";
                }

                if (empty($password)) {
                    $_SESSION['login_err'] =  "Password is required !";
                }
            }
            else {
                echo "Oops! Something went wrong. Please try again later.";
                exit();
            }
            if (empty($username_err) && empty($login_err)) {
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
            else {
                echo "Oops! Something went wrong. Please try again later.";
                exit();
            }
        }
    } 
 else {
    echo "Oops! Something went wrong. Please try again later.";
    exit();
}
