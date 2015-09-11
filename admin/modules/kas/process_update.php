<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$uid			= abs($_POST['uid']);
	
	$jenis_kas		= $db->escapeString($_POST['jenis_kas']);
	$nama			= $db->escapeString($_POST['nama_pengeluaran']);
	$total			= $db->escapeString($_POST['total_pengeluaran']);
	$tgl			= $db->escapeString($_POST['tgl_pengeluaran']);
	$ket			= $db->escapeString($_POST['keterangan']);

	$db->update('tb_kas',array('jenis_kas'=>$jenis_kas,'nama_pengeluaran'=>$nama,'total_pengeluaran'=>$total, 'tgl_pengeluaran'=>$tgl, 'keterangan'=>$ket), 'uid='.$uid);
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully updated.');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=kas&menu=home\">
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=kas&menu=update&uid=$uid\">
		";
	}
	
?>