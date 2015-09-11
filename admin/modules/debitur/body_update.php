<?php include "header.php"; ?>

<?php
	$uid = abs($_GET['uid']);

	$db->select('tb_profil','tb_profil.*, tb_profil.uid as profId, tb_debitur.*','tb_debitur ON tb_debitur.profil_id = tb_profil.uid', 'tb_debitur.uid='.$uid, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<script>
	function validate() {
		if (document.formName.kode.value == "" || document.formName.kode.value == null) {
			addErrorStyle('#kode');
			return false;
		} else if (document.formName.nama_debitur.value == "" || document.formName.nama_debitur.value == null) {
			addErrorStyle('#nama_debitur');
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

<form name="formName" action="main.php?module=debitur&process=update" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="kode">Kode</label>
		<input type="hidden" name="uid" value="<?php echo $data['uid'] ?>" />
		<input type="hidden" name="prof_uid" value="<?php echo $data['profId'] ?>" />		
		<input type="text" name="kode" class="form-control" id="kode" value="<?php echo $data['kode'] ?>" />
	</div>

	<div class="form-group">
		<label for="nama_debitur">Nama Debitur</label>
		<input type="text" name="nama_debitur" class="form-control" id="nama_debitur" value="<?php echo $data['fullname'] ?>" />
	</div>
	
	<div class="form-group">
		<label for="jkel">Jenis Kelamin</label>
		<select name="jkel" class="form-control">
			<option value="">Pilih</option>
			<option value="L" <?php echo ($data['gender'] == "L")? "selected" : "" ?>>Laki-laki</option>
			<option value="P" <?php echo ($data['gender'] == "P")? "selected" : "" ?>>Perempuan</option>
		</select>
	</div>

	<div class="form-group">
		<label for="tgl_lahir">Tgl. Lahir</label>
		<input type="text" name="tgl_lahir" class="form-control datepicker" id="tgl_lahir" value="<?php echo $data['birthdate'] ?>" />
	</div>

	<div class="form-group">
		<label for="alamat">Alamat</label>
		<textarea name="alamat" class="form-control" id="alamat"><?php echo $data['address'] ?></textarea>
	</div>

	<div class="form-group">
		<label for="kota">Kota</label>
		<input type="text" name="kota" class="form-control" id="kota" value="<?php echo $data['city'] ?>" />
	</div>

	<div class="form-group">
		<label for="country">Country</label>
		<input type="text" name="country" class="form-control" id="country" value="<?php echo $data['country'] ?>" />
	</div>
	
	<div class="form-group">
		<label for="phone1">No. Hp.</label>
		<input type="text" name="phone1" class="form-control" value="<?php echo $data['phone1'] ?>" />
	</div>

	<div class="form-group">
		<label for="phone2">No. Telp.</label>
		<input type="text" name="phone2" class="form-control" id="no_tlp" value="<?php echo $data['phone2'] ?>" />
	</div>
	
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" value="<?php echo $data['email'] ?>"> 
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>