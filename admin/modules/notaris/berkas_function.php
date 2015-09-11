<?php
	function tambah_berkas($berkas_id, $tgl_penyerahan, $no_tanda_terima){
		if($berkas_id < 1) return;
	 
		if(@is_array($_SESSION['berkas'])){
			if (berkas_exists($berkas_id)) return;
			$max = count($_SESSION['berkas']);

			$_SESSION['berkas'][$max]['id_jenis_berkas'] = $berkas_id;
			$_SESSION['berkas'][$max]['tgl_penyerahan_bank'] = $tgl_penyerahan;
			$_SESSION['berkas'][$max]['no_tanda_terima'] = $no_tanda_terima;
		}
		else{
			$_SESSION['berkas'] = array();
			
			$_SESSION['berkas'][0]['id_jenis_berkas'] = $berkas_id;
			$_SESSION['berkas'][0]['tgl_penyerahan_bank'] = $tgl_penyerahan;
			$_SESSION['berkas'][0]['no_tanda_terima'] = $no_tanda_terima;
		}
	}

	function berkas_exists($berkas_id){
		$berkas_id = intval($berkas_id);
		$max = count($_SESSION['berkas']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($berkas_id == $_SESSION['berkas'][$i]['id_jenis_berkas']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}


	function tambah_berkas_update($berkas_id, $biaya, $lokasi){
		if($berkas_id < 1) return;
	 
		if(@is_array($_SESSION['berkas_upd'])){
			if (berkas_exists_update($berkas_id)) return;
			$max = count($_SESSION['berkas_upd']);

			$_SESSION['berkas'][$max]['id_jenis_berkas'] = $berkas_id;
			$_SESSION['berkas'][$max]['tgl_penyerahan_bank'] = $tgl_penyerahan;
			$_SESSION['berkas'][$max]['no_tanda_terima'] = $no_tanda_terima;
		}
		else{
			$_SESSION['berkas_upd'] = array();
			
			$_SESSION['berkas'][0]['id_jenis_berkas'] = $berkas_id;
			$_SESSION['berkas'][0]['tgl_penyerahan_bank'] = $tgl_penyerahan;
			$_SESSION['berkas'][0]['no_tanda_terima'] = $no_tanda_terima;
		}
	}

	function berkas_exists_update($berkas_id){
		$berkas_id = intval($berkas_id);
		$max = count($_SESSION['berkas_upd']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($berkas_id == $_SESSION['berkas_upd'][$i]['id_jenis_berkas']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}
?>