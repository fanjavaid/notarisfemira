<?php  include "header.php"; ?>

<?php
	$username = $_SESSION['username'];

	$db->select('tb_profil','tb_profil.*, tb_profil.uid as profId, tb_user.*','tb_user ON tb_user.profil_id = tb_profil.uid', 'tb_user.username="'.$username.'"', null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<script>
	function validate() {
		if (document.formName.kode.value == "" || document.formName.kode.value == null) {
			addErrorStyle('#kode');
			return false;
		} else if (document.formName.nama.value == "" || document.formName.nama.value == null) {
			addErrorStyle('#nama');
			return false;
		} else if (document.formName.alamat.value == "" || document.formName.alamat.value == null) {
			addErrorStyle('#alamat');
			return false;
		} else if (document.formName.email.value == "" || document.formName.email.value == null) {
			addErrorStyle('#email');
			return false;
		} else {
			return true;
		}
	}
</script>

<form name="formName" action="main.php?module=setting&process=update" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="nama">Nama Lengkap</label>
		<input type="hidden" name="uid" value="<?php echo $data['id'] ?>" />
		<input type="hidden" name="prof_uid" value="<?php echo $data['profId'] ?>" />
		<input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data['fullname']; ?>" />
	</div>
	
	<div class="form-group">
		<label for="tgl_lahir">Tgl. Lahir</label>
		<input type="text" name="tgl_lahir" class="form-control datepicker" id="tgl_lahir" value="<?php echo $data['birthdate']; ?>" />
	</div>

	<div class="form-group">
		<label for="alamat">Alamat</label>
		<textarea name="alamat" class="form-control" id="alamat"><?php echo $data['address']; ?></textarea>
	</div>

	<div class="form-group">
		<label for="kota">Kota</label>
		<input type="text" name="kota" class="form-control" id="kota" value="<?php echo  $data['city']; ?>" />
	</div>

	<div class="form-group">
		<label for="country">Country</label>
		<input type="text" name="country" class="form-control" id="country" value="<?php echo  $data['country']; ?>" />
	</div>
	
	<div class="form-group">
		<label for="phone1">No. Hp.</label>
		<input type="text" name="phone1" class="form-control" value="<?php echo $data['phone1']; ?>" />
	</div>

	<div class="form-group">
		<label for="phone2">No. Telp.</label>
		<input type="text" name="phone2" class="form-control" id="no_tlp" value="<?php echo $data['phone2']; ?>" />
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>"> 
	</div>
	
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" disabled="disabled"> 
	</div>
	
	<div class="form-group">
		<label for="password">New Password</label>
		<input type="password" name="password" class="form-control"> 
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<?php include "footer.php" ?>