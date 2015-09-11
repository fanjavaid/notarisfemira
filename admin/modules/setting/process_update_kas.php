<?php
	session_start();
	include('../class/mysql_crud.php');
	include('../class/currency.php');
	
	$db = new Database();
	$db->connect();
	
	$uid			= abs($_POST['uid']);
	$saldo_awal		= $db->escapeString(getAmount($_POST['saldo_awal']));

	$db->update('tb_setting_kas',array('saldo_awal'=>$saldo_awal), 'uid='.$uid);
	$res = $db->getResult();
	
	if ($res) {
		echo "
			<script>
				alert('Successfully updated.');
			</script>
		";
	} else {
		echo "
			<script>
				alert('Error saving data!');
			</script>
		";
	}

	echo "<META http-equiv=\"refresh\" content=\"0;URL=main.php?module=setting&menu=kas\">";
	
?>