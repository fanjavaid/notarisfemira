<?php include "header.php"; ?>

<style>
	#field-berkas {
		margin-bottom: 5px;
	}
</style>

<script>

	$(document).ready(function(){
		$("#tambah_field_pengeluaran").click(function() {
			$('#tambahPengeluaranModal').modal();
		});

		load_pengeluaran_session();

		function load_pengeluaran_session() {
			// Run ajax to retrieve session data
			$.ajax({
				url : 'modules/notaris/process_getsession_pengeluaran.php',
				type : 'GET',
				success : function(data) {
					var dataPengeluaran = $.parseJSON(data);
					for (var i = 0; i < dataPengeluaran.length; i++) {
						$("#data_pengeluaran").append("<div class='form-inline' style='margin-bottom:10px'><div class='form-group'><input type='text' name='jenis_pengeluaran[]' value='"+ dataPengeluaran[i].jenis_pengeluaran +"' class='form-control' readonly='readonly' /></div>&nbsp;&nbsp;<div class='form-group'><input type='text' name='biaya[]' value='"+ dataPengeluaran[i].biaya +"' class='form-control' readonly='readonly'  /></div>&nbsp;&nbsp;<div class='form-group'><input type='text' name='tgl_pengeluaran[]' value='"+ dataPengeluaran[i].tgl_pengeluaran +"' class='form-control' readonly='readonly' /></div><div class='form-group'>&nbsp;&nbsp;<a href='#' id='hapus_pengeluaran_session' data-uid='" + dataPengeluaran[i].jenis_pengeluaran + "' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a></div></div>");
					};
					console.log(data);
					//enable_delete_action();
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		$("#tambah_pengeluaran_session").click(function() {
			$.ajax({
				url : 'modules/notaris/process_tambah_pengeluaran.php',
				type : 'POST',
				data : $('#form_modalpengeluaran_session').serialize(),
				success : function(data) {
					if(data == 'true') {
						$("#data_pengeluaran").html('');
						load_pengeluaran_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});
		});

		//function enable_delete_action() {
			$(document).on('click', '#hapus_pengeluaran_session', function() {
				var varUid = $(this).data('uid');
				if(confirm('Anda yakin ingin menghapus data ini?')) {
					delete_session_pengeluaran(varUid);
				}
			});
		//}

		function delete_session_pengeluaran(varUid) {
			$.ajax({
				url : 'modules/notaris/process_hapus_pengeluaran.php',
				type : 'GET',
				data : {
					jenis_pengeluaran : varUid
				},
				success : function(data) {
					if(data == 'true') {
						$("#data_pengeluaran").html('');
						load_pengeluaran_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});	
		}

	});
</script>

<form name="formName" action="main.php?module=notaris&process=pengeluaran_insert" method="post" role="form" onsubmit="return validate();">
	<input type="text" name="id_notaris" id="id_notaris" value="<?php echo $_GET['idNotaris']; ?>">
	<div class="form-group">
			<label for="jenis_berkas">Jenis Pengeluaran</label><br/>
			<a class="btn btn-success btn-sm" id="tambah_field_pengeluaran">Tambah</a>
			<p></p>
			<?php
				$queryPengeluaran = "SELECT * FROM tb_pengeluaran WHERE id_notaris = '$_GET[idNotaris]'";
				$sqlPengeluaran   = mysql_query($queryPengeluaran);
				$dataPengeluaran  = mysql_fetch_assoc($sqlPengeluaran);

				$totalPengeluaran = mysql_num_rows($sqlPengeluaran);

				if ($dataPengeluaran == 0) {
					if (!isset($_SESSION['pengeluaran'])) {
						echo "<div class=\"alert alert-warning\" role=\"alert\">Data pengeluaran kosong.</div>";
					} else {
						echo "<div id=\"data_pengeluaran\"></div>";
					}
				} else {
					while($data = mysql_fetch_assoc($sqlPengeluaran)) {
			?>

			<div id="data_pengeluaran">
				<div class="form-inline" style="margin-bottom:10px">
					<div class="form-group">
						<input type="text" name="jenis_pengeluaran[]" value="<?php echo $data['jenis_pengeluaran'] ?>" class="form-control" readonly="readonly" />
					</div>&nbsp;&nbsp;
					<div class="form-group">
						<input type="text" name="biaya[]" value="<?php echo $data['biaya'] ?>" class="form-control" readonly="readonly"  />
					</div>&nbsp;&nbsp;
					<div class="form-group">
						<input type="text" name="tgl_pengeluaran[]" value="<?php echo $data['tgl_pengeluaran'] ?>" class="form-control" readonly="readonly" />
					</div>
					<div class="form-group">&nbsp;&nbsp;
						<a href="#" id="hapus_pengeluaran_session" data-uid="" class="btn btn-danger btn-sm">
						<span class="glyphicon glyphicon-trash"></span>
						</a>
					</div>
				</div>
			</div>

			<?php } } ?>
	</div>

	<?php
		$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_karyawan.uid as karUid, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', null, null);
		$res = $db->getResult();
	?>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Simpan</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<!-- Modal Dialog Tambah berkas -->
<div class="modal fade" id="tambahPengeluaranModal">
  <div class="modal-dialog">
  	<form method="post" id="form_modalpengeluaran_session">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Jenis Pengeluaran</h4>
      </div>
		<div class="modal-body">
			<div id="field-berkas">
			<div class="row">
				<div class="col-md-4">
					<input type="hidden" name="id_notaris" id="id_notaris" value="<?php echo $_GET['idNotaris']; ?>">
					<input type="text" name="jenis_pengeluaran" class="form-control" placeholder="Jenis Pengeluaran">
				</div>
				<div class="col-md-4">
					<input type="text" name="biaya" class="form-control" placeholder="Biaya (tanpa separator)">
				</div>
				<div class="col-md-4">
					<input type="text" name="tgl_pengeluaran" class="form-control datepicker" placeholder="Tanggal Pengeluaran" />
				</div>
			</div>
		</div>
	</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="tambah_pengeluaran_session" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php include "footer.php" ?>