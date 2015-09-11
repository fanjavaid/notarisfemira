<?php
	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	session_start();

	$json = array();
	if(isset($_SESSION['berkas_upd'])) {
		for($i = 0; $i < count($_SESSION['berkas_upd']); $i++) {
			$uid = abs($_SESSION['berkas_upd'][$i]['id_jenis_berkas']);

			$db->select('tb_berkas','tb_berkas.*',null,'tb_berkas.uid='.$uid, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$res = $db->getResult();
			$res[0]['tgl_penyerahan_bank'] = $_SESSION['berkas_upd'][$i]['tgl_penyerahan_bank'];
			$res[0]['no_tanda_terima'] 	   = $_SESSION['berkas_upd'][$i]['no_tanda_terima'];

			array_push($json, $res[0]);
		}
	}

	echo json_encode($json);
?>