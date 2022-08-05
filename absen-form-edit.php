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
</style><title>Edit Data Absen</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>
<h1 style="color: white">Edit Data Absen</h1>
<?php
$db=dbConnect();
if(isset($_GET["id_absen"])){	
$id_absen=(String)$_GET["id_absen"];
$id_absen=openssl_decrypt($id_absen,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
if(!$id_absen){ // jika $idabsen kosong (karena gagal decrypt)
	echo "Session anda expire, silahkan login kembali.";
}
else
$sql=$db->query("select absen.id_absen,absen.alfa,absen.sakit,absen.izin,absen.id_petugas,absen.id_jabatan from absen inner join akunpetugas on absen.id_absen = akunpetugas.id_petugas inner join jabatan on absen.id_jabatan = jabatan.id_jabatan where id_absen='$id_absen';");
	if($dataabsen=getDataAbsen($id_absen)){// cari data akun ubisoft, kalau ada simpan di $data
		?>
<a href="absen.php"><button>View Absen Petugas</button></a>
<form method="post" name="frm" action="absen-update.php">
<table border="1">
<tr><td>Id Absen</td>
    <td><input type="text" name="id_absen" size="20" maxlength="20"
	     value="<?php echo $dataabsen["id_absen"];?>" readonly></td></tr>
<tr><td>Alfa</td>
    <td><input type="number" name="alfa" size="50" maxlength="200"
		 value="<?php echo $dataabsen["alfa"];?>"></td></tr>
<tr><td>Sakit</td>
	<td><input type="number" name="sakit" size="50" maxlength="200"
		 value="<?php echo $dataabsen["sakit"];?>"></td></tr>
<tr><td>Izin</td>
	<td><input type="number" name="izin" size="50" maxlength="200"
		 value="<?php echo $dataabsen["izin"];?>"></td></tr>
<tr><td>Id Petugas</td>
	<td><input type="text" name="id_petugas" size="50" maxlength="200"
		 value="<?php echo $dataabsen["id_petugas"];?>" readonly></td></tr>
<tr><td>Id Jabatan</td>
	<td><input type="text" name="id_jabatan" size="50" maxlength="200"
		 value="<?php echo $dataabsen["id_jabatan"];?>" readonly></td></tr>	 
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblUpdate" value="Update">
	    <input type="reset"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "<div style='color: white'>Profile dengan Id : $id_absen tidak ada. Pengeditan dibatalkan </div>";
?>
<?php
}
else
	echo "<div style='color: white'> IdAbsen tidak ada. Pengeditan dibatalkan. </div>";
?>
</body>
</html>