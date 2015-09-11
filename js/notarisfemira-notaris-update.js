$(document).ready(function (){
	/*
	| SERTIFIKAT MODULE
	| Start Here
	*/
	$("#tambah_field_sertifikat").click(function() {
		$('#tambahSertifikatModal').modal();
	});

	function delete_session_sertifikat(varUid) {
		$.ajax({
			url : 'modules/notaris/process_hapus_sertifikat_upd.php',
			type : 'GET',
			data : {
				session_id : varUid
			},
			success : function(data) {
				console.log(data);
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

	function delete_session_sertifikat_db(varUid) {
		$.ajax({
			url : 'modules/notaris/process_hapus_sertifikat_upd.php',
			type : 'GET',
			data : {
				db_id : varUid
			},
			success : function(data) {
				console.log(data);
				if(data == 'true') {
					$("#data_sertifikat_db").html('');
					load_data_sertifikat_notaris();
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

	$(document).on('click', '#hapus_sertifikat_db', function() {
		var varUid = $(this).data('sertifikat-id');
		if(confirm('Anda yakin ingin menghapus data sertifikat ini?')) {
			delete_session_sertifikat_db(varUid);
		}
	});

	$("#tambah_sertifikat_session").click(function() {
		if ($("#nomor_sertifikat").val() == "") {
			alert("Masukkan nomor sertifikat!");
		} else {
			$.ajax({
			url : 'modules/notaris/process_tambah_sertifikat_upd.php',
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

	load_success_sertifikat_session();
	function load_success_sertifikat_session() {
		// Run ajax to retrieve session data
		$.ajax({
			url : 'modules/notaris/process_getsession_sertifikat_upd.php',
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
			url : 'modules/notaris/process_tambah_berkas_upd.php',
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

	$(document).on('click', '#hapus_berkas_db', function() {
		var varUid = $(this).data('jenisberkas-id');
		if(confirm('Anda yakin ingin menghapus data jenis berkas ini?')) {
			delete_session_berkas_db(varUid);
		}
	});

	load_success_berkas_session();
	function load_success_berkas_session() {
		// Run ajax to retrieve session data
		$.ajax({
			url : 'modules/notaris/process_getsession_upd.php',
			type : 'GET',
			success : function(data) {
				var dataBerkas = $.parseJSON(data);
				console.log("Berkas Upd");
				console.log(dataBerkas);
				console.log("----------");
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

	function delete_session_berkas_db(varUid) {
		$.ajax({
			url : 'modules/notaris/process_hapus_berkas_upd.php',
			type : 'GET',
			data : {
				db_id : varUid
			},
			success : function(data) {
				console.log(data);
				if(data == 'true') {
					$("#data_jenis_berkas_db").html('');
					load_data_berkas_notaris();
				}
			},
			error : function(data) {
				alert(data);
			}
		});	
	}

	function delete_session_berkas(varUid) {
		$.ajax({
			url : 'modules/notaris/process_hapus_berkas_upd.php',
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

	$(document).on('click', '#edit_field_pengurusan_berkas', function() {
		var dataPass = $(this).data('urusberkas');

		// $("#id_urus_berkas_upd").val(dataPass.id_berkas);
		$('#id_urus_berkas_upd').select2("data", { id: dataPass.id_berkas, text: dataPass.nama_berkas });

		$("#notaris_id_upd").val(dataPass.notaris_id);
		$("#id_pengurusan_berkas").val(dataPass.id);
		$("#nomor_bpn_upd").val(dataPass.nomor_bpn);
		$("#tgl_berkas_upd").val(dataPass.tgl_berkas);
		$("#tgl_selesai_upd").val(dataPass.tgl_selesai);
		// $("#id_bagian_lapangan_upd").val(dataPass.id_bag_lapangan);
		$('#id_bagian_lapangan_upd').select2("data", { id: dataPass.id_bag_lapangan, text: dataPass.fullname });

		console.log("Data didapat");
		console.log(dataPass);

		$('#editPengurusanBerkasModal').modal();
	});

	load_success_pengurusan_berkas_session();
	function load_success_pengurusan_berkas_session() {
		// Run ajax to retrieve session data
		$.ajax({
			url : 'modules/notaris/process_getsession_pengurusanberkas_upd.php',
			type : 'GET',
			success : function(data) {
				var dataPengurusanBerkas = $.parseJSON(data);
				console.log(dataPengurusanBerkas);
				for (var i = 0; i < dataPengurusanBerkas.length; i++) {
					$("#data_pengurusan_berkas").append("<div class='row'><div class='col-sm-2'> <div class='form-group'> <input type='hidden' name='id_urus_berkas[]' value='"+ dataPengurusanBerkas[i].id_urus_berkas +"' class='form-control input-sm' readonly='readonly'/> <input type='text' title='"+ dataPengurusanBerkas[i].nama_berkas +"' name='nama_urus_berkas[]'  value='"+ dataPengurusanBerkas[i].nama_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='nomor_bpn[]' value='"+ dataPengurusanBerkas[i].nomor_bpn +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='tgl_berkas[]' value='"+ dataPengurusanBerkas[i].tgl_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='tgl_selesai[]' value='"+ dataPengurusanBerkas[i].tgl_selesai +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'><input type='hidden' name='id_bagian_lapangan[]' value='"+ dataPengurusanBerkas[i].id_bagian_lapangan +"' class='form-control input-sm' readonly='readonly'/> <input type='text' name='bagian_lapangan[]' value='"+ dataPengurusanBerkas[i].fullname +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <a href='#' id='hapus_pengurusan_berkas_session' data-uid='" + dataPengurusanBerkas[i].uid + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> </div></div></div>");
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

	function delete_session_perngurusan_berkas_db(varUid) {
		$.ajax({
			url : 'modules/notaris/process_hapus_pengurusan_berkas_upd.php',
			type : 'GET',
			data : {
				db_id : varUid
			},
			success : function(data) {
				if(data == 'true') {
					$("#data_pengurusan_berkas_db").html('');
					load_data_pengurusan_berkas_notaris();
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

	$(document).on('click', '#hapus_pengurusan_berkas_db', function() {
		var varUid = $(this).data('urusberkas-id');
		if(confirm('Anda yakin ingin menghapus data pengurusan berkas ini?\nData pengurusan berkas ini sebelumnya sudah tersimpan di Database.\nJika dihapus data di database juga ikut dihapus.')) {
			delete_session_perngurusan_berkas_db(varUid);
		}
	});

	$("#tambah_pengurusan_berkas_session").click(function() {
		if ($("#nomor_bpn").val() == "") {
			alert("Masukkan nomor BPN!");
		} else {
			$.ajax({
			url : 'modules/notaris/process_tambah_pengurusan_berkas_upd.php',
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

	$("#update_pengurusan_berkas_session").click(function() {
		if ($("#nomor_bpn_upd").val() == "") {
			alert("Masukkan nomor BPN!");
		} else {
			$.ajax({
			url : 'modules/notaris/process_edit_pengurusan_berkas_upd.php',
			type : 'POST',
			data : $('#form_modal_editpengurusan_berkas_session').serialize(),
			success : function(data) {
				console.log(data);

				if(data == 'true') {
					/* Set Default State All HTML Element */
					$("#data_pengurusan_berkas_db").html('');
					$("#pengurusan_berkasupd_flash_message").fadeIn('slow', function() {
						setTimeout("$('#pengurusan_berkasupd_flash_message').fadeOut('slow');", 3000);
					});
					$('#id_urus_berkas').select2("data", { id: '', text: "Pilih Berkas" });
					$("#nomor_bpn").val("");
					$('#tgl_berkas').val("");
					$('#tgl_selesai').val("");
					$('#id_bagian_lapangan').select2("data", { id: '', text: "Bagian Lapangan" });

					load_data_pengurusan_berkas_notaris();
				}
			},
			error : function(data) {
				alert(data);
			}
		});
		}
	});
	/* End Here */







	/* NEW FUNCTION */
		load_data_berkas_notaris();
		function load_data_berkas_notaris() {
			$.ajax({
				url : 'modules/notaris/process_get_data_berkas.php',
				type : 'GET',
				data : {
					idNotaris : $("#idNotaris").val()
				},
				success : function(data) {
					var dataBerkas = $.parseJSON(data);
					console.log(dataBerkas);
					for (var i = 0; i < dataBerkas.length; i++) {
						$("#data_jenis_berkas_db").append("<div class='row'><div class='col-sm-4'> <div class='form-group'> <input type='hidden' name='id_berkas[]' value='"+ dataBerkas[i].uid +"' class='form-control input-sm' readonly='readonly'/><input type='text' name='nama_berkas[]' value='"+ dataBerkas[i].nama_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-4'> <div class='form-group'> <input type='text' name='no_tanda_terima[]' value='"+ dataBerkas[i].no_tanda_terima +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-3'> <div class='form-group'> <input type='text' name='tgl_penyerahan_bank[]' value='"+ dataBerkas[i].tgl_penyerahan +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-1'> <div class='form-group'> <a href='#' id='hapus_berkas_db' data-jenisberkas-id='" + dataBerkas[i].id + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> </div></div></div>");
					};
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		load_data_sertifikat_notaris();
		function load_data_sertifikat_notaris() {
			$.ajax({
				url : 'modules/notaris/process_get_data_sertifikat.php',
				type : 'GET',
				data : {
					idNotaris : $("#idNotaris").val()
				},
				success : function(data) {
					var dataSertifikat = $.parseJSON(data);
					console.log(dataSertifikat);
					for (var i = 0; i < dataSertifikat.length; i++) {
						$("#data_sertifikat_db").append("<div class='row'> <div class='col-sm-4'> <div class='form-group'> <input type='text' name='nomor[]' value='"+ dataSertifikat[i].nomor +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-4'> <div class='form-group'> <input type='text' name='nama_kabupaten[]' value='"+ dataSertifikat[i].nama_kab +"' class='form-control input-sm' readonly='readonly'/><input type='hidden' name='id_kabupaten[]' value='"+ dataSertifikat[i].id_kabupaten +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-3'> <div class='form-group'> <input type='text' name='nama_kecamatan[]' value='"+ dataSertifikat[i].nama_kec +"' class='form-control input-sm' readonly='readonly'/><input type='hidden' name='id_kecamatan[]' value='"+ dataSertifikat[i].id_kecamatan +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-1'> <div class='form-group'> <a href='#' id='hapus_sertifikat_db' data-sertifikat-id='" + dataSertifikat[i].id + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> </div></div></div>");
					};
				},
				error : function(data) {
					alert(data);
				}
			});
		}

		load_data_pengurusan_berkas_notaris();
		function load_data_pengurusan_berkas_notaris() {
			$.ajax({
				url : 'modules/notaris/process_get_data_pengurusan_berkas.php',
				type : 'GET',
				data : {
					idNotaris : $("#idNotaris").val()
				},
				success : function(data) {
					var dataPengurusanBerkas = $.parseJSON(data);
					console.log("Edit");
					for (var i = 0; i < dataPengurusanBerkas.length; i++) {
						var dataObjectToEdit = JSON.stringify(dataPengurusanBerkas[i]).replace(/'/g, "\\'");
						console.log(dataObjectToEdit);
						$("#data_pengurusan_berkas_db").append("<div class='row'><div class='col-sm-2'> <div class='form-group'> <input type='hidden' name='id_urus_berkas[]' value='"+ dataPengurusanBerkas[i].id_berkas +"' class='form-control input-sm' readonly='readonly'/> <input type='text' name='nama_urus_berkas[]' title='"+ dataPengurusanBerkas[i].nama_berkas +"' value='"+ dataPengurusanBerkas[i].nama_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='nomor_bpn[]' value='"+ dataPengurusanBerkas[i].nomor_bpn +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='tgl_berkas[]' value='"+ dataPengurusanBerkas[i].tgl_berkas +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <input type='text' name='tgl_selesai[]' value='"+ dataPengurusanBerkas[i].tgl_selesai +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'><input type='hidden' name='id_bagian_lapangan[]' value='"+ dataPengurusanBerkas[i].id_bagian_lapangan +"' class='form-control input-sm' readonly='readonly'/> <input type='text' name='bagian_lapangan[]' value='"+ dataPengurusanBerkas[i].fullname +"' class='form-control input-sm' readonly='readonly'/> </div></div><div class='col-sm-2'> <div class='form-group'> <div class='btn-group'><a href='#' id='hapus_pengurusan_berkas_db' data-urusberkas-id='" + dataPengurusanBerkas[i].id + "' class='btn btn-danger btn-sm'><span class='fa fa-times'></span></a> <a href='#' id='edit_field_pengurusan_berkas' data-urusberkas='" + dataObjectToEdit + "' class='btn btn-primary btn-sm'><span class='fa fa-pencil'></span></a></div> </div></div></div>");
					};
				},
				error : function(data) {
					alert(data);
				}
			});
		}
		/* END NEW FUNCTION */
});