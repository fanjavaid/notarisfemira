<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$kode			= $db->escapeString($_POST['kode_order']);
	$nama_reff		= $db->escapeString($_POST['para_pihak']);
	$nama_perwakilan	= $db->escapeString($_POST['nama_perwakilan']);		

	$db->insert('tb_reforder',array('kode'=>$kode,'reff_name'=>$nama_reff, 'nama_perwakilan'=>$nama_perwakilan));
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully saved.');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=order&menu=home\">
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=order&menu=insert\">
		";
	}
	
?>