<?php
	date_default_timezone_set('Asia/Bangkok');

	session_start();
	include('class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	// Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$db->select('tb_user','username,password,last_login',NULL,'username="'.$username.'" AND password="'.$password.'"',NULL);
	$res = $db->getResult();
	
	$numRow =  $db->numRows();
	
	if ($numRow > 0) {
		$_SESSION['username'] = $username;
		$_SESSION['last_login'] = $res[0]['last_login'];
		//header("Location:admin/index.php");

		// Update last login
		$db->update('tb_user',array('last_login'=> date('Y-m-d H:i:s')), 'username="'.$username.'"');
		$res = $db->getResult();

		echo "<META http-equiv=\"refresh\" content=\"0;URL=admin/index.php\">";
	} else {
		echo "
			<script>
				alert('Invalid username or password!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=index.php\">
		";
	}
	
	//print_r($res);
?>