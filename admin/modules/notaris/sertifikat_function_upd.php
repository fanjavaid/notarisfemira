<?php
	function tambah_sertifikat($nomor, $id_kabupaten, $id_kecamatan){
		if($nomor < 1) return;
	 
		if(@is_array($_SESSION['sertifikat_upd'])){
			if (sertifikat_exists($nomor)) return;
			$max = count($_SESSION['sertifikat_upd']);

			$_SESSION['sertifikat_upd'][$max]['nomor'] = $nomor;
			$_SESSION['sertifikat_upd'][$max]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat_upd'][$max]['id_kecamatan'] = $id_kecamatan;
		}
		else{
			$_SESSION['sertifikat_upd'] = array();
			
			$_SESSION['sertifikat_upd'][0]['nomor'] = $nomor;
			$_SESSION['sertifikat_upd'][0]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat_upd'][0]['id_kecamatan'] = $id_kecamatan;
		}
	}

	function sertifikat_exists($nomor){
		$nomor = intval($nomor);
		$max = count($_SESSION['sertifikat_upd']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($nomor == $_SESSION['sertifikat_upd'][$i]['nomor']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}


	function tambah_sertifikat_update($nomor, $id_kabupaten, $id_kecamatan){
		if($nomor < 1) return;
	 
		if(@is_array($_SESSION['sertifikat_upd'])){
			if (sertifikat_exists_update($nomor)) return;
			$max = count($_SESSION['sertifikat_upd']);

			$_SESSION['sertifikat_upd'][$max]['nomor'] = $nomor;
			$_SESSION['sertifikat_upd'][$max]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat_upd'][$max]['id_kecamatan'] = $id_kecamatan;
		}
		else{
			$_SESSION['sertifikat_upd'] = array();
			
			$_SESSION['sertifikat_upd'][0]['nomor'] = $nomor;
			$_SESSION['sertifikat_upd'][0]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat_upd'][0]['id_kecamatan'] = $id_kecamatan;
		}
	}

	function sertifikat_exists_update($nomor){
		$nomor = intval($nomor);
		$max = count($_SESSION['sertifikat_upd']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($nomor == $_SESSION['sertifikat_upd'][$i]['nomor']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}
?>