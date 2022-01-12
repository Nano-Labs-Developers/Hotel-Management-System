<?php 
    include "../Components/Common/Header.php";
    include 'Authenticator.inc.php';
?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<div style="text-align:center;">
					<img src="./images/ld.png" alt="" width="50px" height="50px">
				</div>
				<h3>Reset Password</h3>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Reset Password" class="btn float-right login_btn" style="width: 150px;">
					</div>
				</form>
			</div>
            <div class="card-footer">
				<div class="d-flex justify-content-center links">
					Back to <a href="index.php">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "../Components/Common/Footer.php"; ?>

<?php
	$auth = new Authenticator();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['submit'])) {
			if ($_POST['password'] != $_POST['confirm_password']){
				echo'<p class="d-flex justify-content-center links" style="color:red;">Your passwords do not match.</p>';
			}
			else {
				if (isset($_GET['token']) && isset($_GET['email'])) {
					$token = $_GET['token'];
					$email = $_GET['email'];

					if($auth->validatePasswordRestLink($token, $email)) {
						if($auth->resetPassword($email, strip_tags($_POST['password']))) {
							echo'<p style="padding-left: 10px;" class="d-flex justify-content-center links">Your password been changed successfully. Please login to your account with new password.</p>';
						}
						else {
							echo'<p class="d-flex justify-content-center links" style="color:red;">Password cannto change.</p>';
						}
					}
					else {
						echo'class="d-flex justify-content-center links" style="color:red;">Invalid password reset link.</p>';
					}
				}
				else {
					echo'<p class="d-flex justify-content-center links" style="color:red;">Something went wrong.</p>';
				}
			}
		}
	}
?>
