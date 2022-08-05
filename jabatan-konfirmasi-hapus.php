<?php
	session_start();
	if(!isset($_SESSION["id_petugas"]))
		header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/690968474209615962/1004277406254764072/cropped-logo-kominfo.png" />
<style>
a {font-size:20px;
color:white;
}
h1 {color:white;}
table {background-color:white;
       color:black;}
table tr {color:black;}
table td {color:black;}
body {background: url("badut.jpg");
      background-size:100%;
	  }
</style><title>Hapus Data Jabatan</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Hapus Data Jabatan</h1>
<?php
$db=dbConnect();
if(isset($_GET["id_jabatan"])){	
$id_jabatan=(String)$_GET["id_jabatan"];
$id_jabatan=openssl_decrypt($id_jabatan,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
if(!$id_jabatan){ // jika $idakun kosong (karena gagal decrypt)
	echo "Session anda expire, silahkan login kembali.";
}
else
$sql=$db->query("select * from jabatan where id_jabatan='$id_jabatan';");
	if($datajabatan=getDataJabatan($id_jabatan)){// cari data akun ubisoft, kalau ada simpan di $data
		?>
<a href="jabatan.php"><button>View Jabatan</button></a>
<form method="post" name="frm" action="jabatan-hapus.php">
<input type="hidden" name="id_jabatan" value="<?php echo $datajabatan["id_jabatan"];?>">
<table border="1">
<tr><td>Id jabatan</td><td><?php echo $datajabatan["id_jabatan"];?></td></tr>
<tr><td>Nama jabatan</td><td><?php echo $datajabatan["jabatan"];?></td></tr>
<tr><td>Mulai menjabat</td><td><?php echo $datajabatan["mulai_jabat"];?></td></tr>
<tr><td>Akhir menjabat</td><td><?php echo $datajabatan["akhir_jabat"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "<div style='color: white'>jabatan dengan Id : $id_jabatan tidak ada. Penghapusan dibatalkan</div>";
?>
<?php
}
else
	echo "<div style='color: white'> Idjabatan tidak ada. Penghapusan dibatalkan. </div>";
?>
</body>
</html>