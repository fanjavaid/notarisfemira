<?php include "header.php"; ?>
<?php print_r($_SESSION['sertifikat']) ?>
<style>
	#field-berkas {
		margin-bottom: 5px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function () {
		$("#kabupaten").change(function () {
			var kabupatenId = $(this).val();
			if (kabupatenId != "" && kabupatenId != null && kabupatenId != undefined) {
				getKecamatan(kabupatenId);
			}
		});
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
</script>

<script>
	var counter = 2;

	function hapus() {
		$('#remove_field_berkas').parent("div").parent("div").remove();

		counter--;
	}

	$(document).ready(function(){
		var berkasNumber = 5;

		load_success_berkas_session();
		load_success_sertifikat_session();
		load_success_pengurusan_berkas_session()

		// function load_success_session() {
		// 	// Run ajax to retrieve session data
		// 	$.ajax({
		// 		url : 'modules/notaris/process_getsession.php',
		// 		type : 'GET',
		// 		success : function(data) {
		// 			var dataBerkas = $.parseJSON(data);
		// 			for (var i = 0; i < dataBerkas.length; i++) {
		// 				$("#data_berkas").append("<div class='form-inline' style='margin-bottom:10px'><div class='form-group'><input type='hidden' name='id_berkas[]' value='"+ dataBerkas[i].uid +"' class='form-control' readonly='readonly' /><input type='text' value='"+ dataBerkas[i].nama_berkas +"' class='form-control' readonly='readonly' /></div>&nbsp;&nbsp;<div class='form-group'><input type='text' name='biaya[]' value='"+ dataBerkas[i].biaya +"' class='form-control' readonly='readonly'  /></div>&nbsp;&nbsp;<div class='form-group'><input type='text' name='lokasi[]' value='"+ dataBerkas[i].lokasi +"' class='form-control' readonly='readonly' /></div><div class='form-group'>&nbsp;&nbsp;<a href='#' id='hapus_berkas_session' data-uid='" + dataBerkas[i].uid + "' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a></div></div>");
		// 			};
		// 			//enable_delete_action();
		// 		},
		// 		error : function(data) {
		// 			alert(data);
		// 		}
		// 	});
		// }

		// $("#tambah_berkas_session").click(function() {
		// 	$.ajax({
		// 		url : 'modules/notaris/process_tambah_berkas.php',
		// 		type : 'POST',
		// 		data : $('#form_modal_session').serialize(),
		// 		success : function(data) {
		// 			if(data == 'true') {
		// 				$("#data_berkas").html('');
		// 				load_success_session();
		// 			}
		// 		},
		// 		error : function(data) {
		// 			alert(data);
		// 		}
		// 	});
		// });

		// //function enable_delete_action() {
		// 	$(document).on('click', '#hapus_berkas_session', function() {
		// 		var varUid = $(this).data('uid');
		// 		if(confirm('Anda yakin ingin menghapus berkas ini?')) {
		// 			delete_session_berkas(varUid);
		// 		}
		// 	});
		// //}

		// function delete_session_berkas(varUid) {
		// 	$.ajax({
		// 		url : 'modules/notaris/process_hapus_berkas.php',
		// 		type : 'GET',
		// 		data : {
		// 			session_id : varUid
		// 		},
		// 		success : function(data) {
		// 			if(data == 'true') {
		// 				$("#data_berkas").html('');
		// 				load_success_session();
		// 			}
		// 		},
		// 		error : function(data) {
		// 			alert(data);
		// 		}
		// 	});	
		// }

		/*
		| SERTIFIKAT MODULE
		| Start Here
		*/
		$("#tambah_field_sertifikat").click(function() {
			$('#tambahSertifikatModal').modal();
		});

		function load_success_sertifikat_session() {
			// Run ajax to retrieve session data
			$.ajax({
				url : 'modules/notaris/process_getsession_sertifikat.php',
				type : 'GET',
				success : function(data) {
					var dataSertifikat = $.parseJSON(data);
					console.log(dataSertifikat);
					for (var i = 0; i < dataSertifikat.length; i++) {
						$("#data_sertifikat").append("<div class='row'> <div class='col-sm-4'> <div class='form-group'> <input type='text' name='nomor[]' value='"+ dataSertifikat[i].nomor +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-4'> <div class='form-group'> <input type='text' name='nama_kabupaten[]' value='"+ dataSertifikat[i].nama_kabupaten +"' class='form-control input-sm' readonly='readonly'/><input type='hidden' name='id_kabupaten[]' value='"+ dataSertifikat[i].id_kabupaten +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-3'> <div class='form-group'> <input type='text' name='nama_kecamatan[]' value='"+ dataSertifikat[i].nama_kecamatan +"' class='form-control input-sm' readonly='readonly'/><input type='hidden' name='id_kecamatan[]' value='"+ dataSertifikat[i].id_kecamatan +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-1'> <div class='form-group'> <a href='#' id='hapus_sertifikat_session' data-nomor='" + dataSertifikat[i].nomor + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> </div></div></div>");
					};
					//enable_delete_action();
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		function delete_session_sertifikat(varUid) {
			$.ajax({
				url : 'modules/notaris/process_hapus_sertifikat.php',
				type : 'GET',
				data : {
					session_id : varUid
				},
				success : function(data) {
					if(data == 'true') {
						$("#data_sertifikat").html('');
						load_success_sertifikat_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});	
		}

		$(document).on('click', '#hapus_sertifikat_session', function() {
			var varUid = $(this).data('nomor');
			if(confirm('Anda yakin ingin menghapus data sertifikat ini?')) {
				delete_session_sertifikat(varUid);
			}
		});

		$("#tambah_sertifikat_session").click(function() {
			if ($("#nomor_sertifikat").val() == "") {
				alert("Masukkan nomor sertifikat!");
			} else {
				$.ajax({
				url : 'modules/notaris/process_tambah_sertifikat.php',
				type : 'POST',
				data : $('#form_modal_sertifikat_session').serialize(),
				success : function(data) {
					console.log(data);

					if(data == 'true') {
						/* Set Default State All HTML Element */
						$("#data_sertifikat").html('');
						$("#sertifikat_flash_message").fadeIn('fast', function() {
							setTimeout("$('#sertifikat_flash_message').fadeOut('fast');", 2000);
						});
						$("#nomor_sertifikat").val("");
						$('#kecamatan option').remove();
						$('#kecamatan').select2("data", { id: '', text: "Select Kecamatan" });
						$('#kabupaten').select2("data", { id: '', text: "Select Kabupaten" });

						load_success_sertifikat_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});
			}
		});
		/* END OF SERTIFIKAT MODULE */
		/* ------------------------ */

		/*
		| JENIS BERKAS MODULE
		| Start Here
		*/
		$("#tambah_field_jenis_berkas").click(function() {
			$('#tambahJenisBerkasModal').modal();
		});

		$("#tambah_jenis_berkas_session").click(function() {
			$.ajax({
				url : 'modules/notaris/process_tambah_berkas.php',
				type : 'POST',
				data : $('#form_modal_berkas_session').serialize(),
				success : function(data) {
					console.log(data);

					if(data == 'true') {
						/* Set Default State All HTML Element */
						$("#data_jenis_berkas").html('');
						$("#berkas_flash_message").fadeIn('slow', function() {
							setTimeout("$('#berkas_flash_message').fadeOut('slow');", 3000);
						});
						$('#id_jenis_berkas').select2("data", { id: '', text: "Pilih Berkas" });
						$('#tgl_penyerahan_bank').val("");
						$('#no_tanda_terima').val("");

						load_success_berkas_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});
		});

		$(document).on('click', '#hapus_berkas_session', function() {
			var varUid = $(this).data('uid');
			if(confirm('Anda yakin ingin menghapus data jenis berkas ini?')) {
				delete_session_berkas(varUid);
			}
		});

		function load_success_berkas_session() {
			// Run ajax to retrieve session data
			$.ajax({
				url : 'modules/notaris/process_getsession.php',
				type : 'GET',
				success : function(data) {
					var dataBerkas = $.parseJSON(data);
					console.log(dataBerkas);
					for (var i = 0; i < dataBerkas.length; i++) {
						$("#data_jenis_berkas").append("<div class='row'><div class='col-sm-4'> <div class='form-group'> <input type='hidden' name='id_berkas[]' value='"+ dataBerkas[i].uid +"' class='form-control input-sm' readonly='readonly'/><input type='text' name='nama_berkas[]' value='"+ dataBerkas[i].nama_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-4'> <div class='form-group'> <input type='text' name='no_tanda_terima[]' value='"+ dataBerkas[i].no_tanda_terima +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-3'> <div class='form-group'> <input type='text' name='tgl_penyerahan_bank[]' value='"+ dataBerkas[i].tgl_penyerahan_bank +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-1'> <div class='form-group'> <a href='#' id='hapus_berkas_session' data-uid='" + dataBerkas[i].uid + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> </div></div></div>");
					};
					//enable_delete_action();
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		function delete_session_berkas(varUid) {
			$.ajax({
				url : 'modules/notaris/process_hapus_berkas.php',
				type : 'GET',
				data : {
					sess_id : varUid
				},
				success : function(data) {
					if(data == 'true') {
						$("#data_jenis_berkas").html('');
						load_success_berkas_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});	
		}
		/* END BERKAS MODULE */
		/* ----------------- */


		/*
		| PENGURUSAN BERKAS MODULE
		| Start Here
		*/
		$("#tambah_field_pengurusan_berkas").click(function() {
			$('#tambahPengurusanBerkasModal').modal();
		});

		function load_success_pengurusan_berkas_session() {
			// Run ajax to retrieve session data
			$.ajax({
				url : 'modules/notaris/process_getsession_pengurusanberkas.php',
				type : 'GET',
				success : function(data) {
					var dataPengurusanBerkas = $.parseJSON(data);
					console.log(dataPengurusanBerkas);
					for (var i = 0; i < dataPengurusanBerkas.length; i++) {
						$("#data_pengurusan_berkas").append("<div class='row'><div class='col-sm-3'> <div class='form-group'> <input type='hidden' name='id_urus_berkas[]' value='"+ dataPengurusanBerkas[i].id_urus_berkas +"' class='form-control input-sm' readonly='readonly'/> <input type='text' name='nama_urus_berkas[]' value='"+ dataPengurusanBerkas[i].nama_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='nomor_bpn[]' value='"+ dataPengurusanBerkas[i].nomor_bpn +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='tgl_berkas[]' value='"+ dataPengurusanBerkas[i].tgl_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='tgl_selesai[]' value='"+ dataPengurusanBerkas[i].tgl_selesai +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'><input type='hidden' name='id_bagian_lapangan[]' value='"+ dataPengurusanBerkas[i].id_bagian_lapangan +"' class='form-control input-sm' readonly='readonly'/> <input type='text' name='bagian_lapangan[]' value='"+ dataPengurusanBerkas[i].fullname +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-1'> <div class='form-group'> <a href='#' id='hapus_pengurusan_berkas_session' data-uid='" + dataPengurusanBerkas[i].uid + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> </div></div></div>");
					};
					//enable_delete_action();
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		function delete_session_perngurusan_berkas(varUid) {
			$.ajax({
				url : 'modules/notaris/process_hapus_pengurusan_berkas.php',
				type : 'GET',
				data : {
					sess_id : varUid
				},
				success : function(data) {
					if(data == 'true') {
						$("#data_pengurusan_berkas").html('');
						load_success_pengurusan_berkas_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});	
		}

		$(document).on('click', '#hapus_pengurusan_berkas_session', function() {
			var varUid = $(this).data('uid');
			if(confirm('Anda yakin ingin menghapus data pengurusan berkas ini?')) {
				delete_session_perngurusan_berkas(varUid);
			}
		});

		$("#tambah_pengurusan_berkas_session").click(function() {
			if ($("#nomor_bpn").val() == "") {
				alert("Masukkan nomor BPN!");
			} else {
				$.ajax({
				url : 'modules/notaris/process_tambah_pengurusan_berkas.php',
				type : 'POST',
				data : $('#form_modal_pengurusan_berkas_session').serialize(),
				success : function(data) {
					console.log(data);

					if(data == 'true') {
						/* Set Default State All HTML Element */
						$("#data_pengurusan_berkas").html('');
						$("#pengurusan_berkas_flash_message").fadeIn('slow', function() {
							setTimeout("$('#pengurusan_berkas_flash_message').fadeOut('slow');", 3000);
						});
						$('#id_urus_berkas').select2("data", { id: '', text: "Pilih Berkas" });
						$("#nomor_bpn").val("");
						$('#tgl_berkas').val("");
						$('#tgl_selesai').val("");
						$('#id_bagian_lapangan').select2("data", { id: '', text: "Bagian Lapangan" });

						load_success_pengurusan_berkas_session();
					}
				},
				error : function(data) {
					alert(data);
				}
			});
			}
		});
		/* End Here */

	});
</script>

<form aname="formName" action="main.php?module=notaris&process=insert" method="post" role="form" onsubmit="return validate();">
	<div class="form-group">
		<label for="">Nama Debitur</label>
		<?php
			$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_debitur.uid as debUid, tb_debitur.kode','tb_debitur ON tb_debitur.profil_id = tb_profil.uid', null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$res = $db->getResult();
		?>
		<select name="debitur" class="form-control" required>
			<option value="kosong">Pilih</option>
			<?php
				foreach ($res as $data) {
					echo "<option value='$data[debUid]'>$data[fullname]</option>";
				}
			?>
		</select>
	</div>
	
	<div class="form-group">
		<label for="">Pemberi Order</label>
		<select name="pemberi_order" class="form-control" required>
			<option value="kosong">Pilih</option>
				<?php
					$db->select('tb_reforder','tb_reforder.*',null, null, null);
					$res = $db->getResult();

					foreach ($res as $data) {
						echo "<option value='$data[uid]'>$data[reff_name]</option>";
					}
				?>
		</select>
	</div>
	
	<!-- Nomor Sertifikat-->
	<div class="form-group">
		<label for="sertifikat">Nomor Sertifikat</label><br/>
		<a class="btn btn-success btn-xs" id="tambah_field_sertifikat">Tambah</a>
		<p></p>
		<div id="data_sertifikat">
		</div>
	</div>

	<div class="form-group">
		<label for="">Tanggal Akad</label>
		<input type="text" name="tgl_akad" class="form-control datepicker" />	
	</div>

	<!-- Jenis Berkas -->
	<div class="form-group">
		<label for="jenis_berkas">Jenis Berkas</label><br/>
		<a class="btn btn-success btn-xs" id="tambah_field_jenis_berkas">Tambah</a>
		<p></p>
		<div id="data_jenis_berkas">
		</div>
	</div>
		
	<!-- Pengurusan Berkas -->
	<div class="form-group">
			<label for="jenis_berkas">Pengurusan Berkas</label><br/>
			<a class="btn btn-success btn-xs" id="tambah_field_pengurusan_berkas">Tambah</a>
			<p></p>
			<div id="data_pengurusan_berkas">
			</div>
	</div>

	<?php
		$db->select('tb_profil','tb_profil.uid as profId, tb_profil.fullname, tb_profil.gender, tb_karyawan.uid as karUid, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', null, null);
		$res = $db->getResult();
	?>

	<div class="form-group">
		<label for="">Pemberkasan</label>
		<select name="pemberkasan" class="form-control" required>
			<option value="">Pilih</option>
			<?php
				foreach ($res as $data) {
					echo "<option value='$data[karUid]'>$data[fullname]</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="">Input Data</label>
		<select name="bag_input" class="form-control" required>
			<option value="">Pilih</option>
			<?php
				foreach ($res as $data) {
					echo "<option value='$data[karUid]'>$data[fullname]</option>";
				}
			?>
		</select>
	</div>
	
	<div class="form-group">
		<label for="">Total Penerimaan</label>
		<input type="text" name="total_penerimaan" class="form-control currency" required />	
	</div>

	<div class="form-group">
		<label for="">Tanggal Masuk</label>
		<div class="input-group date">
			<input type="text" name="tgl_input" class="form-control datepicker" required />
			<div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
		</div>
	</div>
	
	<!-- <div class="form-group"> -->
		<!-- <label>Tanggal Penyerahan</label> -->
		<!-- <div class="input-group date"> -->
			<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="tgl_penyerahan" class="form-control datepicker"/>
			<!-- <div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div> -->
		<!-- </div> -->
	<!-- </div> -->
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Simpan</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</form>

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
								$db->select('tb_kabupaten','*', null, 'id_prov = 31 OR id_prov = 36', null, null);
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
								<input type="text" name="tgl_selesai" id="tgl_selesai" class="form-control datepicker" placeholder="Tanggal Selesai" disabled="disabled" />
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