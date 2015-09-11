<?php 
	include "header.php"; 

	$username = $_SESSION['username'];

	$db->select('tb_profil','tb_profil.*, tb_profil.uid as profId, tb_user.*','tb_user ON tb_user.profil_id = tb_profil.uid', 'tb_user.username="'.$username.'"', null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$res = $db->getResult();

	$data = $res[0];
?>

<div class="jumbotron">
  <div class="container" style="color: #ffffff">
    <h1 style="text-shadow: 1px 1px 1px rgba(0,0,0,0.5);"><span class="fa fa-globe"></span> Selamat Datang, <?php echo $data['fullname']; ?></h1>
    <p style="text-shadow: 1px 1px 1px rgba(0,0,0,0.5);">Aplikasi NOTARIS P.P.A.T SITI FEMIRA FINARTI ARIFIN ABIDIN, S.H., M.Kn. </p>
    <br />
    <p>
    	<a class="btn btn-primary btn-lg" role="button" href="main.php?module=documentation&menu=home"><span class="fa fa-book"></span> View Documentation</a>
    	<a class="btn btn-danger btn-lg" role="button" href="main.php?module=setting&menu=home"><span class="fa fa-cogs"></span> Setting</a>
    </p>
  </div>
</div>

<?php include "footer.php"; ?>