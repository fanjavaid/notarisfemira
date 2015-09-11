<?php
	session_start();

	include "berkas_function_upd.php";
	// include "../../../config/connection.php";
	include('../../../class/mysql_crud.php');

	$db = new Database();
	$db->connect();

	$berkas_id 			= $_POST['id_jenis_berkas'];
	$tgl_penyerahan     = $_POST['tgl_penyerahan_bank'];
	$no_tanda_terima    = $_POST['no_tanda_terima'];
	
	tambah_berkas($berkas_id, $tgl_penyerahan, $no_tanda_terima)   ;
	if(true) {
		//echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
		echo 'true';
	} else {
		echo 'false';
	}
?>