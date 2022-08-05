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
</style><title>View Data Akun Petugas</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Tambah Data Akun Petugas</h1>
<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
<form method="post" name="frm" action="akunpetugas-simpan.php">
<table border="1">
<tr><td>Id Petugas</td>
    <td><input type="text" name="id_petugas" size="15" maxlength="15"></td></tr>
<tr><td>Nama Petugas</td>
    <td><input type="text" name="nama_petugas" size="100" maxlength="100"></td></tr>
<tr><td>Email</td>
	<td><input type="text" name="email" size="100" maxlength="100"></td></tr>
<tr><td>Jenis Kelamin</td>
    <td><select name="jenis_kelamin">
		<option>Pilih Jenis Kelamin</option>
		<option value ="laki-laki">laki-laki</option>
		<option value ="perempuan">perempuan</option>
		<option value ="privasi">privasi</option>
		</select>
	</td></tr>
<tr><td>Tanggal Lahir</td>
	<td><input type="date" name="tanggal_lahir" size="20" maxlength="20"></td></tr>
<tr><td>Password</td>
	<td><input type="password" name="password" size="41" maxlength="41"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblSimpan" value="Simpan"></td></tr>
</table>
</form>
</body>
</html>