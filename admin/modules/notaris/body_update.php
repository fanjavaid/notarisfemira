<?php include "header.php"; ?>
<?php //print_r($_SESSION['sertifikat_upd'])
	//session_destroy();
?>
<script type="text/javascript" src="../js/notarisfemira-notaris-update.js"></script>

<style>
	#field-berkas {
		margin-bottom: 5px;
	}
</style>

<script>
	var counter = 2;

	function hapus() {
		$('#remove_field_berkas').parent("div").parent("div").remove();
		counter--;
	}

	$(document).ready(function(){
		var berkasNumber = 5;

		$("#tambah_field_berkas").click(function() {
			$('#tambahBerkasModal').modal();
		});
	});
</script>

<script>

	$(document).ready(function(){
		$("#kabupaten").change(function () {
			var kabupatenId = $(this).val();
			if (kabupatenId != "" && kabupatenId != null && kabupatenId != undefined) {
				getKecamatan(kabupatenId);
			}
		});
		function getKecamatan(varUid) {
			$.ajax({
				url : 'modules/notaris/process_get_kecamatan.php',
				type : 'GET',
				data : {
					id_kab : varUid
				},
				success : function(data) {
					// console.log(data);
					$('#kecamatan option').remove();
					$('#kecamatan').select2("data", { id: '', text: "Select Kecamatan" });

					var jsonObj = JSON.parse(data);
					$.each(jsonObj, function(i, value) {
			            $('#kecamatan').append($('<option>').text(value.text).attr('value', value.id));
			        });
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		$("#tambah_field_pengeluaran").click(function() {
			$('#tambahPengeluaranModal').modal();
		});

		load_pengeluaran_session();
		function load_pengeluaran_session() {
			// Run ajax to retrieve session data
			$.ajax({
				url : 'modules/notaris/process_get_pengeluaran.php',
				type : 'GET',
				data : {
					id_notaris : $('#idNotaris').val()
				},
				success : function(data) {
					var dataPengeluaran = $.parseJSON(data);
					for (var i = 0; i < dataPengeluaran.length; i++) {
						$("#data_pengeluaran").append("<div class='form-inline' style='margin-bottom:10px'><div class='form-group'><input type='text' name='jenis_pengeluaran[]' value='"+ dataPengeluaran[i].jenis_pengeluaran +"' class='form-control' readonly='readonly' /></div>&nbsp;&nbsp;<div class='form-group'><input type='text' name='biaya[]' value='"+ dataPengeluaran[i].biaya +"' class='form-control' readonly='readonly'  /></div>&nbsp;&nbsp;<div class='form-group'><input type='text' name='tgl_pengeluaran[]' value='"+ dataPengeluaran[i].tgl_pengeluaran +"' class='form-control' readonly='readonly' /></div><div class='form-group'>&nbsp;&nbsp;<a href='#' id='hapus_pengeluaran_session' data-uid='" + dataPengeluaran[i].uid + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a></div></div>");
					};
					console.log(data);
					//enable_delete_action();
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		$("#tambah_pengeluaran").click(function() {
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

		$("#delete_pengeluaran").click(function() {
			// $.ajax({
			// 	url : 'modules/notaris/process_tambah_pengeluaran.php',
			// 	type : 'POST',
			// 	data : $('#form_modalpengeluaran_session').serialize(),
			// 	success : function(data) {
			// 		if(data == 'true') {
			// 			$("#data_pengeluaran").html('');
			// 			load_pengeluaran_session();
			// 		}
			// 	},
			// 	error : function(data) {
			// 		alert(data);
			// 	}
			// });
			var varUid = $(this).data('uid');
			alert(varUid);
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
				type : 'POST',
				data : {
					uid : varUid
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

<?php
	$uid = $_GET['idNotaris'];

	$query = "
		select a.*, a.uid as notarisId, b.kode, b.nama_berkas, c.biaya, c.lokasi, d.reff_name
		from tb_notaris a
		left join tb_notaris_detail c on a.uid = c.id_notaris
		left join tb_berkas b on c.id_berkas = b.uid
		left join tb_reforder d on a.id_reff_order = d.uid
		where a.uid = $uid";

	$sql = mysql_query($query);
	$dataNotaris = mysql_fetch_assoc($sql);
?>

<form aname="formName" action="main.php?module=notaris&process=update" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<input type="hidden" name="idNotaris" id="idNotaris" value="<?php echo $dataNotaris['notarisId']; ?>">
		<label for="">Nama Debitur</label>
		<?php
			$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_debitur.uid as debUid, tb_debitur.kode','tb_debitur ON tb_debitur.profil_id = tb_profil.uid', null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$res = $db->getResult();
		?>
		<select name="debitur" class="form-control">
			<option value="kosong">Pilih</option>
			<?php
				foreach ($res as $data) {
					$selected = ($dataNotaris['id_debitur'] == $data['debUid'])? "selected" : "";
					echo "<option value='$data[debUid]' $selected>$data[fullname]</option>";
				}
			?>
		</select>
	</div>
	
	<div class="form-group">
		<label for="">Pemberi Order</label>
		<select name="pemberi_order" class="form-control">
			<option value="kosong">Pilih</option>
				<?php
					$db->select('tb_reforder','tb_reforder.*',null, null, null);
					$res = $db->getResult();

					foreach ($res as $data) {
						$selected = ($dataNotaris['id_reff_order'] == $data['uid'])? "selected" : "";
						echo "<option value='$data[uid]' $selected>$data[reff_name]</option>";
					}
				?>
		</select>
	</div>
		
	<!-- <div class="form-group">
			<label for="jenis_berkas">Jenis Berkas</label><br/>
			<a class="btn btn-success btn-sm" id="tambah_field_berkas">Tambah</a>
			<p></p>
			<?php
				$queryBerkas = "select a.uid as detailId ,a.biaya, a.lokasi, b.uid as idBerkas, b.nama_berkas
								from tb_notaris_detail a
								left join tb_berkas b on a.id_berkas = b.uid
								left join tb_notaris c on a.id_notaris = c.uid
								where c.uid = '$uid'";
				$sqlBerkas = mysql_query($queryBerkas);
				$numRowBerkas = mysql_num_rows($sqlBerkas);

				if($numRowBerkas > 0) {
					include "berkas_function.php";
					while($dataBerkas = mysql_fetch_assoc($sqlBerkas)) {
						//tambah_berkas_update($dataBerkas['idBerkas'], $dataBerkas['biaya'] , $dataBerkas['lokasi']);
			?>
			<div id="field-berkas">
				<div class="form-inline">
					<div class="form-group">
						<input type="hidden" name="jenis[]" value="<?php echo $dataBerkas['idBerkas']; ?>" class="form-control" readonly="readonly" />
						<input type="text" value="<?php echo $dataBerkas['nama_berkas']; ?>" class="form-control" readonly="readonly" />
					</div>&nbsp;
					<div class="form-group">
						<input type="text" name="biaya[]" value="<?php echo $dataBerkas['biaya']; ?>" class="form-control" readonly="readonly"  />
					</div>&nbsp;
					<div class="form-group">
						<input type="text" name="lokasi[]" value="<?php echo $dataBerkas['lokasi']; ?>" class="form-control" readonly="readonly" />
					</div>&nbsp;
					<div class="form-group">
						<a href="main.php?module=notaris&process=hapus_berkas&idNotaris=<?php echo $dataNotaris['notarisId']; ?>&db_id=<?php echo $dataBerkas['detailId']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
					</div>
				</div>
			</div>
			<?php 
					}
				}

				if(isset($_SESSION['berkas_upd'])) {
					print_r($_SESSION['berkas_upd']);
				}
			?>		
	</div> -->

	<?php
		$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_karyawan.uid as karUid, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', null, null);
		$res = $db->getResult();
	?>

	<!-- Nomor Sertifikat-->
	<div class="form-group">
		<label for="sertifikat">Nomor Sertifikat</label><br/>
		<a class="btn btn-success btn-xs" id="tambah_field_sertifikat">Tambah</a>
		<p></p>
		<div id="data_sertifikat_db"></div>
		<div id="data_sertifikat"></div>
	</div>

	<div class="form-group">
		<label for="">Tanggal Akad</label>
		<input type="text" name="tgl_akad" class="form-control datepicker" value="<?php echo $dataNotaris['tgl_akad'] ?>" />	
	</div>

	<!-- Jenis Berkas -->
	<div class="form-group">
		<label for="jenis_berkas">Jenis Berkas</label><br/>
		<a class="btn btn-success btn-xs" id="tambah_field_jenis_berkas">Tambah</a>
		<p></p>
		<div id="data_jenis_berkas_db"></div>
		<div id="data_jenis_berkas"></div>
	</div>
		
	<!-- Pengurusan Berkas -->
	<div class="form-group">
		<label for="jenis_berkas">Pengurusan Berkas</label><br/>
		<a class="btn btn-success btn-xs" id="tambah_field_pengurusan_berkas">Tambah</a>
		<p></p>
		<div id="data_pengurusan_berkas_db"></div>
		<div id="data_pengurusan_berkas"></div>
	</div>

	<div class="form-group">
		<label for="jenis_pengeluaran">Detail Pengeluaran</label><br/>
		<a class="btn btn-warning btn-sm" id="tambah_field_pengeluaran">Tambah</a>
		<p></p>
		<div id="data_pengeluaran"></div>
	</div>

	<!-- <div class="form-group">
		<label for="">Pemberkasan</label>
		<select name="pemberkasan" class="form-control" required>
			<option value="">Pilih</option>
			<?php
				foreach ($res as $data) {
					$selected = ($dataNotaris['id_kar_pemberkasan'] == $data['karUid'])? "selected" : "";
					echo "<option value='$data[karUid]' $selected>$data[fullname]</option>";
				}
			?>
		</select>
	</div> -->

	<div class="form-group">
		<label for="">Input Data</label>
		<select name="bag_input" class="form-control">
			<option value="">Pilih</option>
			<?php
				foreach ($res as $data) {
					$selected = ($dataNotaris['id_kar_input'] == $data['karUid'])? "selected" : "";
					echo "<option value='$data[karUid]' $selected>$data[fullname]</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="">Total Penerimaan</label>
		<input type="text" name="total_penerimaan" value="<?php echo $dataNotaris['total_penerimaan'] ?>" class="form-control currency"/>	
	</div>

	<div class="form-group">
		<label for="">Tanggal Masuk</label>
		<input type="text" name="tgl_input" class="form-control datepicker" value="<?php echo $dataNotaris['tgl_masuk']; ?>" />
	</div>
	
	<!-- <div class="form-group">
		<label>Tanggal Penyerahan</label> -->
		<input type="hidden" name="tgl_penyerahan" class="form-control datepicker" value="<?php echo $dataNotaris['tgl_penyerahan']; ?>" />
	<!-- </div> -->

	<?php $visible = ($dataNotaris['status'] == 1)? "block" : "none"; ?>
	<div class="form-group" style="display:none">
	<!--<div class="form-group" style="display:<?php echo $visible; ?>">-->
		<label>Tanggal Selesai</label>
		<input type="text" name="tgl_selesai" class="form-control" value="<?php echo $dataNotaris['tgl_selesai']; ?>" readonly="readonly" />
	</div>

	<div class="form-group">
		<label>Status</label>
		<div id="field-berkas">
			<div class="form-inline">
				<div class="form-group">
					<input type="radio" name="status" value="0" <?php echo ($dataNotaris['status'] == "0")? "checked" : "" ?> />&nbsp;&nbsp;On Process
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="form-group">
					<input type="radio" name="status" value="1" <?php echo ($dataNotaris['status'] == "1")? "checked" : "" ?> />&nbsp;&nbsp;Finish
				</div>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

<!-- Modal Dialog Delete -->
<div class="modal fade" id="tambahBerkasModal">
  <div class="modal-dialog">
  	<form method="post" action="main.php?module=notaris&process=update_berkas">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Berkas</h4>
      </div>
		<div class="modal-body">
			<div id="field-berkas">
			<div class="form-inline">
				<div class="form-group">
					<input type="hidden" name="berkas_upd" value="true" class="form-control">
					<input type="hidden" name="idNotaris" value="<?php echo $_GET['idNotaris']; ?>" class="form-control">
				</div>
				<div class="form-group">
					<select name="jenis_berkas" class="form-control">
						<option value="" class="form-control">Pilih Berkas</option>
						<?php
							$db->select('tb_berkas','tb_berkas.*',null, null, null);
							$res = $db->getResult();

							foreach ($res as $data) {
								echo "<option value='$data[uid]' class='form-control'>$data[nama_berkas]</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<input type="text" name="biaya" class="form-control" placeholder="Biaya(Tanpa separator)" />
				</div>
				<div class="form-group">
					<input type="text" name="lokasi" class="form-control" placeholder="Lokasi" />
				</div>
			</div>
		</div>
	</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Dialog Tambah Pengeluaran berkas -->
<div class="modal fade" id="tambahPengeluaranModal">
  <div class="modal-dialog modal-lg">
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
					<input type="text" name="biaya" class="form-control currency" placeholder="Biaya">
				</div>
				<div class="col-md-4">
					<div class="input-group date">
						<input type="text" name="tgl_pengeluaran" class="form-control datepicker" placeholder="Tanggal Pengeluaran" />
						<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="tambah_pengeluaran" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Dialog Tambah Sertifikat -->
<div class="modal fade" id="tambahSertifikatModal">
  <div class="modal-dialog modal-lg">
  	<form method="post" id="form_modal_sertifikat_session">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Sertifikat</h4>
      </div>
		<div class="modal-body">
			<div id="sertifikat_flash_message" class="alert alert-warning" style="display: none;">
				<p><i class="fa fa-check"></i> Sertifikat baru berhasil ditambahkan.</p>
			</div>
			<div id="field-sertifikat">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<input type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="form-control" placeholder="Nomor" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<select name="id_kabupaten" id="kabupaten" class="form-control">
							<?php
								$db->select('tb_kabupaten','*', null, null, null, null);
								$res = $db->getResult();
								foreach ($res as $data) {
									echo "<option value='$data[id_kab]'>$data[nama_kab]</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<select name="id_kecamatan" id="kecamatan" class="form-control">
							<option value="" selected="selected">Select Kecamatan</option>
						</select>
					</div>
				</div>
			</div>
			</div>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="tambah_sertifikat_session" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Dialog JENIS BERKAS -->
<div class="modal fade" id="tambahJenisBerkasModal">
  <div class="modal-dialog modal-lg">
  	<form method="post" id="form_modal_berkas_session">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Jenis Berkas</h4>
      </div>
		<div class="modal-body">
			<div id="field-jenis-berkas">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
					<select name="id_jenis_berkas" id="id_jenis_berkas" class="form-control">
								<option value="">Pilih Berkas</option>
								<?php
									$db->select('tb_berkas','tb_berkas.*', null, null);
									$res = $db->getResult();
									foreach ($res as $data) {
										echo "<option value='$data[uid]'>$data[nama_berkas]</option>";
									}
								?>
							</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group date">
							<input type="text" name="tgl_penyerahan_bank" id="tgl_penyerahan_bank" class="form-control datepicker" placeholder="Tanggal Penyerahan ke Bank" />
							<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<input type="text" name="no_tanda_terima" id="no_tanda_terima" class="form-control" placeholder="No. Tanda Terima" />
					</div>
				</div>
			</div>
			</div>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="tambah_jenis_berkas_session" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Dialog Tambah Pengurusan berkas -->
<div class="modal fade" id="tambahPengurusanBerkasModal">
  <div class="modal-dialog modal-lg">
  	<form method="post" id="form_modal_pengurusan_berkas_session">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Data Pengurusan Berkas</h4>
      </div>
		<div class="modal-body">
			<div id="pengurusan_berkas_flash_message" class="alert alert-warning" style="display: none;">
				<p><i class="fa fa-check"></i> Berkas baru berhasil ditambahkan.</p>
			</div>
			<div id="field-pengurusan-berkas">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<select name="id_urus_berkas" id="id_urus_berkas" class="form-control">
								<option value="">Pilih Berkas</option>
								<?php
									$db->select('tb_berkas','tb_berkas.*', null, null);
									$res = $db->getResult();
									foreach ($res as $data) {
										echo "<option value='$data[uid]'>$data[nama_berkas]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<input type="text" name="nomor_bpn" id="nomor_bpn" class="form-control" placeholder="Nomor BPN" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<div class="input-group date">
								<input type="text" name="tgl_berkas" id="tgl_berkas" class="form-control datepicker" placeholder="Tanggal Berkas" />
								<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="input-group date">
								<input type="text" name="tgl_selesai" id="tgl_selesai" value="0000-00-00" class="form-control datepicker" placeholder="Tanggal Selesai" disabled="disabled" />
								<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<select name="id_bagian_lapangan" id="id_bagian_lapangan" class="form-control">
								<option value="">Bagian Lapangan</option>
								<?php
									$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_karyawan.uid as karUid, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', null, null);
									$res = $db->getResult();
									foreach ($res as $data) {
										echo "<option value='$data[karUid]'>$data[fullname]</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="tambah_pengurusan_berkas_session" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Dialog Update Pengurusan berkas -->
<div class="modal fade" id="editPengurusanBerkasModal">
  <div class="modal-dialog modal-lg">
  	<form method="post" id="form_modal_editpengurusan_berkas_session">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Data Pengurusan Berkas</h4>
      </div>
		<div class="modal-body">
			<div id="pengurusan_berkasupd_flash_message" class="alert alert-warning" style="display: none;">
				<p><i class="fa fa-check"></i> Berkas baru berhasil diperbarui.</p>
			</div>
			<div id="field-editpengurusan-berkas">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							
							<input type="hidden" name="id_pengurusan_berkas" id="id_pengurusan_berkas">
							<input type="hidden" name="notaris_id_upd" id="notaris_id_upd">

							<select name="id_urus_berkas_upd" id="id_urus_berkas_upd" class="form-control">
								<option value="">Pilih Berkas</option>
								<?php
									$db->select('tb_berkas','tb_berkas.*', null, null);
									$res = $db->getResult();
									foreach ($res as $data) {
										echo "<option value='$data[uid]'>$data[nama_berkas]</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<input type="text" name="nomor_bpn_upd" id="nomor_bpn_upd" class="form-control" placeholder="Nomor BPN" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<div class="input-group date">
								<input type="text" name="tgl_berkas_upd" id="tgl_berkas_upd" class="form-control datepicker" placeholder="Tanggal Berkas" />
								<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="input-group date">
								<input type="text" name="tgl_selesai_upd" id="tgl_selesai_upd" class="form-control datepicker" placeholder="Tanggal Selesai" />
								<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<select name="id_bagian_lapangan_upd" id="id_bagian_lapangan_upd" class="form-control">
								<option value="">Bagian Lapangan</option>
								<?php
									$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_karyawan.uid as karUid, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', null, null);
									$res = $db->getResult();
									foreach ($res as $data) {
										echo "<option value='$data[karUid]'>$data[fullname]</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="update_pengurusan_berkas_session" class="btn btn-primary">Perbarui</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Dialog Hapus berkas -->
<div class="modal fade" id="hapusBerkasModal">
  <div class="modal-dialog">
  	<form method="post" id="form_modal_delete_session">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Hapus Berkas</h4>
      </div>
		<div class="modal-body">
			<div id="field-berkas">
			<div class="form-inline">
				<div class="form-group">
					<input type="text" id="uid_modal_delete" name="uid" class="form-control" />
				</div>
			</div>
		</div>
	</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" id="tambah_berkas_session" class="btn btn-primary">Tambah</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include "footer.php" ?>