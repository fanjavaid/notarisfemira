<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$uid			= abs($_POST['uid']);
	
	$kode			= $db->escapeString($_POST['kode']);
	$nama_berkas	= $db->escapeString($_POST['nama_berkas']);		
	$deskripsi		= $db->escapeString($_POST['deskripsi']);

	$db->update('tb_berkas',array('kode'=>$kode,'nama_berkas'=>$nama_berkas,'deskripsi'=>$deskripsi), 'uid='.$uid);
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully updated.');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=berkas&menu=home\">
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=berkas&menu=update&uid=$uid\">
		";
	}
	
?>