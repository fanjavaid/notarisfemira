<?php
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$uid 		= abs($_POST['uid']);
	$prof_id	= abs($_POST['prof_uid']);

	$db->delete('tb_debitur','uid='.$uid);
	$res = $db->getResult();

	
	if ($res) {
		$db->delete('tb_profil','uid='.$prof_id);
		$res_profil = $db->getResult();

		if($res_profil) {
			//echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=karyawan&menu=home\">";
			header("Location:main.php?module=debitur&menu=home");
		}
	} else {
		echo "
			<script>
				alert('Error delete data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=debitur&menu=home\">
		";
	}
?>