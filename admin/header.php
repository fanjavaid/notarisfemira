<?php
	session_start();
	date_default_timezone_set('Asia/Bangkok');

	// cek login
	if (!isset($_SESSION['username'])) {
		header("Location:../index.php");
	}
	
	// $home_url = "http://notarisfemira.com/admin/main.php"; 
	$home_url = "http://localhost/notarisfemira/admin/main.php"; 
	include "../config/connection.php";

	include('../class/mysql_crud.php');
	$db = new Database();
	$db->connect();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Administrator</title>

    <script src="../js/jquery-1.11.3.min.js"></script>

    <!-- Input Mask-->
    <script src="../js/vanilla-masker.min.js"></script>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="../css/bootstrap-theme.min.css" rel="stylesheet"> -->
	
	<!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!--
    <link rel="stylesheet" href="../js/jquery-ui.css">
	<script src="../js/jquery-ui.js"></script>
	<script>
		$(function() {
			$( ".datepicker" ).datepicker({
				dateFormat : "yy-mm-dd"
			});
		});
	</script>
	-->
	<link id="bsdp-css" href="../css/bootstrap-datepicker3.css" rel="stylesheet">
	<script src="../js/bootstrap-datepicker.js"></script>
	<script>
		$(function() {
			$( ".datepicker" ).datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
				todayHighlight: true
			});
		});
	</script>

	<!-- Select2 -->
	<!-- <link href="../css/select2.min.css" rel="stylesheet" /> -->
	<script src="../js/select2.min.js"></script>
	<link href="../css/select2.css" rel="stylesheet" />
	<link href="../css/select2-bootstrap.css" rel="stylesheet" />
	<script>
		$(document).ready(function() {
			$('select').select2();
			$('#kabupaten').select2("data", { id: '', text: "Select Kabupaten" });
		});
	</script>

  </head>
  <body <?php echo (!isset($_GET['module']))? 'style="background: url(resources/bg.jpg); background-size:cover;"' : ''; ?>>
    <nav class="navbar navbar-default" role="navigation" style="border-radius:0px">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#"></span>Aplikasi Notaris</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="<?php echo (!@$_GET['module'])? "active":""; ?>"><a href="<?php echo $home_url; ?>"><span class="fa fa-home"></span> Home</a></li>
	        <li class="dropdown <?php echo (@$_GET['module'] == "karyawan" || @$_GET['module'] == "debitur" || @$_GET['module'] == "order" || @$_GET['module'] == "berkas")? "active":""; ?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-database"></span> Master Data <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li><a href="<?php echo $home_url; ?>?module=karyawan&menu=home">Karyawan</a></li>
				<li><a href="<?php echo $home_url; ?>?module=debitur&menu=home">Debitur</a></li>
				<li><a href="<?php echo $home_url; ?>?module=berkas&menu=home">Berkas</a></li>
				<li><a href="<?php echo $home_url; ?>?module=order&menu=home">Referensi</a></li>
	          </ul>
	        </li>
			<li class="<?php echo (@$_GET['module'] == "notaris")? "active":""; ?>"><a href="<?php echo $home_url; ?>?module=notaris&menu=home"><span class="fa fa-file-text"></span> Notaris</a></li>
			<li class="<?php echo (@$_GET['module'] == "laporan")? "active":""; ?>"><a href="<?php echo $home_url; ?>?module=kas&menu=home"><span class="fa fa-bar-chart"></span> Kas</a></li>
	      </ul>

	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown <?php echo (@$_GET['module'] == "setting")? "active":""; ?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          	<span class="fa fa-user"></span> <?php echo $_SESSION['username']; ?> <b class="caret"></b>
	          </a>
	          <ul class="dropdown-menu">
	            <li><a href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
	            <li><a href="<?php echo $home_url; ?>?module=setting&menu=home"><span class="fa fa-cogs"></span> Setting</a></li>
	          </ul>
	        </li>
	        <li>
	        	<p class="navbar-text"><span class="fa fa-clock-o"></span> <abbr title="Last login info"><?php echo $_SESSION['last_login']; ?></abbr></p>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<?php if(isset($_GET['module'])) { ?>
	<div class="container-fluid" style="display:none;">
		<?php
	  		$module = "";
	  		$title 	= ""; 
			$link_input = "";
			$link_view = "";
			$link_status1 = "";
			$link_status2 = "";
			$link_status3 = "";

			if(isset($_GET['menu'])) {
				$link_status1 = ($_GET['menu'] == "insert") ? "active" : "";
				$link_status2 = ($_GET['menu'] == "home") ? "active" : "";
				$link_status3 = ($_GET['menu'] == "pengeluaran") ? "active" : "";
			}

	  		if (isset($_GET['module'])) {
	  			$module = $_GET['module'];
	  			$link_input = $home_url . "?module=" . $module . "&menu=insert";
	  			$link_input_pengeluaran = $home_url . "?module=" . $module . "&menu=pengeluaran";
	  			$link_view = $home_url . "?module=" . $module . "&menu=home";
	  		}

	  		switch ($module) {
	  			case 'karyawan':
	  				$title = "Karyawan";
	  				$db->select('tb_profil','tb_profil.uid, tb_profil.fullname, tb_profil.gender, tb_karyawan.kode','tb_karyawan ON tb_karyawan.profil_id = tb_profil.uid', null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$res = $db->getResult();
	  				break;
	  			case 'debitur':
	  				$title = "Debitur";
	  				$db->select('tb_profil','tb_profil.uid, tb_profil.fullname, tb_profil.gender, tb_debitur.kode','tb_debitur ON tb_debitur.profil_id = tb_profil.uid', null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$res = $db->getResult();
	  				break;
	  			case 'order':
	  				$title = "Referensi Order";
	  				$db->select('tb_reforder','tb_reforder.*',null, null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$res = $db->getResult();
	  				break;
	  			case 'berkas':
	  				$title = "Berkas";
	  				$db->select('tb_berkas','tb_berkas.*',null, null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$res = $db->getResult();
	  				break;		
	  			case 'notaris':
	  				$title = "Pengurusan Berkas";
	  				$query = "
						select a.uid as idNotaris, a.status, a.tgl_masuk, a.tgl_penyerahan,
						b.fullname as debiturName, e.fullname as pemberkasanName, f.fullname as karInput, g.fullname as karLapangan
						from tb_notaris a
						left join tb_debitur c on a.id_debitur = c.uid
						left join tb_karyawan d on a.id_kar_pemberkasan = d.uid
						left join tb_karyawan d1 on a.id_kar_input = d1.uid
						left join tb_karyawan d2 on a.id_kar_lapangan = d2.uid
						left join tb_profil b on c.profil_id = b.uid
						left join tb_profil e on d.profil_id = e.uid
						left join tb_profil f on d1.profil_id = f.uid
						left join tb_profil g on d2.profil_id = g.uid";
					$sql = mysql_query($query);
					$totalNotaris = mysql_num_rows($sql);

	  				break;
  				case 'setting':
  					$title = "Pengaturan";
  					break;
  				case 'kas':
	  				$title = "Kas";
	  				$db->select('tb_kas','tb_kas.*',null, null, null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$res = $db->getResult();
	  				break;		
	  			default:
	  				$title = "NULL";
	  				break;
	  		}
	  	?>

		<div class="row">
		  <div class="col-md-2">
		  	<?php 
		  		if(isset($_GET['module'])) {
					if($_GET['module'] == 'setting') {

			?>
					<div class="list-group">
					  <a href="main.php?module=setting&menu=home" class="list-group-item <?php echo ($_GET['menu'] == 'home') ? "active" : "" ?>">Admin Setting</a>
					  <a href="main.php?module=setting&menu=kas" class="list-group-item <?php echo ($_GET['menu'] == 'kas') ? "active" : "" ?>">Kas Setting</a>
					</div>
			<?php
					} else {
			?>
			
					<div class="list-group">
				  	  <a href="<?php echo $link_view; ?>" class="list-group-item <?php echo $link_status2; ?>">
					  	<span class="badge"><?php echo ($module == "notaris") ? $totalNotaris : $db->numRows(); ?></span>
					  	Lihat Data
					  </a>
					  <a href="<?php echo $link_input; ?>" class="list-group-item <?php echo $link_status1; ?>">Input Data</a>
					  <?php
					  	if($_GET['module'] == 'notaris' && $_GET['menu'] == 'pengeluaran') {
					  		echo "<a href=\"$link_input_pengeluaran\" class=\"list-group-item $link_status3\">Pengeluaran</a>";
					  	}
					  ?>
					</div>
			
			<?php
					}
				}
		  	?>
		  </div>

		  <div class="col-md-10">
		  	<div class="panel panel-default">
		  		<div class="panel-heading"><?php echo $title; ?></div>
			  	<div class="panel-body">
	<?php } ?>