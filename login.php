<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<style>
	/* Coded with love by Mutiullah Samim */
	body,
	html {
		margin: 0;
		padding: 0;
		height: 100%;
		background: #e6b800 !important;
	}
	.user_card {
		height: 400px;
		width: 350px;
		margin-top: auto;
		margin-bottom: auto;
		background: #ff4d4d;
		position: relative;
		display: flex;
		justify-content: center;
		flex-direction: column;
		padding: 10px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		border-radius: 5px;

	}
	.brand_logo_container {
		position: absolute;
		height: 170px;
		width: 170px;
		top: -75px;
		border-radius: 50%;
		background: #e6b800;
		padding: 10px;
		text-align: center;
	}
	.brand_logo {
		height: 150px;
		width: 150px;
		border-radius: 50%;
		border: 2px solid white;
	}
	.form_container {
		margin-top: 100px;
	}
	.login_btn {
		width: 100%;
		background: white !important;
		color: #ff4d4d !important;
	}
	.login_btn:focus {
		box-shadow: none !important;
		outline: 0px !important;
	}
	.login_container {
		padding: 0 2rem;
	}
	.input-group-text {
		background: #ffcc80 !important;
		color: white !important;
		border: 0 !important;
		border-radius: 0.25rem 0 0 0.25rem !important;
	}
	.input_user,
	.input_pass:focus {
		box-shadow: none !important;
		outline: 0px !important;
	}
	.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
		background-color: #c0392b !important;
	}
	</style>

</head>

<!--Coded with love by Mutiullah Samim-->
<body>

	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="img/franguinoLogo.jpeg" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action="login2.php" method="post">
						<div class="input-group mb-3">
							<?php
							if(isset($_COOKIE['msgLogin'])){
								echo $_COOKIE['msgLogin'];
								setcookie('msgLogin');
							}?>
							<div class="input-group-append">
								<span class="input-group-text"><i class="bi bi-person-bounding-box"></i></i></span>
							</div>
							<input type="text" name="nome" class="form-control input_user" value="" placeholder="E-mail do usuario">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="bi bi-lock"></i></span>
							</div>
							<input type="password" name="senha" class="form-control input_pass" value="" placeholder="Senha">
						</div>
						<br>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<input type="submit" name="button" class="btn login_btn" value="Entrar"></input>
				   </div>
					</form>
				</div>

			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>
