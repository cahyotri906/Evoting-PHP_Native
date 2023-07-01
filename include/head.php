<?php require_once 'Core/init.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pemilihan Ketua Osis</title>
	<link rel="stylesheet" href="Assets/css/bootstrap.min.css">
	<link rel="shortcut icon" href="Assets/img/klik.png">
	<link rel="stylesheet" href="Assets/css/alan.css">
	<link rel="stylesheet" href="Assets/css/sweetalert.css">
	<script src="Assets/js/sweetalert.min.js"></script>
</head>
<body >
<?php  

if(isset($_POST['login'])){
	$user = trim($_POST['username']);
	$pass = trim($_POST['password']);

	if(!empty($user) && !empty($pass))
	{
		if(Login_user($user, $pass))
		{
			$_SESSION['user'] = $user;
			header("Location: pilih.php");
		}else{
			?><script>swal("Oops...", "Username or Password is Wrong/Unregisted/Chose", "error");</script><?php
		}
	}else{
		?><script>swal("Oops...", "Form There's Something Empty", "error");</script><?php
	}
}

?>
    </body>
<nav id="nav" class="navbar navbar-default" style="background-color: #ffc200;border-top-width: 0px;border-left-width: 0px;border-bottom-width: 0px;border-right-width: 0px;">
  <div class="container">
    <div class="navbar-header">  
      <!-- <a class="navbar-brand" href="#"> -->
        <img class="navbar-brand" style="height: 100%;" alt="Brand" src="assets/img/pemilihanosis.png"><!-- <a href="#"></a> -->
     <!--  </a> -->
    </div>

	    <ul class="nav navbar-nav navbar-right">
	    	<li>
	    		<img style="height: 100%;" src="Assets/img/foto.png">
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
  </div>
</nav>

    