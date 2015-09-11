<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();

	print_r(isset($_SESSION['berkas_upd'])?$_SESSION['berkas_upd'] : '');
	print_r(isset($_SESSION['urus_berkas_upd'])? $_SESSION['urus_berkas_upd'] : '');
	print_r(isset($_SESSION['sertifikat_upd'])? $_SESSION['sertifikat_upd'] : '');

	// if (isset($_SESSION['berkas_upd']) {
		
	// }

	// if (isset($_SESSION['urus_berkas_upd']) {

	// }

	// if (isset($_SESSION['sertifikat_upd']) {

	// }

	/**
	1. Check masing-masing session apakah ada datanya atau tida
	2. Lakukan update ke Data master notaris
	3. Lakukan penyimpanan data pada session yang ada datanya
	4. Redirect
	*/

	/*$idNotaris		= $_POST['idNotaris'];

	$debitur		= $_POST['debitur'];
	$pemberi_order	= $_POST['pemberi_order'];
	$pemberkasan	= $_POST['pemberkasan'];
	$bag_input		= $_POST['bag_input'];
	$bag_lapangan	= $_POST['bag_lapangan'];
	$tgl_input		= $_POST['tgl_input'];
	$tgl_penyerahan	= $_POST['tgl_penyerahan'];
	$status			= $_POST['status'];

	$data_master 	= array(
			'id_debitur'			=> $debitur, 
			'id_reff_order'			=> $pemberi_order, 
			'id_kar_pemberkasan'	=> $pemberkasan, 
			'id_kar_input'			=> $bag_input, 
			'id_kar_lapangan'		=> $bag_lapangan, 
			'status'				=> $status, 
			'tgl_masuk'				=> $tgl_input, 
			'tgl_penyerahan'		=> $tgl_penyerahan,
		);

	if($status == 1 && $_POST['tgl_selesai'] == '0000-00-00') {
		$data_master['tgl_selesai'] = date('Y-m-d');
		echo "Execute";
	} else if($status == 0) {
		$data_master['tgl_selesai'] = '0000-00-00 00:00:00';
	} else {
		
	}
	
	$db->update('tb_notaris', $data_master, 'uid='.$idNotaris);
	$res = $db->getResult();

	if($res) {
		echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=home\">";
	}
?>*/
