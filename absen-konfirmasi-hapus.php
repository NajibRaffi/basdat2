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
</style><title>Hapus Data Absen</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Hapus Data Absen</h1>
<?php
$db=dbConnect();
if(isset($_GET["id_absen"])){	
$id_absen=(String)$_GET["id_absen"];
$id_absen=openssl_decrypt($id_absen,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
if(!$id_absen){ // jika $idakun kosong (karena gagal decrypt)
	echo "Session anda sudah habis, silahkan login kembali.";
}
else
$sql=$db->query("select absen.id_absen,absen.alfa,absen.sakit,absen.sakit,absen.id_petugas,absen.id_jabatan from absen inner join akunpetugas on absen.id_absen = akunpetugas.id_petugas inner join jabatan on absen.id_jabatan = jabatan.id_jabatan where id_absen='$id_absen';");
	if($dataabsen=getDataAbsen($id_absen)){// cari data akun moonton, kalau ada simpan di $data
		?>
<a href="absen.php"><button>View Absen</button></a>
<form method="post" name="frm" action="absen-hapus.php">
<input type="hidden" name="id_absen" value="<?php echo $dataabsen["id_absen"];?>">
<table border="1">
<tr><td>Id Absen</td><td><?php echo $dataabsen["id_absen"];?></td></tr>
<tr><td>Alfa</td><td><?php echo $dataabsen["alfa"];?></td></tr>
<tr><td>Sakit</td><td><?php echo $dataabsen["sakit"];?></td></tr>
<tr><td>Izin</td><td><?php echo $dataabsen["izin"];?></td></tr>
<tr><td>Id Petugas</td><td><?php echo $dataabsen["id_petugas"];?></td></tr>
<tr><td>Id Jabatan</td><td><?php echo $dataabsen["id_jabatan"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "<div style='color: white'>Absen dengan Id : $id_absen tidak ada. Penghapusan dibatalkan</div>";
?>
<?php
}
else
	echo "<div style='color: white'> IdAbsen tidak ada. Penghapusan dibatalkan. </div>";
?>
</body>
</html>