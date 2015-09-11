<?php
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();
	
	$uid = abs($_POST['uid']);

	$db->delete('tb_reforder','uid='.$uid);
	$res = $db->getResult();
	
	if ($res) {
		header("Location:main.php?module=order&menu=home");
	} else {
		echo "
			<script>
				alert('Error delete data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=order&menu=home\">
		";
	}
?>