<?php
	if(isset($_GET['module'])) {
		$page 	= $_GET['module'];
		$dir	= "modules/$page";
		
		if(file_exists($dir) && is_dir($dir)) {
			
			if(isset($_GET['menu'])) {
				$menu = $_GET['menu'];
				
				if(file_exists("$dir/body_$menu.php")) {
					include "$dir/body_$menu.php";
				} else {
					include "modules/404.php";
				}
				
			} else if(isset($_GET['process'])) {
			
				$process = $_GET['process'];
				
				if(file_exists("$dir/process_$process.php")) {
					include "$dir/process_$process.php";
				} else {
					include "modules/404.php";
				}
				
			} else {
				if(file_exists("$dir/body_home.php")) {
					include "$dir/body_home.php";
				} else {
					include "modules/404.php";
				}
			}
			
		} else {
			include "modules/404.php";
		}
		
	} else {
		include "index.php";
	}
?>	