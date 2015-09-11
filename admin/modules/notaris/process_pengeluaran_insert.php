<?php
	session_start();

	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();


	// Data mining...
	$id_notaris			= $_POST['id_notaris'];

	$jenis_pengeluaran	= $_POST['jenis_pengeluaran'];
	$biaya				= $_POST['biaya'];
	$tgl_pengeluaran	= $_POST['tgl_pengeluaran'];

	$count 	 	 	= count($_POST['jenis_pengeluaran']);
	$data_detail 	= array();
	for($i = 0; $i < $count; $i++) {
		$data_detail = array(
				'id_notaris'			=> $id_notaris,
				'jenis_pengeluaran'		=> $jenis_pengeluaran[$i],
				'biaya'					=> $biaya[$i],
				'tgl_pengeluaran'		=> $tgl_pengeluaran[$i]
			);

		$db->insert('tb_pengeluaran', $data_detail);
		$res = $db->getResult();

		//print_r($data_detail);
	}

	// Destroy pengeluaran session
	unset($_SESSION['pengeluaran']);
	echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=pengeluaran\">";

?>