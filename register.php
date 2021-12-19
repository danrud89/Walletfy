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
					<p class="lead">
						With Wall€tfy! you will no longer look in amazement at your wallet at the end of the month. Register and join the wide group of satisfied users just now!
					</p>
				</div>
				<div class="blur">
					<form action="signup.php" method="post" name="registerForm" autocomplete="off" id="registerForm" onsubmit="return validation();">
						<p id="text" style="visibility:hidden; margin:-10px 0 0 0;">Caps Lock is ON.</p>
						<div class="row mb-2 py-2">
							<label for="username">Login:</label>
							<div class="register-input">
								<div class="register-icon mx-auto my-auto px-2 py-2">
									<span class="material-icons">
										person
									</span>
								</div>
								<input type="text" id="username" class="form-control mx-auto my-auto px-2 py-2" placeholder="name" aria-label="username" name="username" onkeypress="capLock(event)" min="3" autofocus>
								<span class="material-icons" id="ok" style="position:absolute; left:85%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:85%; top:12px;">error_outline</span>
								<small id="login_error">Error message</small>
								<span class="text-danger"><?php echo ((isset($_SESSION['username_err']) && $_SESSION['username_err'] != '') ? $_SESSION['username_err'] : '');
															unset($_SESSION['username_err']); ?> </span>
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
								<input type="email" id="email" class="form-control mx-auto my-auto py-2" placeholder="email@test.com" aria-label="e-mail" name="email" onkeypress="capLock(event)">
								<span class="material-icons" id="ok" style="position:absolute; left:85%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:85%; top:12px;">error_outline</span>
								<small id="email_error">Error message</small>
								<span class="text-danger"><?php echo ((isset($_SESSION['email_err']) && $_SESSION['email_err'] != '') ? $_SESSION['email_err'] : '');
															unset($_SESSION['email_err']); ?> </span>
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
								<input type="password" id="password" class="form-control mx-auto my-auto px-2 py-2" placeholder="password" aria-label="password" name="password" onkeypress="capLock(event)" min="8" max="20">
								<span class="material-icons" id="ok" style="position:absolute; left:77%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:77%; top:12px;">error_outline</span>
								<small id="password_error">Error message</small>
								<span class="material-icons align-middle" id="togglePassword" style="cursor:pointer; color:black; opacity:0.6; position:absolute; left:85%; top:10px;">visibility_off</span>
								<span class="text-danger"><?php echo ((isset($_SESSION['password_err']) && $_SESSION['password_err'] != '') ? $_SESSION['password_err'] : '');
															unset($_SESSION['password_err']); ?> </span>
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
								<input type="password" id="cpassword" class="form-control mx-auto my-auto px-2 py-2" placeholder="confirm password" aria-label="password" name="confpassword" onkeypress="capLock(event)" min="8" max="20">
								<span class="material-icons" id="ok" style="position:absolute; left:77%; top:12px;">check_circle</span>
								<span class="material-icons" id="wrong" style="position:absolute; left:77%; top:12px;">error_outline</span>
								<small id="cpassword_error">Error message</small>
								<span class="material-icons align-middle" id="togglePassword1" style="cursor:pointer; color:black; opacity:0.6; position:absolute; left:85%; top:10px;">visibility_off</span>
								<span class="text-danger"><?php echo ((isset($_SESSION['confirm_password_err']) && $_SESSION['confirm_password_err'] != '') ? $_SESSION['confirm_password_err'] : '');
															unset($_SESSION['confirm_password_err']); ?> </span>
							</div>
						</div>

						<div class="row mb-3">
							<div class="register-button text-center">
								<button type="submit" name="sign_in" id="submit" class="btn btn-danger btn-lg" style="border-radius:15px" />Sign Up</button>
							</div>
							<span class="text-success"><?php echo ((isset($_SESSION['success']) && $_SESSION['success'] != '') ? $_SESSION['success'] : '');
														unset($_SESSION['success']); ?> </span>
							<span class="text-danger"><?php echo ((isset($_SESSION['wrong_validation']) && $_SESSION['wrong_validation'] != '') ? $_SESSION['wrong_validation'] : '');
														unset($_SESSION['wrong_validation']); ?> </span>
						</div>

						<div class="row">
							<div class="change_link ">
								<p class="text-center mb-0">Already a member ?<a href="index.php" class="p-1"><button type="button" class="btn btn-danger btn-sm" style="border-radius:10px">Sign in</button></a></p>
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
								<a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
							</p>
						</div>
					</footer>
				</div>
			</div>
		</section>

		<!--info for user corect register-->
		<script>
			$('#submit').on('click', function(e) {
				e.preventDefault();
				var form = $(this).parents('form');
				swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'New user has been added.',
					showConfirmButton: false,
					timer: 5000,
					closeOnConfirm: false
				}, function(isConfirm) {
					if (isConfirm) form.submit();
				});
			});
		</script>

		<script>
			function validation() {

				const username = document.getElementById('username');
				const email = document.getElementById('email');
				const password = document.getElementById('password');
				const password2 = document.getElementById('cpassword');


				// trim to remove the whitespaces
				const usernameValue = username.value.trim();
				const emailValue = email.value.trim();
				const passwordValue = password.value.trim();
				const password2Value = password2.value.trim();

				if (usernameValue === '' || usernameValue === null || usernameValue.length < 3) {
					setErrorFor(username, 'Must contain at least 3 charakters !');
					return false;
				} else {
					setSuccessFor(username);
				}

				if (emailValue === '' || emailValue === null || !isEmail(emailValue)) {
					setErrorFor(email, 'Email cannot be blank');
					return false;
				} else if (!isEmail(emailValue)) {
					setErrorFor(email, 'Invalid email syntax');
					return false;
				} else {
					setSuccessFor(email);
				}

				if (passwordValue === '' || passwordValue === null) {
					setErrorFor(password, 'Password cannot be blank');
					return false;

				} else if (passwordValue.length < 8 || passwordValue.length > 20) {
					setErrorFor(password, 'Password must contain beetween 8-20 charackters');
					return false;
				} else if (!isPasswordValid(passwordValue)) {
					setErrorFor(password, 'Password must contain only letters, numbers and underscores');
					return false;
				} else {
					setSuccessFor(password);
				}

				if (passwordValue !== password2Value) {
					setErrorFor(cpassword, 'Passwords do not match');
					return false;
				} else {
					setSuccessFor(cpassword);
				}

				function setErrorFor(input, message) {
					const formControl = input.parentElement;
					const small = formControl.querySelector('small');
					formControl.className = 'register-input error';
					small.innerText = message;
					return false;
				}

				function setSuccessFor(input) {
					const formControl = input.parentElement;
					formControl.className = 'register-input success';
				}

				function isEmail(email) {
					return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
				}

				function isPasswordValid(password) {
					return /^[a-zA-Z0-9_]*$/.test(password);
				}
			}
		</script>

		<script>
			togglePassword.addEventListener('click', function togglePassword() {
				const password = document.querySelector('#password');
				if (password.type === 'password') {
					password.type = 'text';
					$('#togglePassword').text('visibility');
				} else {
					password.type = 'password';
					$('#togglePassword').text('visibility_off');
				}
			});
		</script>

		<script>
			togglePassword1.addEventListener('click', function togglePassword() {
				const confpassword = document.querySelector('#cpassword');
				if (cpassword.type === 'password') {
					cpassword.type = 'text';
					$('#togglePassword1').text('visibility');
				} else {
					cpassword.type = 'password';
					$('#togglePassword1').text('visibility_off');
				}
			});
		</script>

		<script>
			function capLock(e) {
				var input = document.getElementById('registerForm');
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

		<!--clear the form after page reload -->
		<script>
			$(document).ready(function(e) {
				$('.blur .content form#registerForm .register-input .form-control').value('');
			});
		</script>

		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script>
		<script src="./script.js"></script>

</body>
</html>