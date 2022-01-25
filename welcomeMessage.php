<?php
// Initialize the session
session_start();

// Check if the user is logged in, if yes - redirect him to main menu page
//if (!isset($_SESSION['successfullyRegistered'])) {
   // header("Location: index.php");
  //  exit;
//}
unset($_SESSION['loginStatus']);
unset($_SESSION['loginStatusCode']);
unset($_SESSION['emailStatus']);
unset($_SESSION['emailStatusCode']);
unset($_SESSION['passwordStatus']);
unset($_SESSION['passwordStatusCode']);
unset($_SESSION['serwerStatus']);
unset($_SESSION['serwerStatusCode']);
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>

<body>
    <div class="main" style="background-image: url(ewallet2.png);">
        <div class="wrapper1 mx-auto mt-5">
            <div class="blur  my-1">
                <div class="row mb-5">
                    <p style="font-size: 1.25em;">
                        Welcome aboard <?= $_SESSION['logged_user'] ?>! I'm glad You say YES. Wall€tfy! was developed to create a trustworthy place for You to make money menagement easier.
                    </p>
                    <p style="font-size: 1.25em;">
                        Click the button below to return to the login page.
                    </p>
                </div>
                <div class="row">
                    <div class="mx-auto mt-2 mb-2">
                        <a href="index.php"><button type="button" class="btn btn-rounded btn-lg p-2" id="btnBack"><span class="material-icons mr-1 mt-2">reply</span>BACK TO LOGIN PAGE</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <footer class="page-footer">
                <div class="footer-container text-center ml-5 offset-md-3">
                    <p class="text-center">Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
                        Follow me:<a class="mx-3 vertical-center" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                        <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                        <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
                    </p>
                </div>
            </footer>
        </div>
    </div>

    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Congratulations !',
            text: 'Registration successful',
            footer: 'Your registration has been received',
            showConfirmButton: false,
            background: '#fff',
            timer: 3500,
            timerProgressBar: true,
        })
    </script>
   
</body>

</html>