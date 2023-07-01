
<?php
session_start();
include_once 'include/voting-class.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pemilu OSIS SMK TRI MITRA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="asset/boot4/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="asset/fontawesome/css/all.css" rel="stylesheet">
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/css/aku.css" rel="stylesheet">
  <link href="asset/css/bootstrap-responsive.min.css" rel="stylesheet">
  <link href="asset/css/docs.css" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="datatables/images/TMKM.png" />
  <link rel="stylesheet" href="p-responsive.min.css" rel="stylesheet">
   <script src="asset/js/jquery-latest.js"></script>
  <script src="asset/js/bootstrap.min.js"></script>

</head>

<nav id="atas" class="navbar navbar-default" style="background-color: #ffc200;">
  
    <div class="navbar-header">  
      
        <img class="navbar-brand" style="max-height: 60px;" alt="Brand" src="asset/img/pemilihanosis.png">
    
    </div>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <img style="height: 60px;" src="asset/img/foto.png">
        </li>
        <li><br>
            <b id="txt" style="padding-top-top: 8px; color: #000000;">Selamat Datang</b><br>
            <i><?php if(isset($_SESSION['user'])){
              $sesi = $_SESSION['user'];
              tampil($sesi);
              }
          ?>
        </i>
          </li>
    </ul>
  
</nav>

<style type="text/css">
  body{padding-top: 0px;
background-image: url('asset/img/latar.png');
background-size: cover;
background-attachment: fixed;}
</style>

<body>


<div class="container">
  
  <div id="row" class="row">

    <div class="col-sm-5">
      <img id="kpo" src="asset/img/pilketos2.png" width="130%" alt="Komisi Pemilihan OSIS">
      <h4>Cara Melakukan Vote:</h4>
      <p>1. Masukkan Username & Password</p>
      <p>2. Klik Login</p>
      <p>3. Pada Tampilan Utama ada calon kandidat ketua osis</p>
      <p>4. Klik Vote pada salah satu dari kandidat calon ketua osis</p>
      <p>5. Selesai</p>
    
    </div>


    <div class="col-sm-4 offset-sm-2" style="padding-top: 100px;">
      
        <div id="default" class="panel panel-default" style="background: #3399ff;padding: 15px; width: 350px;border: none;border-radius: 20px;">
          <center><i class="fas fa-users" style="font-size: 60px;"></i></center>
          
          <div class="panel-body">
            <form action="" style="text-align:center;" method="post" name="login">
              <div class="form-group">
              <input type="text" class="form-control" id="form-aing" name="username" id="username" placeholder="USERNAME" >
              </div>
              <div class="form-group">
                  <input type="password" class="form-control"  id="form-aing"name="password" id="password" placeholder="PASSWORD">
              </div>
              <input type="submit" id="primary" name="login" class="btn btn-primary" value="Login">
              <button type="reset" id="primary" class="btn btn-primary">Reset</button>

            </form>
          </div>
        </div>
      </center>
    </div>

    <!--  <div class="col-sm-4">
        <form style="text-align:center;" method="post" name="login">
       <div class="form-group">
         <input type="text" class="form-control" name="username" id="username" placeholder="USERNAME">
      </div>
      <div class="form-group">
      <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <button type="reset" class="btn">Reset</button>
        </form>
    </div>  -->
  </div> 
  

<?php 
  $user = new User();
  $db = new Database();

  $db->connectMySQL();


  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $login = $user->cek_login(mysql_real_escape_string($_POST['username']), mysql_real_escape_string($_POST['password']));
    if($login){
      if($user->sesi()==1){
        header("location:home.php?mod=pemilu");
      }elseif($user->sesi()==2){
        header("location:home.php?mod=pemilu");
      }
    }else{
      echo "
      <div class=\"alert alert-block\" id=\"tampilgagal\"style=\"
    top: 20px; background-color: #ffffff3d; \" >
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
        <center style=\" color:red; \" >
        <h4 style=\"
    font-weight: bold;
\">LOGIN GAGAL!</h4>
        ID atau PASSWORD salah!
        </center>
      </div>
      ";
    }
  }
  ?>

</div> <!-- /container -->


<nav id="foot" class="navbar navbar-default navbar-fixed-bottom" style="background-color: #ffa000;">
  <div class="container">
      <p class="navbar-text">Jujur, Terbuka & Transparan <?=date('Y');?></p>
      <p class="navbar-text"> &copy; SMK TRI MITRA</p>
      <p id="alamat" class="navbar-text navbar-right">
   #satuklikuntukperubahan
      </p>
  </div>
</nav>
<script src="asset/boot4/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
