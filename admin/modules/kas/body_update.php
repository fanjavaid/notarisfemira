<?php include "header.php"; ?>

<?php
	$uid = abs($_GET['uid']);

	$db->select('tb_kas','tb_kas.*',null,'tb_kas.uid='.$uid, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<script>
	function validate() {
		if (document.formName.nama_pengeluaran.value == "" || document.formName.nama_pengeluaran.value == null) {
			addErrorStyle('#nama_pengeluaran');
			return false;
		} else if (document.formName.total_pengeluaran.value == "" || document.formName.total_pengeluaran.value == null) {
			addErrorStyle('#total_pengeluaran');
			return false;
		} else if (document.formName.tgl_pengeluaran.value == "" || document.formName.tgl_pengeluaran.value == null) {
			addErrorStyle('#tgl_pengeluaran');
			return false;
		} else {
			return true;
		}
	}
</script>

<form name="formName" action="main.php?module=kas&process=update" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="jenis_kas">Pilih Kas</label>
		<select name="jenis_kas" class="form-control">
			<option value="kecil" <?php echo ($data['jenis_kas'] == 'kecil') ? "selected" : ""; ?>>Kecil</option>
			<option value="besar" <?php echo ($data['jenis_kas'] == 'besar') ? "selected" : ""; ?>>Besar</option>
		</select>
	</div>

	<div class="form-group">
		<label for="nama_pengeluaran">Pengeluaran untuk</label>
		<input type="hidden" name="uid" class="form-control" id="uid" value="<?php echo $data['uid'] ?>" />
		<input type="text" name="nama_pengeluaran" class="form-control" id="nama_pengeluaran" value="<?php echo $data['nama_pengeluaran'] ?>" />
	</div>
	
	<div class="form-group">
		<label for="total_pengeluaran">Total Pengeluaran</label>
		<input type="text" name="total_pengeluaran" class="form-control" id="total_pengeluaran" value="<?php echo $data['total_pengeluaran'] ?>" />
	</div>

	<div class="form-group">
		<label for="tgl_pengeluaran">Tanggal Pengeluaran</label>
		<input type="text" name="tgl_pengeluaran" class="form-control datepicker" id="tgl_pengeluaran" value="<?php echo $data['tgl_pengeluaran'] ?>" />
	</div>
	
	<div class="form-group">
		<label for="keterangan">Keterangan</label>
		<textarea name="keterangan" class="form-control" id="keterangan"><?php echo $data['keterangan'] ?></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>