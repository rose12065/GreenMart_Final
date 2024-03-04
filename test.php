<?php 
	
// Checking valid form is submit or not 
if (isset($_POST['submit_btn'])) { 
	
	// Storing name in $name variable 
	$name = $_POST['name']; 
	
	// Storing google recaptcha response 
	// in $recaptcha variable 
	$recaptcha = $_POST['g-recaptcha-response']; 
} 
?>
 
<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1.0"> 

	<style>
    .container { 
	border: 1px solid rgb(73, 72, 72); 
	border-radius: 10px; 
	margin: auto; 
	padding: 10px; 
	text-align: center; 
} 
	
h1 { 
	margin-top: 10px; 
} 
	
input[type="text"] { 
	padding: 10px; 
	border-radius: 5px; 
	margin: 10px; 
	font-family: "Times New Roman", Times, serif; 
	font-size: larger; 
} 
	
button { 
	border-radius: 5px; 
	padding: 10px; 
	color: #fff; 
	background-color: #167deb; 
	border-color: #0062cc; 
	font-weight: bolder; 
	cursor: pointer; 
} 
	
button:hover { 
	text-decoration: none; 
	background-color: #0069d9; 
	border-color: #0062cc; 
} 
	
.g-recaptcha { 
	margin-left: 513px; 
}

  </style>

	<!-- Google reCAPTCHA CDN -->
	<script src= 
		"https://www.google.com/recaptcha/api.js" async defer> 
	</script> 
</head> 

<body> 
	<div class="container"> 
		<h1>Google reCAPTCHA</h1> 

		<!-- HTML Form -->
		<form action="action.php" method="post"> 
			<input type="text" name="name" id="name"
				placeholder="Enter Name" required> 
			<br> 

			<!-- div to show reCAPTCHA -->
			<div class="g-recaptcha"
				data-sitekey="6LcydIEpAAAAALNKpANcMhRaMUIfqSBt-0NE8xk4"> 
			</div> 
			<br> 

			<button type="submit" name="submit_btn"> 
				Submit 
			</button> 
		</form> 
	</div> 
</body> 

</html>
