<?php 
	include('../../../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();

	$notaris_id = $_GET['idNotaris'];

	$columns = 'tb_notaris_pengurusanberkas.*, tb_berkas.nama_berkas, tb_profil.fullname';
	$joins	 = 'tb_berkas ON tb_berkas.uid = tb_notaris_pengurusanberkas.id_berkas JOIN tb_karyawan ON tb_karyawan.uid = tb_notaris_pengurusanberkas.id_bag_lapangan JOIN tb_profil ON tb_karyawan.profil_id = tb_profil.uid';
	$db->select('tb_notaris_pengurusanberkas', $columns, $joins, 'notaris_id = ' . $notaris_id, null, null);
	$res = $db->getResult();

	$json = json_encode($res);
	echo $json;
