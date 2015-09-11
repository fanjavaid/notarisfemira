<?php
	//session_start();

	//include "pengeluaran_function.php";

	$id_notaris 		= $_POST['id_notaris'];
	$jenis_pengeluaran 	= $_POST['jenis_pengeluaran'];
	$biaya     			= $_POST['biaya'];
	$tgl_pengeluaran    = $_POST['tgl_pengeluaran'];

	// tambah_pengeluaran($id_notaris, $jenis_pengeluaran, $biaya, $tgl_pengeluaran);
	
	// if(true) {
	// 	echo 'true';
	// } else {
	// 	echo 'false';
	// }

	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	$data_pengeluaran = array(
		'id_notaris' => $id_notaris,
		'jenis_pengeluaran' => $jenis_pengeluaran,
		'biaya' => $biaya,
		'tgl_pengeluaran' => $tgl_pengeluaran
	);

	$db->insert('tb_pengeluaran', $data_pengeluaran); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	if ($res) {
		echo 'true';
	} else {
		echo 'false';
	}

?>