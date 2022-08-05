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
</style><title>Edit Data Akun Petugas</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>
<h1 style="color: white">Edit Data Akun Petugas</h1>
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
	echo "Session anda telah habis, silahkan login kembali.";
}
else
$sql=$db->query("select * from akunpetugas where id_petugas='$id_petugas'");
	if($dataakunpetugas=getDataAkunPetugas($id_petugas)){// cari data akun moonton, kalau ada simpan di $data
		?>
<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
<form method="post" name="frm" action="akunpetugas-update.php">
<table border="1">
<tr><td>Id Akun</td>
    <td><input type="text" name="id_petugas" size="15" maxlength="15"
	     value="<?php echo $dataakunpetugas["id_petugas"];?>" readonly></td></tr>
<tr><td>Nama Petugas</td>
    <td><input type="text" name="nama_petugas" size="100" maxlength="100"
		 value="<?php echo $dataakunpetugas["nama_petugas"];?>"></td></tr>
<tr><td>Email</td>
	<td><input type="text" name="email" size="100" maxlength="100"
		 value="<?php echo $dataakunpetugas["email"];?>"></td></tr>
<tr><td>Jenis Kelamin</td>
    <td><select name="jenis_kelamin">
		<option value ="<?php echo $dataakunpetugas["jenis_kelamin"];?>"><?php echo $dataakunpetugas["jenis_kelamin"];?>(Default)</option>
		<option value ="laki-laki">laki-laki</option>
		<option value ="perempuan">perempuan</option>
		<option value ="privasi">privasi</option>
		</select>
	</td></tr>
<tr><td>Tanggal Lahir</td>
	<td><input type="date" name="tanggal_lahir" size="20" maxlength="20"
		 value="<?php echo $dataakunpetugas["tanggal_lahir"];?>"></td></tr>
<tr><td>Password</td>
	<td><input type="password" name="password" size="41" maxlength="41"
		 value="<?php echo $dataakunpetugas["password"];?>"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblUpdate" value="Update">
	    <input type="reset"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "<div style='color: white'>Akun dengan Id : $id_akun tidak ada. Pengeditan dibatalkan</div>";
?>
<?php
}
else
	echo "<div style='color: white'>IdAkun tidak ada. Pengeditan dibatalkan.</div>";
?>
</body>
</html>