<?php
	session_start();
	include "sertifikat_function_upd.php";

	$nomor 			= $_POST['nomor_sertifikat'];
	$id_kabupaten   = $_POST['id_kabupaten'];
	$id_kecamatan   = $_POST['id_kecamatan'];

	tambah_sertifikat($nomor, $id_kabupaten, $id_kecamatan);
	if(true) {
		//echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
		echo 'true';
	} else {
		echo 'false';
	}
?>