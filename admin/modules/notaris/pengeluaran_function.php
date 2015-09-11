<?php
	function tambah_pengeluaran($id_notaris, $jenis_pengeluaran, $biaya, $tgl_pengeluaran){
		if($jenis_pengeluaran == null) return;
	 
		if(@is_array($_SESSION['pengeluaran'])){
			if (pengeluaran_exists($jenis_pengeluaran)) return;
			$max = count($_SESSION['pengeluaran']);

			$_SESSION['pengeluaran'][$max]['id_notaris'] = $id_notaris;
			$_SESSION['pengeluaran'][$max]['jenis_pengeluaran'] = $jenis_pengeluaran;
			$_SESSION['pengeluaran'][$max]['biaya'] = $biaya;
			$_SESSION['pengeluaran'][$max]['tgl_pengeluaran'] = $tgl_pengeluaran;
		}
		else{
			$_SESSION['pengeluaran'] = array();
			
			$_SESSION['pengeluaran'][$max]['id_notaris'] = $id_notaris;
			$_SESSION['pengeluaran'][0]['jenis_pengeluaran'] = $jenis_pengeluaran;
			$_SESSION['pengeluaran'][0]['biaya'] = $biaya;
			$_SESSION['pengeluaran'][0]['tgl_pengeluaran'] = $tgl_pengeluaran;
		}
	}

	function pengeluaran_exists($jenis_pengeluaran){
		$max = count($_SESSION['pengeluaran']);
		$flag = 0;
		for($i = 0;$i < $max;$i++){
			if($jenis_pengeluaran == $_SESSION['pengeluaran'][$i]['jenis_pengeluaran']){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}
?>