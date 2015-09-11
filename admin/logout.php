<?php
	session_start();
	
	if(isset($_SESSION['username'])) {
		if ($_SESSION['username'] != null) {
			session_destroy();
			header("Location:../index.php");
		}
	}
?>	