<?php
	session_start();

	$json = array();
	if(isset($_SESSION['pengeluaran'])) {
		for($i = 0; $i < count($_SESSION['pengeluaran']); $i++) {
			$uid = abs($_SESSION['pengeluaran'][$i]['jenis_pengeluaran']);

			$json[$i]['jenis_pengeluaran'] = $_SESSION['pengeluaran'][$i]['jenis_pengeluaran'];
			$json[$i]['biaya'] = $_SESSION['pengeluaran'][$i]['biaya'];
			$json[$i]['tgl_pengeluaran'] = $_SESSION['pengeluaran'][$i]['tgl_pengeluaran'];


		}
	}

	echo json_encode($json);
?>