<?php 
	include('../../../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();

	$notaris_id = $_GET['idNotaris'];

	$db->select('tb_notaris_berkas','tb_notaris_berkas.*, tb_berkas.nama_berkas', 'tb_berkas ON tb_notaris_berkas.id_berkas = tb_berkas.uid', 'notaris_id = ' . $notaris_id, null, null);
	$res = $db->getResult();

	$json = json_encode($res);
	echo $json;
