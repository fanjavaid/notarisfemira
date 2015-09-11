<?php
	function tambah_pengurusan_berkas($id_urus_berkas, $unique_sess_id, $nomor_bpn, $tgl_berkas, $tgl_selesai, $id_bagian_lapangan){
		if($unique_sess_id < 1) return;
	 
		if(@is_array($_SESSION['urus_berkas_upd'])){
			if (pengurusan_berkas_exists($unique_sess_id)) return;
			$max = count($_SESSION['urus_berkas_upd']);

			$_SESSION['urus_berkas_upd'][$max]['sess_id'] = $unique_sess_id;
			$_SESSION['urus_berkas_upd'][$max]['id_urus_berkas'] = $id_urus_berkas;
			$_SESSION['urus_berkas_upd'][$max]['nomor_bpn'] = $nomor_bpn;
			$_SESSION['urus_berkas_upd'][$max]['tgl_berkas'] = $tgl_berkas;
			$_SESSION['urus_berkas_upd'][$max]['tgl_selesai'] = $tgl_selesai;
			$_SESSION['urus_berkas_upd'][$max]['id_bagian_lapangan'] = $id_bagian_lapangan;
		} else{
			$_SESSION['urus_berkas_upd'] = array();
			
			$_SESSION['urus_berkas_upd'][0]['sess_id'] = $unique_sess_id;
			$_SESSION['urus_berkas_upd'][0]['id_urus_berkas'] = $id_urus_berkas;
			$_SESSION['urus_berkas_upd'][0]['nomor_bpn'] = $nomor_bpn;
			$_SESSION['urus_berkas_upd'][0]['tgl_berkas'] = $tgl_berkas;
			$_SESSION['urus_berkas_upd'][0]['tgl_selesai'] = $tgl_selesai;
			$_SESSION['urus_berkas_upd'][0]['id_bagian_lapangan'] = $id_bagian_lapangan;
		}
	}

	function pengurusan_berkas_exists($unique_sess_id){
		$max = count($_SESSION['urus_berkas_upd']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($unique_sess_id == $_SESSION['urus_berkas_upd'][$i]['sess_id']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}


	// function tambah_pengurusan_berkas_update($unique_sess_id, $nomor_bpn, $tgl_berkas, $tgl_selesai, $id_bagian_lapangan){
	// 	if($unique_sess_id < 1) return;
	 
	// 	if(@is_array($_SESSION['urus_berkas_upd'])){
	// 		if (pengurusan_berkas_exists_update($unique_sess_id)) return;
	// 		$max = count($_SESSION['urus_berkas_upd']);

	// 		$_SESSION['urus_berkas_upd'][$max]['sess_id'] = $unique_sess_id;
	// 		$_SESSION['urus_berkas_upd'][$max]['nomor_bpn'] = $nomor_bpn;
	// 		$_SESSION['urus_berkas_upd'][$max]['tgl_berkas'] = $tgl_berkas;
	// 		$_SESSION['urus_berkas_upd'][$max]['tgl_selesai'] = $tgl_selesai;
	// 		$_SESSION['urus_berkas_upd'][$max]['id_bagian_lapangan'] = $id_bagian_lapangan;
	// 	}
	// 	else{
	// 		$_SESSION['urus_berkas_upd'] = array();
			
	// 		$_SESSION['urus_berkas_upd'][0]['sess_id'] = $unique_sess_id;
	// 		$_SESSION['urus_berkas_upd'][0]['nomor_bpn'] = $nomor_bpn;
	// 		$_SESSION['urus_berkas_upd'][0]['tgl_berkas'] = $tgl_berkas;
	// 		$_SESSION['urus_berkas_upd'][0]['tgl_selesai'] = $tgl_selesai;
	// 		$_SESSION['urus_berkas_upd'][0]['id_bagian_lapangan'] = $id_bagian_lapangan;
	// 	}
	// }

	// function pengurusan_berkas_exists_update($unique_sess_id){
	// 	$id = intval($unique_sess_id);
	// 	$max = count($_SESSION['urus_berkas_upd']);
	// 	$flag = 0;
	// 	for($i = 0;$i < $max;$i++){
	// 		if($id == $_SESSION['urus_berkas_upd'][$i]['sess_id']){
	// 			$flag = 1;
	// 			break;
	// 		}
	// 	}
	// 	return $flag;
	// }
?>