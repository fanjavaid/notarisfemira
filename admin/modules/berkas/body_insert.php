<?php include "header.php"; ?>

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

<form name="formName" action="main.php?module=berkas&process=insert" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="kode">Kode</label>
		<input type="text" name="kode" class="form-control" id="kode" />
	</div>
	
	<div class="form-group">
		<label for="nama_berkas">Nama Berkas</label>
		<input type="text" name="nama_berkas" class="form-control" id="nama_berkas" />
	</div>
	
	<div class="form-group">
		<label for="deskripsi">Deskripsi</label>
		<textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>