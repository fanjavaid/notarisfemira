<?php
	session_start();

	if(isset($_GET['session_id'])) {
		$session_id = $_GET['session_id'];
	}

	function remove_product($session_id){
		$session_id	= intval($session_id);
		$max		= count($_SESSION['sertifikat']);
		for($i = 0; $i < $max;$i++){
			if($session_id	== $_SESSION['sertifikat'][$i]['nomor']){
				unset($_SESSION['sertifikat'][$i]);
				break;
			}
		}
		$_SESSION['sertifikat']	= array_values($_SESSION['sertifikat']);
	}

	remove_product($session_id);
	echo 'true';

	// if(isset($_GET['db_id'])) {
	// 	include('../class/mysql_crud.php');
	// 	$db = new Database();
	// 	$db->connect();

	// 	// Do delete
	// 	$uid = $_GET['db_id'];
	// 	$idNotaris = $_GET['idNotaris'];

	// 	// Delete Detail
	// 	$db->delete('tb_notaris_detail','uid='.$uid);
	// 	$detail_notaris = $db->getResult();

	// 	if($detail_notaris) {
	// 		echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";
	// 	}

	// } else {
	// 	remove_product($session_id);
	// 	echo 'true';
	// }
?>