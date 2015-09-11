<?php include "header.php"; ?>

<?php
	$uid = abs($_GET['uid']);

	$db->select('tb_berkas','tb_berkas.*',null,'tb_berkas.uid='.$uid, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<script>
	function validate() {
		if (document.formName.kode.value == "" || document.formName.kode.value == null) {
			addErrorStyle('#kode');
			return false;
		} else if (document.formName.nama_berkas.value == "" || document.formName.nama_berkas.value == null) {
			addErrorStyle('#nama_berkas');
			return false;
		} else {
			return true;
		}
	}
</script>

<form name="formName" action="main.php?module=berkas&process=update" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="kode">Kode</label>
		<input type="hidden" name="uid" value="<?php echo $data['uid']; ?>" />
		<input type="text" name="kode" class="form-control" id="kode" value="<?php echo $data['kode']; ?>" />
	</div>
	
	<div class="form-group">
		<label for="nama_berkas">Nama Berkas</label>
		<input type="text" name="nama_berkas" class="form-control" id="nama_berkas" value="<?php echo $data['nama_berkas']; ?>" />
	</div>
	
	<div class="form-group">
		<label for="deskripsi">Deskripsi</label>
		<textarea name="deskripsi" class="form-control" id="deskripsi"><?php echo $data['deskripsi']; ?></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>