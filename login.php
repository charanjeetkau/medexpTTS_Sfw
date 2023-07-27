<?php
session_start();
$user = "tts";
$pass = "tts@123";
$msg = "";
$color = "";

if (isset($_POST['login'])) {
	$plaintext = $_POST['user'];
	$newpass = $_POST['pass'];
	if ($plaintext == $user && $newpass == $pass) {
		$_SESSION['loggedin'] = true;
		header("Location:dashboard.php");
	} else {
		$msg = "Invalid User Credentials";
		$color = "bg-danger-subtle";
	}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"
		rel="stylesheet" />
	<script crossorigin="anonymous"
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"></script>
	<script src="jquery-3.6.4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 pt-0">
				<p class=" rounded p-2 mb-3 mt-3 text-center <?php echo $color; ?> text-danger"><?php echo $msg; ?></p>
				<form class="login100-form validate-form" method="post" action="#">


					<span class="login100-form-title p-b-48">
						<img src="ttslogo.jpg" width="55%%" class="rounded m-auto">
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
						<input class="input100" type="text" name="user" id="user">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" id="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" name="login">Login</button>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>
	<script src="{% static 'js/main.js' %}"></script>

</body>

</html>
<script>

</script>