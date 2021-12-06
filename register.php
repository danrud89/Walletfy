<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />
  <link href="https://fonts.googleapis.com/css?family=Inconsolata|Montserrat:400,500,700&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'><link rel="stylesheet" href="./style.css">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
  <main>
    <section id="home" style="background-image: url(ewallet.png)">
      <div class="content">
        <div>
          <svg class="title">
            <text x="0" y="40">Wall€tfy!</text>
          </svg>
          <p class="lead">
            Say hello to Wall€tfy! - a personal finance application that makes money management easy. The app is designed to streamline cash tracking and help you save money. 
          </p>
		  <p class = "lead">
		  With Wall€tfy! you will no longer look in amazement at your wallet at the end of the month. Register and join the wide group of satisfied users just now!
		  </p>
        </div>
        <div class="blur">
		  <form action="signin.php" method="post" name="loginForm" onsubmit="return inputValidation()" >
 
                        <div class="row mb-3">
                            <div class="register-input">
                                <div class="register-icon mx-auto my-auto px-2 py-2">
                                    <span class="material-icons">
                                        person
                                    </span>
                                </div>
                                <input type="text" class="form-control mx-auto my-auto px-2 py-2" placeholder="name" aria-label="name" name="name" autofocus required>
                                <span class="text-danger"><?php echo ((isset($_SESSION['username_err']) && $_SESSION['username_err'] != '') ? $_SESSION['username_err'] : '');
                                                    unset($_SESSION['username_err']); ?> </span>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="register-input">
                                <div class="register-icon mx-auto my-auto px-2 py-2">
                                    <span class="material-icons">
                                        email
                                    </span>
                                </div>
                                <input type="email" class="form-control mx-auto my-auto px-2 py-2" placeholder="email" aria-label="email" name="email" required>
                                <span class="text-danger"><?php echo ((isset($_SESSION['email_err']) && $_SESSION['email_err'] != '') ? $_SESSION['email_err'] : '');
                                                    unset($_SESSION['email_err']); ?> </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="register-input">
                                <div class="register-icon mx-auto my-auto px-2 py-2">
                                    <span class="material-icons">
                                        vpn_key
                                    </span>
                                </div>
                                <input type="password" class="form-control mx-auto my-auto px-2 py-2" placeholder="password" aria-label="password" name="password" required>
                                <span class="text-danger"><?php echo ((isset($_SESSION['password_err']) && $_SESSION['password_err'] != '') ? $_SESSION['password_err'] : '');
                                        unset($_SESSION['password_err']); ?> </span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="register-input ">
                                <div class="register-icon mx-auto my-auto px-2 py-2">
                                    <span class="material-icons">
                                        vpn_key
                                    </span>
                                </div>
                                <input type="password" class="form-control mx-auto my-auto px-2 py-2" placeholder="confirm password" aria-label="password" name="confpassword" required>
                                <span class="text-danger"><?php echo ((isset($_SESSION['confirm_password_err']) && $_SESSION['confirm_password_err'] != '') ? $_SESSION['confirm_password_err'] : '');
                                        unset($_SESSION['confirm_password_err']); ?> </span>
                            </div>
                        </div>
						
						<div class="row mb-4">
                            <div class="register-button">
                                  <button type="button" name="sign_in" class="btn btn-danger btn-lg" style="border-radius:15px"/>Sign Up</button>
                            </div>
                            <span class="text-success"><?php echo ((isset($_SESSION['success']) && $_SESSION['success'] != '') ? $_SESSION['success'] : '');
                                    unset($_SESSION['success']); ?> </span>
                            <span class="text-danger"><?php echo ((isset($_SESSION['wrong_validation']) && $_SESSION['wrong_validation'] != '') ? $_SESSION['wrong_validation'] : '');
                                    unset($_SESSION['wrong_validation']); ?> </span>
                        </div>

                        <div class="row">
                            <div class="change_link ">
                                    <p class="text-left ">Already a member ?<a href="register.php" class="p-1"><button type="button" class="btn btn-danger btn-sm" style="border-radius:10px">Sign in</button></a></p>
                            </div>
                        </div>
                    
                </form>
        </div>
      </div>
	  <div class="container-fluid mt-2">
        <div class="row">
            <footer class="page-footer">
                <div class="footer-container text-center">
                    <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
					Follow me :
					<a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                    <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                    <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a> </p>
                </div>
            </footer>
        </div>
    </div>
    </section>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script><script  src="./script.js"></script>

</body>
</html>
