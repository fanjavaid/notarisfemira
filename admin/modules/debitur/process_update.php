<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$uid		= $_POST['uid'];
	$prof_uid	= $_POST['prof_uid'];

	$kode			= $db->escapeString($_POST['kode']);
	$nama_debitur	= $db->escapeString($_POST['nama_debitur']);		
	$gender			= $db->escapeString($_POST['jkel']);
	$alamat			= $db->escapeString($_POST['alamat']);
	$tgl_lahir		= $db->escapeString($_POST['tgl_lahir']);
	$kota			= $db->escapeString($_POST['kota']);
	$country		= $db->escapeString($_POST['country']);
	$phone1			= $db->escapeString($_POST['phone1']);
	$phone2			= $db->escapeString($_POST['phone2']);
	$email			= $db->escapeString($_POST['email']);

	$db->update('tb_profil',array('fullname'=>$nama_debitur, 'gender'=>$gender, 'birthdate'=>$tgl_lahir, 'address'=>$alamat, 'city'=>$kota, 'country'=>$country, 'phone1'=>$phone1, 'phone2'=>$phone2, 'email'=>$email), 'uid='.$prof_uid);
	$res = $db->getResult();

	$db->insert('tb_debitur',array('kode'=>$kode,'profil_id'=>$res[0]), 'uid='.$uid);
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully updated.');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=debitur&menu=home\">
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=debitur&menu=update&uid=$uid\">
		";
	}
	
?>