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
<!-- partial:index.partial.html -->
<div class="smooth">
  <header id="top">
    <h3>Wall€tfy!</h3>
    <nav>
      <ul>
        <li><span class="material-icons mx-2 align-middle">home</span><a href="#home" title="Home">Home</a></li>
        <li><span class="material-icons mx-2 align-middle">savings</span><a href="#about" title="Income">Income</a></li>
        <li><span class="material-icons mx-2 align-middle">shopping_cart</span><a href="#services" title="Expense">Expense</a></li>
        <li><span class="material-icons mx-2 align-middle">insert_chart_outlined</span><a href="#testimonials" title="Balance">Balance</a></li>
        <li><span class="material-icons mx-2 align-middle">manage_accounts</span><a href="#news" title="Settings">Settings</a></li>
		<li><span class="material-icons mx-2 align-middle">dvr</span><a href="#news" title="Log Out">Log Out</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section id="home" style="background-image: url(ewallet.png)">
      <div class="content">
      
      <div class="container-fluid mt-2">
				<div class="row">
					<footer class="page-footer">
						<div class="footer-container text-left mx-auto">
							<p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
								Follow me :
								<a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
								<a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
								<a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
							</p>
						</div>
					</footer>
				</div>
			</div>
			</div>
    </section>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script><script  src="./script.js"></script>

</body>
</html>
