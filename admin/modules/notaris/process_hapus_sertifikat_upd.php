<?php
	session_start();

	if(isset($_GET['session_id'])) {
		$session_id = $_GET['session_id'];
	}

	function remove_product($session_id){
		$session_id	= intval($session_id);
		$max		= count($_SESSION['sertifikat_upd']);
		for($i = 0; $i < $max;$i++){
			if($session_id	== $_SESSION['sertifikat_upd'][$i]['nomor']){
				unset($_SESSION['sertifikat_upd'][$i]);
				break;
			}
		}
		$_SESSION['sertifikat_upd']	= array_values($_SESSION['sertifikat_upd']);
	}

	if(isset($_GET['db_id'])) {
		include('../../../class/mysql_crud.php');
		$db = new Database();
		$db->connect();

		// Do delete
		$uid = $_GET['db_id'];
		// $idNotaris = $_GET['idNotaris'];

		// Delete Sertifikat
		$db->delete('tb_notaris_sertifikat','id='.$uid);
		$sertifikat_notaris = $db->getResult();

		echo 'true';
	} else {
		remove_product($session_id);
		echo 'true';
	}
?>