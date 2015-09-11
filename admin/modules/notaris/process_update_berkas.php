<?php
	session_start();

	include "berkas_function.php";
	include "../config/connection.php";
	include('../class/mysql_crud.php');

	$db = new Database();
	$db->connect();

	$berkas_id = $_POST['jenis_berkas'];
	$biaya     = $_POST['biaya'];
	$lokasi    = $_POST['lokasi'];

	$idNotaris = $_POST['idNotaris'];

	$queryCek = "SELECT COUNT(*) as row FROM tb_notaris_detail WHERE id_notaris = '$idNotaris' AND id_berkas = '$berkas_id'";
	$sqlCek = mysql_query($queryCek);
	$dataCek  = mysql_fetch_assoc($sqlCek);

	if($dataCek['row'] > 0) {
		echo "
			<script>
				alert('Dokumen yang sama sudah ditambahkan.');
				window.location = 'main.php?module=notaris&menu=update&idNotaris=$idNotaris';
			</script>
		";
	} else {
		$data_detail = array(
				'id_notaris'	=> $idNotaris,
				'id_berkas'		=> $berkas_id,
				'biaya'			=> $biaya,
				'lokasi'		=> $lokasi
			);

		$db->insert('tb_notaris_detail', $data_detail);
		$res = $db->getResult();

		if($res) {
			echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
		}
	}
?>