<?php include "header.php"; ?>

<style>
	.finish_status {
		border-bottom: 1px dotted #0099ff;
	}
</style>

<script type="text/javascript">
 	$(document).ready(function(){
 		$('.mytable .finish_status').each(function(){
 			$(this, '#example').tooltip();
 		});

 		$('.menu-table a.link-modal').each(function(){
			$(this, '#delete').click(function(){
				var uid = $(this).data('id');

	 			$('#deleteId').val(uid);
	 			$('#deleteModal').modal();
			});
 		});

 		$('ul.dropdown-menu li a').click(function(){
 			$('#condition_type').val($(this).attr('id'));
 		});	
 	});
</script>

<?php
	$condition = null;

	$condition_type = "";

	if(isset($_GET['condition_type'])) {
		if ($_GET['condition_type'] == "debitur") {
			$condition_type = "where b.fullname";
		} else if ($_GET['condition_type'] == "bag_input") {
			$condition_type = "where e.fullname";
		} else if ($_GET['condition_type'] == "bag_pemberkasan") {
			$condition_type = "where f.fullname";
		} else if ($_GET['condition_type'] == "bag_lapangan") {
			$condition_type = "where g.fullname";
		}
	}

	if (isset($_GET['s'])) {
		$condition = $_GET['s'];
		$condition = $condition_type ." LIKE '%". $condition . "%'";
	}

	$query = "
		select a.uid as idNotaris, a.status, a.tgl_masuk, a.tgl_penyerahan, a.tgl_selesai,
		b.fullname as debiturName, e.fullname as pemberkasanName, f.fullname as karInput, g.fullname as karLapangan
		from tb_notaris a
		left join tb_debitur c on a.id_debitur = c.uid
		left join tb_karyawan d on a.id_kar_pemberkasan = d.uid
		left join tb_karyawan d1 on a.id_kar_input = d1.uid
		left join tb_karyawan d2 on a.id_kar_lapangan = d2.uid
		left join tb_profil b on c.profil_id = b.uid
		left join tb_profil e on d.profil_id = e.uid
		left join tb_profil f on d1.profil_id = f.uid
		left join tb_profil g on d2.profil_id = g.uid
		$condition
	";
	$sql = mysql_query($query);
?>

<form class="form-inline" role="form" method="get" action="main.php">
	<div class="row">
	  	<div class="col-lg-6">
			<div class="input-group">
		      <div class="input-group-btn">
		        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Debitur <span class="caret"></span></button>
		        <ul class="dropdown-menu">
		          <li><a href="#" id="debitur">Debitur</a></li>
		          <li><a href="#" id="bag_pemberkasan">Bag. Pemberkasan</a></li>
		          <li><a href="#" id="bag_input">Bag. Input</a></li>
		          <li><a href="#" id="bag_lapangan">Bag. Lapangan</a></li>
		        </ul>
		      </div><!-- /btn-group -->

		      <input type="hidden" name="condition_type" id="condition_type" value="debitur" />
		      <input type="hidden" name="module" value="notaris" />
		      <input type="hidden" name="menu" value="home" />

		      <input type="text" name="s" class="form-control" id="textSearch" placeholder="Enter Keyword">
		      <span class="input-group-btn">
		        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		      </span>
		    </div><!-- /input-group -->
		</div>
	</div>
</form>

<br>

<div class="table-responsive table-notaris">
<table id="example2" class="table table-striped table-hover mytable">
	<thead>
		<tr>
			<th width="10px">No.</th>
			<th>Debitur</th>
			<th width="150px">Tgl. Masuk</th>
			<th width="150px">Tgl. Penyerahan</th>
			<th width="100px">Status</th>
			<th width="50px">Action</th>
		</tr>
	</thead>

	<?php 
		$i = 1;
		while ($data = mysql_fetch_assoc($sql)) { 
			$queryPengeluaran = "SELECT COUNT(*) as totalPengeluaran FROM tb_pengeluaran WHERE id_notaris = '$data[idNotaris]'";
			$sqlPengeluaran   = mysql_query($queryPengeluaran);
			$dataPengeluaran  = mysql_fetch_assoc($sqlPengeluaran);

			$tglSelesai = date('d M Y', strtotime($data['tgl_selesai']));
	?>
	
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['debiturName']; ?></td>
		<td><?php echo $data['tgl_masuk']; ?></td>
		<td><?php echo $data['tgl_penyerahan']; ?></td>
		<td><?php echo ($data['status'] == "0") ? "<font color=#ccc>On Process</font>" : "<font color='#0099ff' class='finish_status' id='example' data-toggle='tooltip' data-placement='top' title='Tgl.Selesai $tglSelesai'>Finish</font>" ?></td>
		<td class="menu-table">
			<a href="main.php?module=notaris&menu=update&idNotaris=<?php echo $data['idNotaris'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="#" class="link-modal" id="delete" data-id="<?php echo $data['idNotaris'] ?>" title="Delete"><span class="glyphicon glyphicon-remove red"></span></a>
		</td>
	</tr>

	<?php $i++; } ?>
</table>
</div>

<!--
<div class="row">
    <div class="col-md-12 text-center">
		<ul class="pagination pagination-sm pagination-centered">
		  <li class="disabled"><a href="#">&laquo;</a></li>
		  <li class="active"><a href="#">1</a></li>
		  <li><a href="#">2</a></li>
		  <li><a href="#">3</a></li>
		  <li><a href="#">4</a></li>
		  <li><a href="#">5</a></li>
		  <li><a href="#">&raquo;</a></li>
		</ul>
	</div>
</div>
-->

<!-- Modal Dialog Delete -->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
  	<form method="post" action="main.php?module=notaris&process=delete">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini?</p>
        <input type="hidden" name="uid" id="deleteId"> <!-- Notaris ID -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include "footer.php" ?>