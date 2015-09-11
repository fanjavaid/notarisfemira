<?php  include "header.php"; ?>

<?php
	$uid = 1;

	$db->select('tb_setting_kas','tb_setting_kas.*',null,'tb_setting_kas.uid='.$uid, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<script>
	function validate() {
		if (document.formName.saldo_awal.value == "" || document.formName.saldo_awal.value == null) {
			addErrorStyle('#saldo_awal');
			return false;
		} else {
			return true;
		}
	}
</script>

<form name="formName" action="main.php?module=setting&process=update_kas" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="saldo_awal">Saldo Awal</label>
		<input type="hidden" name="uid" value="<?php echo $data['uid'] ?>" />
		<input type="text" name="saldo_awal" class="form-control currency" id="saldo_awal" value="<?php echo $data['saldo_awal']; ?>" />
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>