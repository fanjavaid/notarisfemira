<?php
	// if(isset($_SESSION['pengeluaran'])) {
	// 	for($i = 0; $i < count($_SESSION['pengeluaran']); $i++) {
	// 		$uid = abs($_SESSION['pengeluaran'][$i]['jenis_pengeluaran']);

	// 		$json[$i]['jenis_pengeluaran'] = $_SESSION['pengeluaran'][$i]['jenis_pengeluaran'];
	// 		$json[$i]['biaya'] = $_SESSION['pengeluaran'][$i]['biaya'];
	// 		$json[$i]['tgl_pengeluaran'] = $_SESSION['pengeluaran'][$i]['tgl_pengeluaran'];


	// 	}
	// }

	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	$id_notaris = $_GET['id_notaris'];

	$db->select('tb_pengeluaran','tb_pengeluaran.*',null,'tb_pengeluaran.id_notaris='.$id_notaris, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	echo json_encode($res);
?>