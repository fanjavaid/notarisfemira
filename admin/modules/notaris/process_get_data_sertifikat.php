<?php 
	include('../../../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();

	$notaris_id = $_GET['idNotaris'];

	$db->select('tb_notaris_sertifikat','tb_notaris_sertifikat.*, tb_kabupaten.nama_kab, tb_kecamatan.nama_kec', 'tb_kabupaten ON tb_notaris_sertifikat.id_kabupaten = tb_kabupaten.id_kab JOIN tb_kecamatan ON tb_notaris_sertifikat.id_kecamatan = tb_kecamatan.id_kec', 'notaris_id = ' . $notaris_id, null, null);
	$res = $db->getResult();

	$json = json_encode($res);
	echo $json;