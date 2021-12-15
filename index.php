<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if yes - redirect him to main menu page
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){
    header("Location: menu.php");
    exit;
}
?>

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
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
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
		  <p class = "lead">
		  With Wall€tfy! you will no longer look in amazement at your wallet at the end of the month. Register and join the wide group of satisfied users just now!
		  </p>
        </div>
        <div class="blur">
		  <form action="signin.php" method="post" name="loginForm" id="loginForm" autocomplete="off" onsubmit="return validation()">
		  <p id="text" style="visibility:hidden; margin:-10px 0 0 0;">Caps Lock is ON !</p>
                        <div class="row mb-4">
						 <label for="username">E-mail:</label>
                            <div class="login-input" style="width: 90%;">
                                <div class="login-icon mx-auto my-auto px-2 py-2" >
                                    <span class="material-icons">
                                        email
                                    </span>
                                </div>
                                <input type="email" id="email" class="form-control mx-auto my-auto py-2" placeholder="e-mail" aria-label="email" name="email" onkeypress="capLock(event)" autofocus>
                                <i class="fas fa-check-circle" id="ok" style="position:absolute; left:85%; top:12px; visibility:hidden;"></i>
								<i class="fas fa-exclamation-circle" id="wrong" style="position:absolute; left:85%; top:12px; visibility:hidden;"></i>
								<small id="email_error">Error message</small>
                                <span><?php echo ((isset($_SESSION['login_err']) && $_SESSION['login_err'] != '') ? $_SESSION['login_err'] : ''); unset($_SESSION['login_err']); ?> </span>
                            </div>
                        </div>

                        <div class="row mb-2">
						<label for="password">Password:</label>
                            <div class="login-input mb-3">
                                <div class="login-icon">
                                    <span class="material-icons mx-auto my-auto px-2 py-2">
                                        vpn_key
                                    </span>
                                </div>
                                <input type="password" id="password" class="form-control mx-auto my-auto px-2 py-2" id="password" placeholder="password" aria-label="password" name="password" onkeypress="capLock(event)" >
                                <i class="fas fa-check-circle" id="ok1" style="position:absolute; left:75%; top:12px; visibility:hidden;"></i>
								<i class="fas fa-exclamation-circle" id="wrong1" style="position:absolute; left:75%; top:12px; visibility:hidden;"></i>
								<small id="password_error">Error message</small>
								<span class="material-icons align-middle" id="togglePassword" style="cursor:pointer; margin:10px 0 0 10px;" onclick="togglePassword('password')">visibility_off</span>
                                <span><?php echo ((isset($_SESSION['password_login_err']) && $_SESSION['password_login_err'] != '') ? $_SESSION['password_login_err'] : ''); unset($_SESSION['password_login_err']); ?> </span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="keeplogin mx-auto my-auto px-2 py-1">
                                <input type="checkbox" class="align-middle" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
                                <label class="align-middle" for="loginkeeping">Remember me</label>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="login-button text-center">
                                <button type="submit" name="sign_in" class="btn btn-danger btn-lg" style="border-radius:15px"/>Sign In</button>
                            </div>
                            <span><?php echo ((isset($_SESSION['login_message']) && $_SESSION['login_message'] != '') ? $_SESSION['login_message'] : ''); unset($_SESSION['login_message']); ?> </span>
                        </div>

                        <div class="row">
                            <div class="change_link ">
                                    <p class="text-center">Not a member yet ?<a href="register.php" class="p-1"><button type="button" class="btn btn-danger btn-sm" style="border-radius:10px">Sign up</button></a></p>
                            </div>
                        </div>
                    
                </form>
        </div>
	</div>
	  <div class="container-fluid">
        <div class="row text-center">
            <footer class="page-footer">
                <div class="footer-container text-center">
                    <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
					Follow me:<a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                    <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                    <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a></p>		
                </div>
            </footer>
        </div>
    </div>
</section>
	
    
<!-- partial -->
<script>
function capLock(e){
var input = document.getElementById('loginForm');
var alert = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.visibility = "visible";
  } else {
    text.style.visibility = "hidden"
  }
});
}
</script>

<script >
    $(document).ready(function(e) {
		$('.form-control').value('');
    });
</script>

<script>
		togglePassword.addEventListener('click', function togglePassword () {
	const password = document.querySelector('#password');
	if (password.type === 'password'){
		password.type = 'text';
		$('#togglePassword').text('visibility');	
	}
	else {
		password.type = 'password';
	   $('#togglePassword').text('visibility_off');	
	}
});
</script>

<script>
function validation() {	
const email = document.getElementById('email');
const password = document.getElementById('password');
	// trim to remove the whitespaces

	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	
	if(emailValue === '' || emailValue === null || !isEmail(emailValue)) {
		$('#email_error').css('visibility', 'visible');
		$('#email_error').text('Invalid email format');
		$('#wrong2').css('visibility', 'visible');
		$('#ok2').css('visibility', 'hidden');
		$('#email').css('border', 'solid 2px #e74c3c');
		return false;
	}
	  else {
		$('#email').css('border', 'solid 2px #2ecc71');
		$('#ok2').css('visibility', 'visible');
		$('#wrong2').css('visibility', 'hidden');
		$('#email_error').css('visibility', 'hidden');
	}
	
	if(passwordValue === '' || passwordValue === null) {
		$('#password_error').css('visibility', 'visible');
		$('#password_error').text('Password cannot be blank');
		$('#wrong3').css('visibility', 'visible');
		$('#ok3').css('visibility', 'hidden');
		$('#password').css('border', 'solid 2px #e74c3c');
		return false;

	} else if (passwordValue.length < 6 || passwordValue.length > 20){
		$('#password_error').css('visibility', 'visible');
		$('#password_error').text('hint -> contain beetween 8-20 characters');
		$('#wrong3').css('visibility', 'visible');
		$('#ok3').css('visibility', 'hidden');
		$('#password').css('border', 'solid 2px #e74c3c');
		return false;
	}
	else if (!isPasswordValid(passwordValue)){
		$('#password_error').css('visibility', 'visible');
		$('#password_error').text('Must contain only letters, numbers and underscores');
		$('#wrong3').css('visibility', 'visible');
		$('#ok3').css('visibility', 'hidden');
		$('#password').css('border', 'solid 2px #e74c3c');
		return false;
	}
	else {
		$('#password').css('border', 'solid 2px #2ecc71');
		$('#ok3').css('visibility', 'visible');
		$('#wrong3').css('visibility', 'hidden');
		$('#password_error').css('visibility', 'hidden');
	}
	
	 

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
function isPasswordValid(password){
return/^[a-zA-Z0-9_]*$/.test(password);
	}
}
</script>

 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script><script  src="./script.js"></script>
<script src="sweetalert2.all.min.js"></script>

</body>
</html>
