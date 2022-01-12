<?php
	include "../Components/Common/Header.php";
    include 'Authenticator.inc.php';

	$auth = new Authenticator();
?>

<div class="form-gap"></div>
<div class="container">
    <div class="row" style="margin-top: 25%">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">
                            <form id="reset-form" role="form" autocomplete="off" class="form" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            if (!$auth->userEmailExists($_POST['email'])) {
                echo'<p class="d-flex justify-content-center links" style="color:red;">User does not exists with provided email.</p>';

            } else {
                if ($auth->sendPasswordResetLink(strip_tags($_POST['email']))) {
                    echo'<p style="padding-left: 10px;" class="d-flex justify-cont ent-center links"> Password reset link has been sent to your email.</p>';

                }
                else {
                    echo'<p style="padding-left: 10px;" class="d-flex justify-cont ent-center links"> Something went wrong.</p>';

                }
            }
        }
    }
?>