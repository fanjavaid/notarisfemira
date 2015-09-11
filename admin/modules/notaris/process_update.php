<?php
	session_start();
	include('../class/mysql_crud.php');
	include('../class/currency.php');
	
	$db = new Database();
	$db->connect();

	// print_r($_POST);

	// print_r(isset($_SESSION['berkas_upd'])?$_SESSION['berkas_upd'] : '');
	// print_r(isset($_SESSION['urus_berkas_upd'])? $_SESSION['urus_berkas_upd'] : '');
	// print_r(isset($_SESSION['sertifikat_upd'])? $_SESSION['sertifikat_upd'] : '');

	$id_notaris 		= $_POST['idNotaris'];
	$debitur			= $_POST['debitur'];
	$pemberi_order		= $_POST['pemberi_order'];
	$pemberkasan 		= $_POST['pemberkasan'];
	$bag_input 			= $_POST['bag_input'];
	$tgl_input 			= $_POST['tgl_input'];
	$total_penerimaan 	= getAmount($_POST['total_penerimaan']);
	$tgl_penyerahan 	= $_POST['tgl_penyerahan'];
	$status 			= $_POST['status'];

	/**
	| DATA MASTER NOTARIS
	*/
	$data_master 	= array(
		'id_debitur'			=> $debitur, 
		'id_reff_order'			=> $pemberi_order, 
		'id_kar_pemberkasan'	=> $pemberkasan, 
		'id_kar_input'			=> $bag_input, 
		'id_kar_lapangan'		=> 0, // Not used and will be removed
		'status'				=> $status, 
		'tgl_masuk'				=> $tgl_input, 
		'total_penerimaan'		=> $total_penerimaan, 
		'tgl_penyerahan'		=> $tgl_penyerahan, 
	);

	$db->update('tb_notaris', $data_master, 'uid='.$id_notaris);
	$res = $db->getResult();

	/**
	1. Check masing-masing session apakah ada datanya atau tida
	2. Lakukan update ke Data master notaris
	3. Lakukan penyimpanan data pada session yang ada datanya
	4. Redirect
	*/

	if (isset($_SESSION['berkas_upd'])) {
		/**
		| JENIS BERKAS
		*/
		$data_berkas = array();
		for ($i=0; $i < count($_SESSION['berkas_upd']); $i++) { 
			$id_berkas = $_SESSION['berkas_upd'][$i]['id_jenis_berkas'];
			$no_tanda_terima = $_SESSION['berkas_upd'][$i]['no_tanda_terima'];
			$tgl_penyerahan_bank = $_SESSION['berkas_upd'][$i]['tgl_penyerahan_bank'];
		
			$data_berkas = array (
				'notaris_id' => $id_notaris,
				'id_berkas'	=> $id_berkas,
				'tgl_penyerahan' => $tgl_penyerahan_bank,
				'no_tanda_terima' => $no_tanda_terima,
				'created_at' => date('Y-m-d')
			);

			print_r($data_berkas);

			$db->insert('tb_notaris_berkas', $data_berkas);
			$res = $db->getResult();
		}
	}

	if (isset($_SESSION['urus_berkas_upd'])) {
		/**
		| PENGURUSAN BERKAS
		*/
		$data_urus_berkas = array();
		for ($i=0; $i < count($_SESSION['urus_berkas_upd']); $i++) { 
			$id_urus_berkas 	= $_SESSION['urus_berkas_upd'][$i]['id_urus_berkas'];
			$nomor_bpn 			= $_SESSION['urus_berkas_upd'][$i]['nomor_bpn'];
			$tgl_berkas 		= $_SESSION['urus_berkas_upd'][$i]['tgl_berkas'];
			$tgl_selesai 		= $_SESSION['urus_berkas_upd'][$i]['tgl_selesai'];
			$id_bagian_lapangan = $_SESSION['urus_berkas_upd'][$i]['id_bagian_lapangan'];

			$data_urus_berkas = array (
				'notaris_id' => $id_notaris,
				'id_berkas'	=> $id_urus_berkas,
				'tgl_berkas' => $tgl_berkas,
				'nomor_bpn' => $nomor_bpn,
				'tgl_selesai' => $tgl_selesai,
				'id_bag_lapangan' => $id_bagian_lapangan,
				'created_at' => date('Y-m-d')
			);

			print_r($data_urus_berkas);

			$db->insert('tb_notaris_pengurusanberkas', $data_urus_berkas);
			$res = $db->getResult();
		}
	}

	if (isset($_SESSION['sertifikat_upd'])) {
		/**
		| NOMOR SERTIFIKAT
		*/
		$data_sertifikat = array();
		for ($i=0; $i < count($_SESSION['sertifikat_upd']); $i++) {
			$nomor_sertifikat 	= $_SESSION['sertifikat_upd'][$i]['nomor'];
			$id_kabupaten 		= $_SESSION['sertifikat_upd'][$i]['id_kabupaten'];
			$id_kecamatan 		= $_SESSION['sertifikat_upd'][$i]['id_kecamatan'];

			$data_sertifikat = array (
				'notaris_id' => $id_notaris,
				'nomor'	=> $nomor_sertifikat,
				'id_kabupaten' => $id_kabupaten,
				'id_kecamatan' => $id_kecamatan,
				'created_at' => date('Y-m-d')
			);

			print_r($data_sertifikat);

			$db->insert('tb_notaris_sertifikat', $data_sertifikat);
			$res = $db->getResult();
		}
	}

	/**
	| UNSERT ALL NOTARIS SESSION
	*/
	unset($_SESSION['berkas_upd']);
	unset($_SESSION['sertifikat_upd']);
	unset($_SESSION['urus_berkas_upd']);

	echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=home\">";

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
