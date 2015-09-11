<?php
	session_start();

	if(isset($_GET['sess_id'])) {
		$session_id = $_GET['sess_id'];
	}

	function remove_product($session_id){
		$session_id	= intval($session_id);
		$max		= count($_SESSION['berkas_upd']);
		for($i = 0; $i < $max;$i++){
			if($session_id	== $_SESSION['berkas_upd'][$i]['id_jenis_berkas']){
				unset($_SESSION['berkas_upd'][$i]);
				break;
			}
		}
		$_SESSION['berkas_upd']	= array_values($_SESSION['berkas_upd']);
	}

	if(isset($_GET['db_id'])) {
		include('../../../class/mysql_crud.php');
		$db = new Database();
		$db->connect();

		// Do delete
		$uid = $_GET['db_id'];

		// Delete Detail
		$db->delete('tb_notaris_berkas','id='.$uid);
		$detail_notaris = $db->getResult();

		echo 'true';
	} else {
		remove_product($session_id);
		echo 'true';
	}
?>