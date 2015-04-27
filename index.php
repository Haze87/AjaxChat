<!DOCTYPE HTML>
<html>
<head>
   <title>Just Some Projects</title>
   <link type="text/css" rel="stylesheet" href="css/main.css"/>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<body>

	<?php
	require_once('core.php');
	//check if user is running a session
	if(isset($_SESSION['id']))
	{
		//show home
		require_once('home.php');
	}
	else
	{
		// show login and registration forms
		require_once('forms.php');

		//login controller
		if(isset($_POST['l_user']) && isset($_POST['l_password']))
		{
			$l_user      = $_POST['l_user'];
			$l_password  = $_POST['l_password'];

			$User = new User();
			$User->login($l_user, $l_password)
			     ->startSession();
			echo '<script type="text/javascript"> window.location="index.php";</script>';
	    }

	   //signup controller
	    if(isset($_POST['r_username']) &&
	       isset($_POST['r_email']) &&
	       isset($_POST['r_password']) &&
	       isset($_POST['r_password_again']))
	    {
	    	$Registration = new Registration();
	    	$Registration -> username($_POST['r_username'])
						  -> email($_POST['r_email'])
						  -> password($_POST['r_password'])
						  -> password_again($_POST['r_password_again'], $_POST['r_password'])
						  -> encrypt()
						  -> register();
	    }
	}
	?>
	<!--
	<div id="test"></div>
	<div id="scrollPos"></div>
	<div id="windowSize"></div>
	!-->

	<script type='text/javascript' src="js/jquery.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>
	<script type='text/javascript' src="js/script.js"></script>
</body>
</html>