<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="welcomeMessage.css" type="text/css" />
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
            <div class="description col-md-4">
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

                <section div class="social col-md-12 mx-auto my-auto py-3">
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

            <div class="wrapper col-8 mx-auto mt-3">

                <div class="row vertical-center">
                    <div class="main-container py-2 px-4 col-md-8 offset-md-2 col-lg-6 offset-lg-3 my-5">

                        <div class="row p-2">
                            <div class="welcome-message">
                                <p class="welcome-text text-center mt-2">Thank you for registering with our website.</p>
                                <p class="welcome-text text-center">You can now login !</p>
                                <div class="row">
                                    <div class="login-button text-center mb-3">
                                        <button type="button" id="logbtn" class="btn btn-sm mb-2"><a href="index.php" class="p-1" style="margin-bottom: 1px;">Sign in</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid p-0">
                <div class="row">
                    <footer class="page-footer col-sm-12 col-md-12 mt-md-0">
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