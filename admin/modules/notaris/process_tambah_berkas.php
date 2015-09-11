<?php
	session_start();

	include "berkas_function.php";
	include "../../../config/connection.php";
	include('../../../class/mysql_crud.php');

	$db = new Database();
	$db->connect();

	$berkas_id 			= $_POST['id_jenis_berkas'];
	$tgl_penyerahan     = $_POST['tgl_penyerahan_bank'];
	$no_tanda_terima    = $_POST['no_tanda_terima'];

	// $idNotaris = $_POST['idNotaris'];
	// $queryCek = "SELECT COUNT(*) as row FROM tb_notaris_detail WHERE id_notaris = '$idNotaris' AND id_berkas = '$berkas_id'";
	// $sqlCek = mysql_query($queryCek);
	// $dataCek  = mysql_fetch_assoc($sqlCek);

	// if($dataCek['row'] > 0) {
	// 	echo "
	// 		<script>
	// 			alert('Dokumen yang sama sudah ditambahkan.');
	// 			window.location = 'main.php?module=notaris&menu=update&idNotaris=$idNotaris';
	// 		</script>
	// 	";
	//} else {
		// $data_detail = array(
		// 		'id_notaris'	=> $idNotaris,
		// 		'id_berkas'		=> $berkas_id,
		// 		'biaya'			=> $biaya,
		// 		'lokasi'		=> $lokasi
		// 	);

		// $db->insert('tb_notaris_detail', $data_detail);
		// $res = $db->getResult();

		tambah_berkas($berkas_id, $tgl_penyerahan, $no_tanda_terima)   ;
		if(true) {
			//echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
			echo 'true';
		} else {
			echo 'false';
		}
	//}

	// if (isset($_POST['berkas_upd'])) {
	// 	$idNotaris = $_POST['idNotaris'];

	// 	$queryCek = "SELECT COUNT(*) as row FROM tb_notaris_detail WHERE id_notaris = '$idNotaris' AND id_berkas = '$berkas_id'";
	// 	$sqlCek = mysql_query($queryCek);
	// 	$dataCek  = mysql_fetch_assoc($sqlCek);

	// 	if($dataCek['row'] > 0) {
	// 		echo "
	// 			<script>
	// 				alert('Dokumen yang sama sudah ditambahkan.');
	// 				window.location = 'main.php?module=notaris&menu=update&idNotaris=$idNotaris';
	// 			</script>
	// 		";
	// 	} else {
	// 		$data_detail = array(
	// 				'id_notaris'	=> $idNotaris,
	// 				'id_berkas'		=> $berkas_id,
	// 				'biaya'			=> $biaya,
	// 				'lokasi'		=> $lokasi
	// 			);

	// 		$db->insert('tb_notaris_detail', $data_detail);
	// 		$res = $db->getResult();

	// 		if($res) {
	// 			echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=update&idNotaris=$idNotaris\">";	
	// 		}
	// 	}
	// } else {
	// 	tambah_berkas($berkas_id, $biaya, $lokasi);
	// 	echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=insert\">";
	// }
?>