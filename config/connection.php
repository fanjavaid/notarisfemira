<?php
	//variabel untuk menampung data koneksi
	
	$host 	= "localhost";
	$user	= "userdev";
	$passwd	= "password";
	$dbname	= "db_notarisfemira";
	
	//koneksi ke databases server mysql
	@mysql_connect ($host, $user, $passwd);
	
	//pilih databasesnya
	@mysql_select_db($dbname);
?>