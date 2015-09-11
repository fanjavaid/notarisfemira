<?php include "header.php"; ?>

<script type="text/javascript">
 	$(document).ready(function(){
 		$('.menu-table a.link-modal').each(function(){
			$(this, '#delete').click(function(){
				var uid = $(this).data('id');

	 			$('#deleteId').val(uid);
	 			$('#deleteModal').modal();
			});
 		});

 		$('ul.dropdown-menu li a').click(function(){
 			$('#condition_type').val($(this).attr('id'));
 			console.log("Search by : " + $(this).attr('id'));
 		});	
 	});
</script>

<?php
	$condition = null;

	$condition_type = "tb_kas.nama_pengeluaran";

	$sort_by = "";

	if (isset($_GET['sort'])) {
		$sort_by .= $_GET['sort'];
	}

	if(isset($_GET['condition_type'])) {
		if ($_GET['condition_type'] == "nama") {
			$condition_type = "tb_kas.nama_pengeluaran";
		}
	}

	if (isset($_GET['s'])) {
		$condition = $_GET['s'];
		$condition = $condition_type ." LIKE '%". $condition . "%'";
	}

	$db->select('tb_kas','tb_kas.*',null, $condition, $sort_by); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = null;

	if ($db->numRows() > 0) {
		$data = $res[0];
	}
	
?>

<form class="form-inline" role="form" method="get" action="main.php">
	<div class="row">
	  	<div class="col-lg-6">
			<div class="input-group">
		      <div class="input-group-btn">
		        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Nama <span class="caret"></span></button>
		        <ul class="dropdown-menu">
		          <li><a href="#" id="nama">Nama</a></li>
		        </ul>
		      </div><!-- /btn-group -->

		      <input type="hidden" name="condition_type" id="condition_type" value="kode" />
		      <input type="hidden" name="module" value="kas" />
		      <input type="hidden" name="menu" value="home" />

		      <input type="text" name="s" class="form-control" placeholder="Enter keyword">
		      <span class="input-group-btn">
		        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		      </span>
		    </div><!-- /input-group -->
		</div>
	</div>
</form>

<br>

<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th><a href="main.php?module=kas&menu=home&sort=jenis_kas" title="Urutkan"><span class="glyphicon glyphicon-sort-by-attributes"></span> Jenis Kas</a></th>
			<th>Pengeluaran</th>
			<th>Total (Rp)</th>
			<th><a href="main.php?module=kas&menu=home&sort=tgl_pengeluaran" title="Urutkan"><span class="glyphicon glyphicon-sort-by-attributes"></span> Tgl. Pengeluaran</a></th>
			<th>Deskripsi</th>
			<th>Action</th>
		</tr>
	</thead>

	<?php 
	$i = 1;
	foreach ($res as $data) { ?>
	
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo ucfirst($data['jenis_kas']); ?></td>
		<td><?php echo $data['nama_pengeluaran']; ?></td>
		<td><?php echo number_format($data['total_pengeluaran']); ?></td>
		<td><?php echo $data['tgl_pengeluaran']; ?></td>
		<td><?php echo $data['keterangan']; ?></td>
		<td class="menu-table">
			<a href="main.php?module=kas&menu=update&uid=<?php echo $data['uid'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="#" class="link-modal" id="delete" data-id="<?php echo $data['uid'] ?>" title="Delete"><span class="glyphicon glyphicon-remove red"></span></a>
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
  	<form method="post" action="main.php?module=kas&process=delete">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini?</p>
        <input type="hidden" name="uid" id="deleteId"> <!-- Berkas ID -->
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