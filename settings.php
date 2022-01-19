<?php
session_start();
if (!isset($_SESSION["logged_id"])) {
  header("Location: index.php");
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
  <header id="top">
    <h3>Wall€tfy!</h3>
    <h4 class="loggedAs mr-5 text-left mt-3 align-middle">USER: <?php echo $_SESSION['logged_user'] ?>
    </h4>
    <nav>
      <ul>
        <li><span class="material-icons mx-2 align-middle">home</span><a href="menu.php" title="Home">Home</a></li>
        <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">savings</span><a class="text-muted" href="#" data-toggle="modal" data-target="#addIncome">Income</a></li>
        <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">shopping_cart</span><a class="text-muted" href="#" class="openModal" data-toggle="modal" data-target="#addExpense" title="Expense">Expense</a></li>
        <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">insert_chart_outlined</span><a class="text-muted" href="balance.php" title="Balance">Balance</a></li>
        <li><span class="material-icons mx-2 align-middle">manage_accounts</span><a href="settings.php" title="Settings">Settings</a></li>
        <li><span class="material-icons mx-2 align-middle">logout</span><a href="index.php" title="Log Out">Exit</a></li>
      </ul>
    </nav>
  </header>
  
  <div class="main" style="background-image: url(img/ewallet2.png); top:15%;">
    <div class="wrapper1 mx-auto mt-5">
      <div class="blur  my-1">
        <div class="row mb-5">
          <p style="font-size: 1.25em;">
            Be patient...soon You should see some settings in here...
          </p>
        </div>
        <div class="row mx-auto">
          <div class="mx-auto mt-2 mb-2">
            <a href="index.php"><button type="button" class="btn btn-rounded btn-lg p-2" id="btnBack"><span class="material-icons mr-1 mt-2">reply</span>BACK TO MENU</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <footer class="page-footer">
        <div class="footer-container text-center">
          <p class="text-center">Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
            Follow me:<a class="mx-3 vertical-center" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
            <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
            <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
          </p>
        </div>
      </footer>
    </div>
  </div>
</body>

</html>