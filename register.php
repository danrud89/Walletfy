<?php
session_start();
if (isset($_SESSION["logged_id"])) {
    header("Location: menu.php");
    exit();
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" src="main.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="icon" href="img/favicon.png">
</head>

<body>
	<main>
		<section id="home" style="background-image: url(img/ewallet.png)">
			<div class="content">
				<div>
					<svg class="title">
						<text x="0" y="40">Wall€tfy!</text>
					</svg>
					<p class="lead text-justify">
						Say hello to Wall€tfy! - a personal finance application that makes money management easy. The app is designed to streamline cash tracking and help you save money.
					</p>
					<p class="lead text-justify">
						With Wall€tfy! you will no longer look in amazement at your wallet at the end of the month. Register and join the wide group of satisfied users just now!
					</p>
				</div>
				<div class="blur">
					<form action="signup.php" method="post" name="registerForm" autocomplete="off" id="registerForm" onsubmit="return validateRegisterForm();">
						<p id="caps-lock-warn" style="visibility:hidden; margin:-10px 0 0 0; letter-spacing:1px;">Caps Lock is ON.</p>
						<div class="row mb-2">
							<label for="username">Login:</label>
							<div class="register-input">
								<div class="register-icon mx-auto my-auto px-2 py-2">
									<span class="material-icons">
										person
									</span>
								</div>
								<input type="text" id="username" class="form-control mx-auto my-auto px-2 py-2" placeholder="name" aria-label="username" name="username" onkeypress="capsLock(event)" min="3" autofocus>
								<span class="material-icons" id="ok" style="position:absolute; left:85%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:85%; top:12px;">error_outline</span>
								<small id="login_error">Error message</small>
								
							</div>
						</div>


						<div class="row mb-2 py-2">
							<label for="email">E-mail:</label>
							<div class="register-input">
								<div class="register-icon mx-auto my-auto px-2 py-2">
									<span class="material-icons">
										email
									</span>
								</div>
								<input type="email" id="email" class="form-control mx-auto my-auto py-2" placeholder="email@test.com" aria-label="e-mail" name="email" onkeypress="capsLock(event)">
								<span class="material-icons" id="ok" style="position:absolute; left:85%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:85%; top:12px;">error_outline</span>
								<small id="email_error">Error message</small>
								
							</div>
						</div>

						<div class="row mb-2 py-2">
							<label for="password">Password:</label>
							<div class="register-input">
								<div class="register-icon mx-auto my-auto px-2 py-2">
									<span class="material-icons">
										vpn_key
									</span>
								</div>
								<input type="password" id="registerPassword" class="form-control mx-auto my-auto px-2 py-2" placeholder="password" aria-label="password" name="password" onkeypress="capsLock(event)" min="8" max="20">
								<span class="material-icons" id="ok" style="position:absolute; left:77%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:77%; top:12px;">error_outline</span>
								<small id="password_error">Error message</small>
								<span class="material-icons align-middle" id="eyeIcon" style="cursor:pointer; color:black; opacity:0.6; position:absolute; left:85%; top:10px;" onclick="togglePassword('registerPassword')">visibility_off</span>
								
							</div>
						</div>

						<div class="row mb-3 py-2">
							<label for="confPassword">Confirm password:</label>
							<div class="register-input">
								<div class="register-icon mx-auto my-auto px-2 py-2">
									<span class="material-icons">
										vpn_key
									</span>
								</div>
								<input type="password" id="cRegisterPassword" class="form-control mx-auto my-auto px-2 py-2" placeholder="confirm password" aria-label="password" name="confpassword" onkeypress="capsLock(event)" min="8" max="20">
								<span class="material-icons" id="ok" style="position:absolute; left:77%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:77%; top:12px;">error_outline</span>
								<small id="cpassword_error">Error message</small>
								<span class="material-icons align-middle" id="ceyeIcon" style="cursor:pointer; color:black; opacity:0.6; position:absolute; left:85%; top:10px;" onclick="togglePassword('cRegisterPassword')">visibility_off</span>
								
							</div>
						</div>
						

						<div class="row mb-3">
							<div class="register-button text-center">
								<button type="submit" name="sign_up" id="regBtn" class="btn btn-lg w-100" onclick="checkRegisterInputs()">Sign Up <span class="material-icons align-bottom mb-1" style="margin-left: 0.5em;">touch_app</span></button>
							</div>
						</div>

						<div class="row">
							<div class="change_link ">
								<p class="text-center mb-0">Already a member? <a href="index.php" class="p-1"><button type="button" id="regBtn" class="btn btn-sm" >Sign in</button></a></p>
							</div>
						</div>

					</form>
				</div>
			</div>
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
		</section>

		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script>
		<script src="./script.js"></script>
		<script src="sweetalert2.all.min.js"></script>
		
<?php 
if(isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] != '')
{
    ?>       <script>
            Swal.fire({
               title: 'Register Failed. Make sure You meet all constraints',
			   html: '* Username cannot be empty, </br> * Username must contain minimum 3 charackters,</br> * Username can contain only letters,numbers, and underscores.</br></br> Current problem: <?php echo $_SESSION['loginStatus']; ?>',
               icon: '<?php echo $_SESSION['loginStatusCode']; ?>', 
               confirmButtonText: 'Try again',
               confirmButtonColor: '#6495ED',
			   position: 'center',
             });
    </script>
	<?php
unset($_SESSION['loginStatus']);
unset($_SESSION['loginStatusCode']);
}
?>
<?php
if(isset($_SESSION['emailStatus']) && $_SESSION['emailStatus'] != '')
{
    ?>   
		<script>
            Swal.fire({
                title: 'Register Failed. Make sure You meet all constraints',
				html: '* Email cannot be empty, </br> * Email syntax must be valid,</br></br> Current problem: <?php echo $_SESSION['loginStatus']; ?>',
               icon: '<?php echo $_SESSION['emailStatusCode']; ?>', 
               confirmButtonText: 'Try again',
               confirmButtonColor: '#6495ED',
			   position: 'center',
             });
    </script>
	<?php
unset($_SESSION['emailStatus']);
unset($_SESSION['emailStatusCode']);
}
?>
<?php 
if(isset($_SESSION['passwordStatus']) && $_SESSION['passwordStatus'] != '')
{
    ?>
	<script>  
            Swal.fire({
			   title: 'Register Failed. Make sure You meet all constraints',
               html: '* Passwords cannot be empty, </br></br> * Must contain beetween 8 ÷ 20 characters, </br></br> * Passwords must be the same, </br></br> Current problem: <?php echo $_SESSION['passwordStatus']; ?>',
               icon: '<?php echo $_SESSION['passwordStatusCode']; ?>', 
               confirmButtonText: 'Try again',
               confirmButtonColor: '#6495ED',
			   position: 'center',
             });
    </script>
	<?php
unset($_SESSION['passwordStatus']);
unset($_SESSION['passwordStatusCode']);
}
?>
<?php 
if(isset($_SESSION['serwerStatus']) && $_SESSION['serwerStatus'] != '')
{
    ?>
<script>
            Swal.fire({
               title: 'Internal serwer error!',
               text: '<?php echo $_SESSION['serwerStatus']; ?>',
               icon: '<?php echo $_SESSION['serwerStatusCode']; ?>', 
               confirmButtonText: 'OK',
               confirmButtonColor: '#6495ED',
			   position: 'center',
             });
    </script>
 <?php
unset($_SESSION['serwerStatus']);
unset($_SESSION['serwerStatusCode']);
}
?>
</body>

</html>