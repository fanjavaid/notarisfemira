<?php
	session_start();
	include "pengurusan_berkas_function_upd.php";

	$unique_sess_id		= time();
	$id_urus_berkas		= $_POST['id_urus_berkas'];
	$nomor_bpn 			= $_POST['nomor_bpn'];
	$tgl_berkas   		= $_POST['tgl_berkas'];
	// $tgl_selesai   		= $_POST['tgl_selesai'];
	$tgl_selesai   		= '0000-00-00';
	$id_bagian_lapangan = $_POST['id_bagian_lapangan'];

	tambah_pengurusan_berkas($id_urus_berkas, $unique_sess_id, $nomor_bpn, $tgl_berkas, $tgl_selesai, $id_bagian_lapangan);
	if(true) {
		//echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
		echo 'true';
	} else {
		echo 'false';
	}
?>