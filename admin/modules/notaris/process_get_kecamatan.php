<?php 
	include('../../../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();

	$id_kab = $_GET['id_kab'];

	$db->select('tb_kecamatan','id_kec as id, nama_kec as text', null, 'id_kab = ' . $id_kab, null, null);
	$res = $db->getResult();

	$json = json_encode($res);
	echo $json;
