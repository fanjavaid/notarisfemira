<?php
	function tambah_sertifikat($nomor, $id_kabupaten, $id_kecamatan){
		if($nomor < 1) return;
	 
		if(@is_array($_SESSION['sertifikat'])){
			if (sertifikat_exists($nomor)) return;
			$max = count($_SESSION['sertifikat']);

			$_SESSION['sertifikat'][$max]['nomor'] = $nomor;
			$_SESSION['sertifikat'][$max]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat'][$max]['id_kecamatan'] = $id_kecamatan;
		}
		else{
			$_SESSION['sertifikat'] = array();
			
			$_SESSION['sertifikat'][0]['nomor'] = $nomor;
			$_SESSION['sertifikat'][0]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat'][0]['id_kecamatan'] = $id_kecamatan;
		}
	}

	function sertifikat_exists($nomor){
		$nomor = intval($nomor);
		$max = count($_SESSION['sertifikat']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($nomor == $_SESSION['sertifikat'][$i]['nomor']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}


	function tambah_sertifikat_update($nomor, $id_kabupaten, $id_kecamatan){
		if($nomor < 1) return;
	 
		if(@is_array($_SESSION['sertifikat'])){
			if (sertifikat_exists_update($nomor)) return;
			$max = count($_SESSION['sertifikat']);

			$_SESSION['sertifikat'][$max]['nomor'] = $nomor;
			$_SESSION['sertifikat'][$max]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat'][$max]['id_kecamatan'] = $id_kecamatan;
		}
		else{
			$_SESSION['sertifikat'] = array();
			
			$_SESSION['sertifikat'][0]['nomor'] = $nomor;
			$_SESSION['sertifikat'][0]['id_kabupaten'] = $id_kabupaten;
			$_SESSION['sertifikat'][0]['id_kecamatan'] = $id_kecamatan;
		}
	}

	function sertifikat_exists_update($nomor){
		$nomor = intval($nomor);
		$max = count($_SESSION['sertifikat']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($nomor == $_SESSION['sertifikat'][$i]['nomor']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}
?>