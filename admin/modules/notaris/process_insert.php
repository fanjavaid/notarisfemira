<?php
	session_start();
	include('../class/mysql_crud.php');
	include('../class/currency.php');
	
	$db = new Database();
	$db->connect();
	// print_r($_POST);

	$debitur		= $_POST['debitur'];
	$pemberi_order	= $_POST['pemberi_order'];
	$pemberkasan 	= $_POST['pemberkasan'];
	$bag_input 		= $_POST['bag_input'];
	$tgl_input 		= $_POST['tgl_input'];
	$total_penerimaan 	=  getAmount($_POST['total_penerimaan']);
	$tgl_penyerahan = $_POST['tgl_penyerahan'];

	/**
	| DATA MASTER NOTARIS
	*/
	$data_master 	= array(
		'id_debitur'			=> $debitur, 
		'id_reff_order'			=> $pemberi_order, 
		'id_kar_pemberkasan'	=> $pemberkasan, 
		'id_kar_input'			=> $bag_input, 
		'id_kar_lapangan'		=> 0, // Not used and will be removed
		'status'				=> 0, 
		'tgl_masuk'				=> $tgl_input, 
		'total_penerimaan'		=> $total_penerimaan, 
		'tgl_penyerahan'		=> $tgl_penyerahan, 
	);

	$db->insert('tb_notaris', $data_master);
	$res = $db->getResult();
	$inserted_notaris_id = $res[0];

	if (isset($_POST['nomor'])) {
		/**
		| NOMOR SERTIFIKAT
		*/
		$nomor_sertifikat = $_POST['nomor'];
		$id_kabupaten = $_POST['id_kabupaten'];
		$id_kecamatan = $_POST['id_kecamatan'];
		$data_sertifikat = array();
		for ($i=0; $i < count($nomor_sertifikat); $i++) { 
			$data_sertifikat = array (
				'notaris_id' => $inserted_notaris_id,
				'nomor'	=> $nomor_sertifikat[$i],
				'id_kabupaten' => $id_kabupaten[$i],
				'id_kecamatan' => $id_kecamatan[$i],
				'created_at' => date('Y-m-d')
			);

			// print_r($data_sertifikat);

			$db->insert('tb_notaris_sertifikat', $data_sertifikat);
			$res = $db->getResult();
		}
	}

	if (isset($_POST['id_berkas'])) {
		/**
		| JENIS BERKAS
		*/
		$id_berkas = $_POST['id_berkas'];
		$no_tanda_terima = $_POST['no_tanda_terima'];
		$tgl_penyerahan_bank = $_POST['tgl_penyerahan_bank'];
		$data_berkas = array();
		for ($i=0; $i < count($id_berkas); $i++) { 
			$data_berkas = array (
				'notaris_id' => $inserted_notaris_id,
				'id_berkas'	=> $id_berkas[$i],
				'tgl_penyerahan' => $tgl_penyerahan_bank[$i],
				'no_tanda_terima' => $no_tanda_terima[$i],
				'created_at' => date('Y-m-d')
			);

			// print_r($data_sertifikat);

			$db->insert('tb_notaris_berkas', $data_berkas);
			$res = $db->getResult();
		}
	}

	if (isset($_POST['id_urus_berkas'])) {
		/**
		| PENGURUSAN BERKAS
		*/
		$id_urus_berkas 	= $_POST['id_urus_berkas'];
		$nomor_bpn 			= $_POST['nomor_bpn'];
		$tgl_berkas 		= $_POST['tgl_berkas'];
		$tgl_selesai 		= $_POST['tgl_selesai'];
		$id_bagian_lapangan = $_POST['id_bagian_lapangan'];

		$data_urus_berkas = array();
		for ($i=0; $i < count($id_berkas); $i++) { 
			$data_urus_berkas = array (
				'notaris_id' => $inserted_notaris_id,
				'id_berkas'	=> $id_urus_berkas[$i],
				'tgl_berkas' => $tgl_berkas[$i],
				'nomor_bpn' => $nomor_bpn[$i],
				'tgl_selesai' => $tgl_selesai[$i],
				'id_bag_lapangan' => $id_bagian_lapangan[$i],
				'created_at' => date('Y-m-d')
			);

			// print_r($data_sertifikat);

			$db->insert('tb_notaris_pengurusanberkas', $data_urus_berkas);
			$res = $db->getResult();
		}
	}

	/**
	| UNSERT ALL NOTARIS SESSION
	*/
	unset($_SESSION['berkas']);
	unset($_SESSION['sertifikat']);
	unset($_SESSION['urus_berkas']);
	// echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=home\">";
?>
