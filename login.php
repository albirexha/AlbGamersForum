<?php include_once('inc/sqlFunctions.php'); ?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="login.css">
    <script src="inc/loginForm.js"></script>
    <style> 
        .error{
            color: red; text-align: center; margin-bottom: 5px; margin-top: 2px;
        }
    </style>
</head>


<?php
if(isset($_POST['login'])){
    $username = $_POST['usernameFL'];
    $password = $_POST['passwordFL'];
    login($username, $password);
}

if(isset($_POST['signup'])){
    $emri = $_POST["emriField"];
    $email = $_POST["emailField"];
    $username = $_POST['usernameField'];
    $password = $_POST['passwordField'];
    signup($username, $password, $emri, $email);
}

?>
<body>
	<div class="wrapper" style="margin-top: 3%;">
		<h1>ALB GAMERS FORUM</h1>
		<div class="container">
        <form method="POST" name="signupForm" id="signup-formm">

				<div>
					<div class="login" onclick="switchVisibleLogin()">Log In</div>
					<div class="signup" onclick="switchVisibleSignUp()">Sign Up</div>
				</div>
				<div class="login-form" id="login-form">
					<h4 id="Usr"></h4>
                    <input id="emailLog" name="usernameFL" type="text" placeholder="Username" class="input"><br />
                    <input id="pwLog" name="passwordFL" type="password" placeholder="Password" class="input"><br />
					<input type="submit" class="btn" value="Login" name="login">
				</div>

				<div class="signup-form" id="signup-form" style="display: none;">
					<input id="emriSI" type="text" name="emriField" placeholder="Emri i plote" class="input"><br />
					<input id="emailSI" type="email" name="emailField" placeholder="Your Email Address" class="input"><br />
					<input id="userSI" type="text" name="usernameField" placeholder="Choose a Username" class="input"><br />
					<input id="pwSI" type="password" name="passwordField" placeholder="Choose a Password" class="input"><br />
					<input type="submit" class="btn" value="Create account" name="signup">
				</div>
			</form>

		</div>
	</div>

</body>
<script src="inc/jquery-1.12.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"> </script>
    <script src="inc/jquery.validatr.js"></script>
    
    <script>


$(document).ready(function(){

$("#signup-formm").validate({
    rules: {
        emailField: {
            required: true,
            email: true
        },
        passwordField: {
            required: true
        },
        usernameField: {
            required: true
        },
        emriField: {
            required: true 
        },
        usernameFL: {
            required: true
        },
        passwordFL: {
            required: true
        }
    },
    messages: {
        emailField: {
            required: "Ju lutem shtypni nje email."
        },
        passwordField: {
            required: "Ju lutem shtypni nje password."
        },
        usernameField: {
            required: "Ju lutem shtypni nje username."
        },
        emriField: {
            required: "Ju lutem shtypni emrin tuaj."
        },
        usernameFL:{
            required: "Ju lutem shtypni username tuaj."
        },
        passwordFL:{
            required: "Ju lutem shtypni passwordin tuaj."
        }
    }
});

});
    </script>
</html>