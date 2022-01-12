<?php
	include "../Components/Common/Header.php";
	include 'Authenticator.inc.php';

	$auth = new Authenticator();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['Username']) || isset($_POST['Password'])) {
			$auth->login($_POST['Username'], $_POST['Password']);
		}
	}
?>

<body style="overflow: hidden;">
	<div class="container-fluid">
		<div class="row no-gutter" style="background: linear-gradient(-70deg, #e8e8e8 40%, rgba(0, 0, 0, 0) 70%), url('https://i.imgur.com/BiQhRbg.jpg'); padding-bottom: 100%;">
			<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
				<div class="col-md-8 col-lg-6">
					<div class="login d-flex align-items-center py-5">
						<div class="container">
							<div class="row">
								<div class="col-md-9 col-lg-8 mx-auto" style="user-select: none;">
									<h3 class="login-heading mb-4" style="color: black; text-align: center;">Welcome back!</h3>

									<form method="POST" action="">
										<div class="form-label-group mb-2">
											<label for="inputUsername" style="color: black;">Username</label>
											<input type="text" name="Username" id="Username" class="form-control" placeholder="Username" required autofocus>
										</div>
										<div class="form-label-group">
											<label for="inputPassword" style="color: black;">Password</label>
											<input type="password" name="Password" id="Password" class="form-control" placeholder="Password" required>
										</div>
										<br>
										<div class="custom-control custom-checkbox mb-3">
											<input type="checkbox" name="remember" class="custom-control-input" id="remember">
											<label class="custom-control-label" for="remember" style="color: black;">Remember password</label>
										</div>
										<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" name="user" id="user" type="submit">Sign in</button>
										<div class="text-center">
											<a class="small font-weight-bold" href="forgotpassword" style="color: black;">Forgot password?</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>