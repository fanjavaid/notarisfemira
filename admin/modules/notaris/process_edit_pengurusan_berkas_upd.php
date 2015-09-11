<?php
	session_start();

	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	$id_urus_berkas = $_POST['id_pengurusan_berkas'];
	$dataUpdate = array(
		'notaris_id' => $_POST['notaris_id_upd'],
		'id_berkas' => $_POST['id_urus_berkas_upd'],
		'tgl_berkas' => $_POST['tgl_berkas_upd'],
		'nomor_bpn' => $_POST['nomor_bpn_upd'],
		'tgl_selesai' => $_POST['tgl_selesai_upd'],
		'id_bag_lapangan' => $_POST['id_bagian_lapangan_upd']
	);

	$db->update('tb_notaris_pengurusanberkas', $dataUpdate, 'id = ' . $id_urus_berkas);

	if(true) {
		//echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
		echo 'true';
	} else {
		echo 'false';
	}
?>