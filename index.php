<?php
// Initialize the session
session_start();

// Check if the user is logged in, if yes - redirect him to main menu page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) {
    header("Location: menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />
    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>


</head>

<body>

    <main>
        <section id="home" style="background-image: url(ewallet.png)">
            <div class="content">
                <div class="mt-2">
                    <svg class="title">
                        <text x="0" y="40">Wall€tfy!</text>
                    </svg>
                    <p class="lead">
                        Say hello to Wall€tfy! - a personal finance application that makes money management easy. The app is designed to streamline cash tracking and help you save money.
                    </p>
                    <p class="lead">
                        With Wall€tfy! you will no longer look in amazement at your wallet at the end of the month. Register and join the wide group of satisfied users just now!
                    </p>
                </div>
                <div class="blur">
                    <form action="signin.php" method="post" name="loginForm" id="loginForm" autocomplete="off" onsubmit="return validateLoginForm();">
                        <p id="text" style="visibility:hidden; margin:-10px 0 0 0;">Caps Lock is ON !</p>
                        <div class="row mb-4">
                            <label for="username">E-mail:</label>
                            <div class="login-input">
                                <div class="login-icon mx-auto my-auto px-2 py-2">
                                    <span class="material-icons">
                                        email
                                    </span>
                                </div>
                                <input type="email" id="email" class="form-control mx-auto my-auto py-2" placeholder="e-mail" aria-label="email" name="email" onkeypress="capLock(event)" autofocus>
                                <span class="material-icons align-middle" id="ok" style="position:absolute; left:85%; top:12px;">check_circle</span>
                                <span class="material-icons align-middle" id="wrong" style="position:absolute; left:85%; top:12px;">error_outline</span>
                                <small id="email_error">Error message</small>
                                <span><?php echo ((isset($_SESSION['login_err']) && $_SESSION['login_err'] != '') ? $_SESSION['login_err'] : '');
                                        unset($_SESSION['login_err']); ?> </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password">Password:</label>
                            <div class="login-input mb-3">
                                <div class="login-icon">
                                    <span class="material-icons mx-auto my-auto px-2 py-2">
                                        vpn_key
                                    </span>
                                </div>
                                <input type="password" id="loginPassword" class="form-control mx-auto my-auto px-2 py-2" placeholder="password" aria-label="password" name="password" onkeypress="capLock(event)">
                                <span class="material-icons align-middle" id="ok" style="position:absolute; left:78%; top:12px;">check_circle</span>
                                <span class="material-icons align-middle" id="wrong" style="position:absolute; left:78%; top:12px;">error_outline</span>
                                <small id="password_error">Error message</small>
                                <span class="material-icons align-middle" id="eyeIcon" style="cursor:pointer; color:black; opacity:0.6; position:absolute; left:85%; top:10px;" onclick="togglePassword('loginPassword')">visibility_off</span>
                                <span><?php echo ((isset($_SESSION['password_login_err']) && $_SESSION['password_login_err'] != '') ? $_SESSION['password_login_err'] : '');
                                        unset($_SESSION['password_login_err']); ?> </span>
                            </div>
                        </div>

                        <div class="form-group d-md-flex w-100 mb-4">
                            <div class="form-check w-50 float-left" style="padding-left: 1.5em;">
                                <label class="custom-control fill-checkbox">
                                    <input type="checkbox" class="fill-control-input">
                                    <span class="fill-control-description">Remember Me</span>
                                </label>
                            </div>
                            <div class="w-50" style="position:absolute; left:60%">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="login-button">
                            <a href="menu.php"><button type="submit" id="logInBtn" name="sign_in" class="btn btn-lg w-100" onclick="checkLoginInputs()">Sign In <span class="material-icons align-bottom  mb-1" style="margin-left: 1em;">input</span></button></a>
                            </div>
                            <span><?php echo ((isset($_SESSION['login_message']) && $_SESSION['login_message'] != '') ? $_SESSION['login_message'] : '');
                                    unset($_SESSION['login_message']); ?> </span>
                        </div>

                        <div class="row">
                            <div class="change_link ">
                                <p class="text-center">Not a member yet? <a href="register.php" class="p-1"><button type="button" id="logInBtn" class="btn btn-sm">Sign up</button></a></p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <footer class="page-footer">
                        <div class="footer-container text-left">
                            <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
                                Follow me:<a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                                <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                                <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
                            </p>
                        </div>
                    </footer>
                </div>
            </div>
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script>
        <script src="./script.js"></script>
        <script src="sweetalert2.all.min.js"></script>

</body>

</html>