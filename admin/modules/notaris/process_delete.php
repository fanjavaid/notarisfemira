<?php
	include('../class/mysql_crud.php');
	
	$db = new Database();
	$db->connect();

	$uid = $_POST['uid'];

	// Delete Detail
	$db->delete('tb_notaris_detail','id_notaris='.$uid);
	$detail_notaris = $db->getResult();

	if($detail_notaris) {
		// Delete master
		$db->delete('tb_notaris','uid='.$uid);
		$notaris = $db->getResult();

		if($notaris) {
			echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=home\">";
			//header("Location:main.php?module=notaris&menu=home");
		}

	} else {
		echo "
			<script>
				alert('Error delete data!');
			</script>
			<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=notaris&menu=home\">
		";
	}
?>