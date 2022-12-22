<?php
	session_start();
	unset($_SESSION['session_nickname']);
	session_destroy();
	header("location:login.php");
	?>
