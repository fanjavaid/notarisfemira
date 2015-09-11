<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$kode			= $db->escapeString($_POST['kode']);
	$nama_berkas	= $db->escapeString($_POST['nama_berkas']);		
	$deskripsi		= $db->escapeString($_POST['deskripsi']);

	$db->insert('tb_berkas',array('kode'=>$kode,'nama_berkas'=>$nama_berkas,'deskripsi'=>$deskripsi));
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully saved.');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=berkas&menu=insert\">
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=berkas&menu=insert\">
		";
	}
	
?>