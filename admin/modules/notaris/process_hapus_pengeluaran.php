<?php

	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	// Do delete
	$uid = $_POST['uid'];
	// Delete Detail
	$db->delete('tb_pengeluaran','uid='.$uid);
	$detail_notaris = $db->getResult();

	if($detail_notaris) {
		echo 'true';
	} else {
		echo 'false';
	}
?>