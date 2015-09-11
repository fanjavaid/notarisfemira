<?php include "header.php"; ?>

<?php
	$uid = abs($_GET['uid']);

	$db->select('tb_reforder','tb_reforder.*',null,'tb_reforder.uid='.$uid, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<script>
	function validate() {
		if (document.formName.kode_order.value == "" || document.formName.kode_order.value == null) {
			addErrorStyle('#kode_order');
			return false;
		} else if (document.formName.para_pihak.value == "" || document.formName.para_pihak.value == null) {
			addErrorStyle('#para_pihak');
			return false;
		} else {
			return true;
		}
	}
</script>

<form name="formName" action="main.php?module=order&process=update" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="kode_order">Kode Order</label>
		<input type="hidden" name="uid"  value="<?php echo $data['uid'] ?>" />
		<input type="text" name="kode_order" class="form-control" id="kode_order" value="<?php echo $data['kode'] ?>" />
	</div>
		
	<div class="form-group">
		<label for="para_pihak">Para Pihak</label>
		<input type="text" name="para_pihak" class="form-control" id="para_pihak" value="<?php echo $data['reff_name'] ?>" />
	</div>

	<div class="form-group">
		<label for="nama_perwakilan">Nama Perwakilan</label>
		<input type="text" name="nama_perwakilan" class="form-control" id="nama_perwakilan" value="<?php echo $data['nama_perwakilan'] ?>" />
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>