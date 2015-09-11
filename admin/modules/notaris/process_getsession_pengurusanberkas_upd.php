<?php
	session_start();

	include('../../../class/mysql_crud.php');
	$db = new Database();
	$db->connect();

	$json = array();
	if(isset($_SESSION['urus_berkas_upd'])) {
		for($i = 0; $i < count($_SESSION['urus_berkas_upd']); $i++) {
			$id_bagian = abs($_SESSION['urus_berkas_upd'][$i]['id_bagian_lapangan']);
			$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_karyawan.uid as karUid, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', 'tb_karyawan.uid = ' . $id_bagian, null);
			$res = $db->getResult();

			$id_berkas = abs($_SESSION['urus_berkas_upd'][$i]['id_urus_berkas']);
			$db->select('tb_berkas', 'tb_berkas.nama_berkas', null, 'tb_berkas.uid = ' . $id_berkas, null, null);
			$res_berkas = $db->getResult();

			$res[0]['uid'] = $_SESSION['urus_berkas_upd'][$i]['sess_id'];
			$res[0]['id_urus_berkas'] = $_SESSION['urus_berkas_upd'][$i]['id_urus_berkas'];
			$res[0]['nama_berkas'] = $res_berkas[0]['nama_berkas'];
			$res[0]['nomor_bpn'] = $_SESSION['urus_berkas_upd'][$i]['nomor_bpn'];
			$res[0]['tgl_berkas'] = $_SESSION['urus_berkas_upd'][$i]['tgl_berkas'];
			$res[0]['tgl_selesai'] = $_SESSION['urus_berkas_upd'][$i]['tgl_selesai'];
			$res[0]['id_bagian_lapangan'] = $_SESSION['urus_berkas_upd'][$i]['id_bagian_lapangan'];
			$res[0]['nama_bagian_lapangan'] = $res[0]['fullname'];

			array_push($json, $res[0]);
		}
	}

	echo json_encode($json);
?>