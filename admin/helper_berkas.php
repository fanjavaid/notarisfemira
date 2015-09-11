<?php
	include "../class/mysql_crud.php";

	$db = new Database();
	$db->connect();

	$db->select('tb_berkas','tb_berkas.*',null, null, null);
	$res = $db->getResult();

	$json = array();

	foreach ($res as $data) {
		$json[] = $data;
	}

	echo json_encode($json);
?>