<?php include "header.php"; ?>

<script>
	function validate() {
		if (document.formName.kode.value == "" || document.formName.kode.value == null) {
			addErrorStyle('#kode');
			return false;
		} else if (document.formName.nama_kar.value == "" || document.formName.nama_kar.value == null) {
			addErrorStyle('#nama_kar');
			return false;
		} else if (document.formName.alamat.value == "" || document.formName.alamat.value == null) {
			addErrorStyle('#alamat');
			return false;
		} else if (document.formName.no_tlp.value == "" || document.formName.no_tlp.value == null) {
			addErrorStyle('#no_tlp');
			return false;
		} else {
			return true;
		}
	}
</script>

<!--<h2> Form Karyawan <small>Input Data Karyawan</small></h2>-->
<!-- <div class="alert alert-info alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Successfully saved!
</div> -->

<form name="formName" action="main.php?module=karyawan&process=insert" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="kode">Kode</label>
		<input type="text" name="kode" class="form-control" id="kode" />
	</div>
	
	<div class="form-group">
		<label for="nama_kar">Nama Karyawan</label>
		<input type="text" name="nama_kar" class="form-control" id="nama_kar" />
	</div>

	<div class="form-group">
		<label for="jkel">Jenis Kelamin</label>
		<select name="jkel" class="form-control">
			<option value="">Pilih</option>
			<option value="L">Laki-laki</option>
			<option value="P">Perempuan</option>
		</select>
	</div>
	
	<div class="form-group">
		<label for="tgl_lahir">Tgl. Lahir</label>
		<input type="text" name="tgl_lahir" class="form-control datepicker" id="tgl_lahir" />
	</div>

	<div class="form-group">
		<label for="alamat">Alamat</label>
		<textarea name="alamat" class="form-control" id="alamat"></textarea>
	</div>

	<div class="form-group">
		<label for="kota">Kota</label>
		<input type="text" name="kota" class="form-control" id="kota" />
	</div>

	<div class="form-group">
		<label for="country">Country</label>
		<input type="text" name="country" class="form-control" id="country" />
	</div>
	
	<div class="form-group">
		<label for="phone1">No. Hp.</label>
		<input type="text" name="phone1" class="form-control" />
	</div>

	<div class="form-group">
		<label for="phone2">No. Telp.</label>
		<input type="text" name="phone2" class="form-control" id="no_tlp" />
	</div>
	
	<div class="form-group">
		<label for="jabatan">Jabatan</label>
		<input type="text" name="jabatan" class="form-control"> 
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control"> 
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>