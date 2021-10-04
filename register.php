<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if yes - redirect him to main menu page
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){
    header("location: menu.php");
    exit;
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
                    <div class="fb">
                        <a href="https://www.facebook.com/daniel.rudnik.35/" class="fblink"><i class="icon-facebook"></i></a>
                    </div>
                    <div class="ln">
                        <p><a href="https://www.linkedin.com/in/daniel-rudnik-8894811b2/" class="lnlink"><i class="icon-linkedin"></i></a></p>
                    </div>
                    <div class="gh">
                        <p><a href="https://github.com/danrud89" class="ghlink"><i class="icon-github-squared"></i></a></p>
                    </div>
                </section>
            </div>

            <div class="wrapper col-6 mx-auto mt-5">
                <div class="register-box">

                    <div class="row">
                        <div class="register-title mx-auto mb-2 px-2">Sign up</div>
                    </div>
                    <form method="post" action="signup.php" id="SignUpForm">
                    <?php include('errors.php'); ?>
                        <div class="row">
                            <div class="register-input col-sm-12 mx-auto mt-4 mb-3">
                                <div class="register-icon mx-auto">
                                    <span class="material-icons px-2 py-1">
                                        person
                                    </span>
                                </div>
                                <input input type="text" class="form-control mx-auto my-auto px-2 py-2" placeholder="login" aria-label="login" name="login" required autofocus>
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
                            </div>
                        </div>


                        <div class="row">
                            <div class="register-button ml-2 mb-4 px-1 py-1">
                                <input type="submit" value="Sign up" name="reg_user" class="mx-auto my-auto px-1 py-1" />
                            </div>
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

</body>

</html>
