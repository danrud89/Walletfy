<?php
// Initialize the session
session_start();

// Check if the user is logged in, if yes - redirect him to main menu page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) {
    header("location: menu.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="register.css" type="text/css" />
    <link rel="stylesheet" href="icons/css/fontello.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="img/favicon.png">

</head>

<body>
    <div class="container col-md-10 px-2 py-2 mx-auto my-auto">
        <div class="row">
            <div id="toggle" class="col-sm-12 position-relative mx-1 my-1 px-1 py-1">
                <i class="indicator"></i>
            </div>
        </div>
        <div class="row">
            <div class="description col-md-6">
                <section div class="motto mb-5">
                    <div class="motto1 mx-auto my-auto">
                        <p><img class="wallet-dark" src="img/wallet_dark.jpg" alt="" style="transform: scale(0.8);">
                            <img class="wallet-light" src="img/wallet-light.png" alt="" style="transform: scale(0.8);">Wall€tfy!
                        </p>
                    </div>
                    <div class="motto2 mx-auto my-auto">
                        <p>Application that makes money</p>
                        <p>management easier !</p>
                    </div>
                </section>

                <section div class="social col-md-12 mx-auto my-auto py-5">
                    <p>Follow us :</p>
                    <a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                    <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                    <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
                </section>
            </div>

            <div class="wrapper col-6 mx-auto mt-5">
                <form action="signup.php" method="post" id="SignUpForm" name="registerForm" onsubmit="return validation()">
                    <div class="register-box">
                        <div class="row">
                            <div class="register-title mx-auto mb-2 px-2">Sign up</div>
                        </div>
                        <span class="text-danger"><?php echo ((isset($_SESSION['username_err']) && $_SESSION['username_err'] != '') ? $_SESSION['username_err'] : ''); unset($_SESSION['username_err']); ?> </span>
                        <div class="row">
                            <div class="register-input col-sm-12 mx-auto mt-4 mb-3">
                                <div class="register-icon mx-auto">
                                    <span class="material-icons px-2 py-1">
                                        person
                                    </span>
                                </div>
                                <input type="text" class="form-control mx-auto my-auto px-2 py-2" placeholder="login" aria-label="login" name="login" autofocus required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="register-input col-sm-12 mx-auto mb-2">
                                <div class="register-icon mx-auto">
                                    <span class="material-icons px-2 py-1">
                                        vpn_key
                                    </span>
                                </div>
                                <input type="password" class="form-control mx-auto my-auto px-2 py-2" placeholder="password" aria-label="password" name="password" required>
                                <span><?php echo ((isset($_SESSION['password_err']) && $_SESSION['password_err'] != '') ? $_SESSION['password_err'] : ''); unset($_SESSION['password_err']); ?> </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="register-input col-sm-12 mx-auto mb-3">
                                <div class="register-icon mx-auto">
                                    <span class="material-icons px-2 py-1">
                                        vpn_key
                                    </span>
                                </div>
                                <input type="password" class="form-control mx-auto my-auto px-2 py-2" placeholder="confirm password" aria-label="password" name="confpassword" required>
                                <span><?php echo ((isset($_SESSION['confirm_password_err']) && $_SESSION['confirm_password_err'] != '') ? $_SESSION['confirm_password_err'] : ''); unset($_SESSION['confirm_password_err']); ?> </span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="register-button ml-2 mb-4 px-1 py-1">
                                <button class="mx-auto my-auto px-1 py-1" type="submit" id="reg_btn" name="reg_user" >Sign in</button>
                            </div>
                            <span><?php echo ((isset($_SESSION['success']) && $_SESSION['success'] != '') ? $_SESSION['success'] : ''); unset($_SESSION['success']); ?> </span>
                            <span><?php echo ((isset($_SESSION['wrong_validation']) && $_SESSION['wrong_validation'] != '') ? $_SESSION['wrong_validation'] : ''); unset($_SESSION['wrong_validation']); ?> </span>
                        </div>
                    </form>
                        <div class="row">
                            <div class="change_link position-absolute mt-2 px-auto py-auto">
                                <div class="info position-relative d:inline-flex">
                                    <p class="text-left ">Already have an account ?</p>
                                    <a href="index.php" class="p-1" style="margin-bottom: 1px;">Sign in</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <span><?php echo var_dump($_POST['login'])?></span>
    <span><?php echo var_dump($_POST['password'])?></span>
    <span><?php echo print_r($_SESSION['username_err'])?></span>
    <div class="container-fluid p-0 mt-4 mt-lg-5">
        <div class="row">
            <footer class="page-footer col-sm-12 col-md-12 mt-lg-5">
                <div class="footer-container text-center mx-auto">
                    <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved </p>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <script>
        const body = document.querySelector('body');
        const toggle = document.getElementById('toggle');
        toggle.onclick = function() {
            toggle.classList.toggle('active');
            body.classList.toggle('active');
        }
    </script>
    <script>
        function validation() {
            let userName = document.querySelector("input[name='login']").value;
            let userPassword = document.querySelector("input[name='password']").value;
            let confPassword = document.querySelector("input[name='confpassword']").value;
            if (userName.length == "" && userPassword.length == "" && confPassword.length == "") {
                alert("All fields are empty !");
                return false;
            } else {
                if (userName.trim() === "" || userName == null) {
                    alert("Login field is empty");
                    return false;
                }
                if (userName.length < 3) {
                    alert("Login must contain at least 3 charakters !");
                    return false;
                }
                if (userPassword.trim() === "" || userPassword == null) {
                    alert("Password field is empty");
                    return false;
                }
                if (userPassword.length < 8 || userPassword.length > 20) {
                    alert("Password must contain beetween 8 and 20 characters!");
                    return false;
                }
                if (confPassword.trim() === "" || confPassword == null) {
                    alert("Password field is empty");
                    return false;
                }
               
                if (userPassword != confPassword) {
                    alert("Password do not match !");
                    return false;
                }
            }
        }
    </script>
</body>

</html>