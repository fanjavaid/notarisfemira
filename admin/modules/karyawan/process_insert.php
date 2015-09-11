<?php
	session_start();
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$kode			= $db->escapeString($_POST['kode']);
	$nama_karyawan	= $db->escapeString($_POST['nama_kar']);
	$gender			= $db->escapeString($_POST['jkel']);			
	$alamat			= $db->escapeString($_POST['alamat']);
	$tgl_lahir		= $db->escapeString($_POST['tgl_lahir']);
	$kota			= $db->escapeString($_POST['kota']);
	$country		= $db->escapeString($_POST['country']);
	$phone1			= $db->escapeString($_POST['phone1']);
	$phone2			= $db->escapeString($_POST['phone2']);
	$jabatan		= $db->escapeString($_POST['jabatan']);
	$email			= $db->escapeString($_POST['email']);

	$db->insert('tb_profil',array('fullname'=>$nama_karyawan, 'gender'=>$gender, 'birthdate'=>$tgl_lahir, 'address'=>$alamat, 'city'=>$kota, 'country'=>$country, 'phone1'=>$phone1, 'phone2'=>$phone2, 'email'=>$email));
	$res = $db->getResult();

	$db->insert('tb_karyawan',array('kode'=>$kode,'profil_id'=>$res[0],'jabatan'=>$jabatan));
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully saved.');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=karyawan&menu=insert\">
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=karyawan&menu=insert\">
		";
	}
	
?>