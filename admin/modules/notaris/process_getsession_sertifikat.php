<?php
	session_start();

	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	$json = array();
	if(isset($_SESSION['sertifikat'])) {
		for($i = 0; $i < count($_SESSION['sertifikat']); $i++) {
			$id_kab = abs($_SESSION['sertifikat'][$i]['id_kabupaten']);
			$db->select('tb_kabupaten','tb_kabupaten.id_kab, tb_kabupaten.nama_kab as nama_kabupaten',null,'tb_kabupaten.id_kab='.$id_kab, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$res = $db->getResult();

			$id_kec = $_SESSION['sertifikat'][$i]['id_kecamatan'];
			$db->select('tb_kecamatan','tb_kecamatan.id_kec, tb_kecamatan.nama_kec',null,'tb_kecamatan.id_kec='.$id_kec, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$res_kec = $db->getResult();

			$res[0]['nomor'] = $_SESSION['sertifikat'][$i]['nomor'];
			$res[0]['id_kabupaten'] = $_SESSION['sertifikat'][$i]['id_kabupaten'];
			$res[0]['id_kecamatan'] = $_SESSION['sertifikat'][$i]['id_kecamatan'];
			$res[0]['nama_kecamatan'] = $res_kec[0]['nama_kec'];

			array_push($json, $res[0]);
		}
	}

	echo json_encode($json);
?>