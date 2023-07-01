<?php
if (!$user->get_sesi()) {
  header("location:index.php");
}else{
$modpath 	= "app/perolehansuara/";
$action		= $modpath."proses.php";

$kandidat = new DataKandidat();
$hsl = new Hasil();
$validasi = new VotingValidasi;
switch (@$_GET['act']) {
default:
?>
<meta http-equiv=refresh content=1;url=home.php?mod=perolehansuara>
<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Hasil Perolehan Suara</a>
			<a class="btn btn-primary" href="?mod=<?php echo @$_GET['mod']?>&amp;act=reset" onClick="return confirm('Anda Yakin??');">RESET</a>
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->
<div class="well">
<div class="row">
	<div class="span1"></div>
	<div class="span10">
	<?php
	$arrayKandidat = $kandidat->tampilKandidatSemua();
	if(count($arrayKandidat)){
		foreach ($arrayKandidat as $data) {
			$id_kandidat = $data['id_kandidat'];
	?>
		<div class="span3" align="center">
			<button class="btn btn-large btn-block btn-warning" type="button" disabled="disabled">Kandidat ke <b><?php echo $c=$c+1;?></b></button>
			<img src="asset/img/kandidat/<?php echo $data['foto']; ?>" class="img-responsive">
			<b><?php echo strtoupper($data['ketua']);?></b>
			<?php
			$jumlahSuara = $hsl->jumlahSuaraVoting($id_kandidat);
			?>
			<h2 class="suara"> <?php echo $jumlahSuara['jumlah']; ?> Suara </h2>
		</div>
	<?php
		}
	}else{
		echo "Belum ada Kandidat";
	}
	?>
	</div>
	<div class="span1"></div>
</div>
</div>
<?php
break;
case 'reset':

$reset = $hsl->reset();
if ($reset) {
	header('Location: ?mod=perolehansuara');
} else {
	echo mysql_error();
}


break;
}
}
?>
