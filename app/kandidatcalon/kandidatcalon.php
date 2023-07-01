<?php
if (!$user->get_sesi()) {
  header("location:index.php");
}else{
$modpath 	= "app/kandidatcalon/";
$action		= $modpath."proses.php";

$kandidat = new DataKandidat();
$hsl = new Hasil();
$validasi = new VotingValidasi;
switch (@$_GET['act']) {
default:
?>

<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Kandidat Calon</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li><a href="?mod=<?php echo @$_GET['mod']?>&amp;act=add" class="medium-box"><i class="icon-plus-sign icon-white"></i> Tambah</a></li>
				</ul>
			</div>
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
	?>
		<div class="span3" align="center">
			<button class="btn btn-large btn-block btn-warning" type="button" disabled="disabled">Kandidat ke <b><?php echo $c=$c+1;?></b></button>
			<img src="asset/img/kandidat/<?php echo $data['foto']; ?>" class="img-responsive">
			<b><?php echo strtoupper($data['ketua']);?></b>
			<div class="btn-group">
				<a href="?mod=<?php echo @$_GET['mod']?>&amp;act=edit&amp;kode=<?php echo $data['id_kandidat']; ?>" class="btn btn-info">EDIT</a>
				<a href="<?php echo $action.'?mod='.$_GET['mod'].'&act=delete&kode='.$data['id_kandidat']; ?>" onClick="return confirm('Anda Yakin??');" class="btn btn-danger">HAPUS</a>
				<a href="?mod=<?php echo @$_GET['mod']?>&amp;act=hasil&amp;kode=<?php echo $data['id_kandidat']; ?>" class="btn btn-success">LIHAT HASIL</a>
			</div>
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
case 'add':
?>

<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Tambah Kandidat Calon</a>
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->
<div class="well">
	<?php
	if(isset($_POST['submit'])){
		$ketua = $validasi->xss($_POST['ketua']);
		$visi = $validasi->xss($_POST['visi']);
		$misi = $validasi->xss($_POST['misi']);
		$seotitle = seo_title($ketua);

		$extensionList = array("jpg", "jpeg", "png");
		$lokasi_file = $_FILES['fupload']['tmp_name'];
    	$nama_file   = $_FILES['fupload']['name'];
    	$pecah = explode(".", $nama_file);
		$ekstensi = @$pecah[1];
		$rand = rand(1111,9999);
		$nama_file_unik = $rand."-".$seotitle.'.'.$ekstensi;
		$image = 'calon-'.$nama_file_unik;

		if (in_array($ekstensi, $extensionList)){
			UploadImages($image);
			if($kandidat->tambahDataKandidat($ketua,$visi,$misi,$image)){?>
			<meta http-equiv='refresh' content='0; url=?mod=kandidatcalon'>
			<div class="alert-success alert-block">
		        <button type="button" class="close" data-dismiss="alert">×</button>
		        <h4>Berhasil!</h4>
		    	Berhasil menambah Data Kandidat
	      	</div>
			<?php }else{
				echo "
				<div class=\"alert alert-block\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
					<h4>GAGAL!</h4>
					Gagal menyimpan!
				</div>
				";
			}
		}else{
			echo "
			<div class=\"alert alert-block\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
				<h4>FORMAT GAMBAR SALAH!</h4>
				Format Gambar tidak didukung!
			</div>
			";
		}
	}
	?>
	<form class="form-horizontal" method="post" id="form" enctype="multipart/form-data">
		<div class="control-group">
			<label class="control-label" for="ketua">Nama Calon Ketua</label>
			<div class="controls">
		  		<input type="text" class="span3" required maxlength="25" name="ketua" id="ketua" value="">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="visi">Visi</label>
			<div class="controls">
		  		<textarea class="span3" name="visi" required="true" id="visi"></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="misi">Misi</label>
			<div class="controls">
		  		<textarea class="span3" name="misi" required="true" id="misi"></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Foto Calon</label>
			<div class="controls">
		  		<input type="file" class="span4" required name="fupload" id="fupload">
			</div>
	  		<small><b>Gunakan ekstensi .jpg .jpeg .png</b></small>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
				<a href="?mod=<?php echo $_GET['mod']; ?>" class="btn">Tutup</a>
			</div>
		</div>
	</form>
</div>

<?php
break;
case 'edit':
$id = $validasi->sql(@$_GET['kode']);
$id = $validasi->xss($id);
?>
<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Edit Kandidat Calon</a>
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->
<div class="well">
	<?php
	if(isset($_POST['update'])){
		$ketua = $validasi->xss($_POST['ketua']);
		$visi = $validasi->xss($_POST['visi']);
		$misi = $validasi->xss($_POST['misi']);
		$id = $validasi->xss($_POST['txtkode']);
		$seotitle = seo_title($ketua);

		$extensionList = array("jpg", "jpeg", "png");
		$lokasi_file = $_FILES['fupload']['tmp_name'];
    	$nama_file   = $_FILES['fupload']['name'];
    	$pecah = explode(".", $nama_file);
		$ekstensi = @$pecah[1];
		$rand = rand(1111,9999);
		$nama_file_unik = $rand."-".$seotitle.'.'.$ekstensi;
		$image = 'calon-'.$nama_file_unik;

		if(!empty($_FILES['fupload']['tmp_name'])){
			if (in_array($ekstensi, $extensionList)){
				UploadImages($image);
				if($kandidat->updateDataKandidatFoto($ketua,$visi,$misi,$image,$id)){ ?>
					<meta http-equiv='refresh' content='0; url=?mod=kandidatcalon'>
					<div class="alert-success alert-block">
				        <button type="button" class="close" data-dismiss="alert">×</button>
				        <h4>Berhasil!</h4>
				    	Berhasil mengubah Data Kandidat
			      	</div>
				<?php
				}else{
					echo "
					<div class=\"alert alert-block\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
						<h4>GAGAL!</h4>
						Gagal menyimpan!
					</div>
					";
				}
			}else{
				echo "
				<div class=\"alert alert-block\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
					<h4>FORMAT GAMBAR SALAH!</h4>
					Format Gambar tidak didukung!
				</div>
				";
			}
		}else{
			if($kandidat->updateDataKandidat($ketua,$visi,$misi,$id)){ ?>
				<meta http-equiv='refresh' content='0; url=?mod=kandidatcalon'>
				<div class="alert-success alert-block">
			        <button type="button" class="close" data-dismiss="alert">×</button>
			        <h4>Berhasil!</h4>
			    	Berhasil mengubah Data Kandidat
		      	</div>
			<?php
			}else{
				echo "
				<div class=\"alert alert-block\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
					<h4>GAGAL!</h4>
					Gagal menyimpan!
				</div>
				";
			}
		}
	}
	?>
	<form class="form-horizontal" method="post" id="form" enctype="multipart/form-data">
		<div class="control-group">
			<label class="control-label" for="ketua">Nama Calon Ketua</label>
			<div class="controls">
		  		<input type="text" class="span3" required maxlength="25" name="ketua" id="ketua" value="<?php echo $kandidat->bacaDataKandidat('ketua', $id); ?>">
			</div><input type="text" name="txtkode" style="display:none;" value="<?php echo $kandidat->bacaDataKandidat('id_kandidat', $id); ?>">
		</div>
		<div class="control-group">
			<label class="control-label" for="visi">Visi</label>
			<div class="controls">
		  		<textarea class="span3" name="visi" required="true" id="visi"><?php echo $kandidat->bacaDataKandidat('visi', $id); ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="misi">Misi</label>
			<div class="controls">
		  		<textarea class="span3" name="misi" required="true" id="misi"><?php echo $kandidat->bacaDataKandidat('misi', $id); ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Foto Calon</label>
			<div class="controls">
				<img src="asset/img/kandidat/<?php echo $kandidat->bacaDataKandidat('foto', $id); ?>" class="img-responsive"><br>
		  		<input type="file" class="span4" name="fupload" id="fupload">
			</div>
	  		<small><b>Gunakan ekstensi .jpg .jpeg .png</b></small>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" name="update" class="btn btn-primary">Simpan</button>
				<a href="?mod=<?php echo $_GET['mod']; ?>" class="btn">Tutup</a>
			</div>
		</div>
	</form>
</div>

<?php
break;
case 'hasil':
$id = $validasi->sql(@$_GET['kode']);
$id = $validasi->xss($id);
?>
<div class="well">
    <h3 class="center">HASIL PEROLEHAN SUARA CALON KETUA OSIS</h3>
	<h3 class="center"></h3>
	<h4 class="center">MASA JABATAN 2018/2019</h4>
	<div style="text-align:center;"><img src="asset/img/kandidat/<?php echo $kandidat->bacaDataKandidat('foto', $id); ?>" class="img-responsive"></div>
	<h6 class="center"><?php echo $kandidat->bacaDataKandidat('ketua', $id); ?></h6>
</div>
<h2>Daftar Pemilih</h2>
<section>
	<table id="datatable" class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>No.</th>
				<th>Username</th>
				<th>Jabatan</th>
				<th>Kelas</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$array = $hsl->tampilHasilSemua($id);
		if(count($array)){
			foreach ($array as $data) {
				$tgl = substr($data['waktu'], 0, 10);
		?>
			<tr>
				<td><?php echo $c=$c+1;?></td>
				<td><?php echo strtoupper($data['username']);?></td>
				<td><?php echo strtoupper($data['jurusan']);?></td>
				<td><?php echo strtoupper($data['prodi']);?></td>
				<td><?php echo DateToIndo($tgl);?></td>
			</tr>
		<?php
			}
		}else{
			echo "Belum ada Pemilih";
		}
		?>
		</tbody>
	</table>
</section>
<?php
break;
}
}
?>
