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
</style><title>Hapus Data Akun Petugas</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Hapus Data Akun Petugas</h1>
<?php
$db=dbConnect();
if(isset($_GET["id_petugas"])){	
$id_petugas=(String)$_GET["id_petugas"];
$id_petugas=openssl_decrypt($id_petugas,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
if(!$id_petugas){ // jika $idakun kosong (karena gagal decrypt)
	echo "Session anda expire, silahkan login kembali.";
}
else
$sql=$db->query("select * from akunpetugas where id_petugas='$id_petugas'");
	if($dataakunpetugas=getDataAkunPetugas($id_petugas)){// cari data akun petugas, kalau ada simpan di $data
		?>
<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
<form method="post" name="frm" action="akunpetugas-hapus.php">
<input type="hidden" name="id_petugas" value="<?php echo $dataakunpetugas["id_petugas"];?>">
<table border="1">
<tr><td>Id Petugas</td><td><?php echo $dataakunpetugas["id_petugas"];?></td></tr>
<tr><td>Nama Petugas</td><td><?php echo $dataakunpetugas["nama_petugas"];?></td></tr>
<tr><td>Email</td><td><?php echo $dataakunpetugas["email"];?></td></tr>
<tr><td>Jenis Kelamin</td><td><?php echo $dataakunpetugas["jenis_kelamin"];?></td></tr>
<tr><td>Tanggal Lahir</td><td><?php echo $dataakunpetugas["tanggal_lahir"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "<div style='color: white'>Petugas dengan Id : $id_petugas tidak ada. Penghapusan dibatalkan </div>";
?>
<?php
}
else
	echo "<div style='color: white'> IdPetugas tidak ada. Penghapusan dibatalkan. </div>";
?>
</body>
</html>