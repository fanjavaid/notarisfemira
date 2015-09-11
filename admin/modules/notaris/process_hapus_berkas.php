<?php
	session_start();

	if(isset($_GET['sess_id'])) {
		$session_id = $_GET['sess_id'];
	}

	function remove_product($session_id){
		$session_id	= intval($session_id);
		$max		= count($_SESSION['berkas']);
		for($i = 0; $i < $max;$i++){
			if($session_id	== $_SESSION['berkas'][$i]['id_jenis_berkas']){
				unset($_SESSION['berkas'][$i]);
				break;
			}
		}
		$_SESSION['berkas']	= array_values($_SESSION['berkas']);
	}

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
		remove_product($session_id);
		echo 'true';
	// }
?>