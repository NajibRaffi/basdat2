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
</style><title>View Data Jabatan</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Tambah Data Jabatan</h1>
<a href="jabatan.php"><button>View Jabatan</button></a>
<form method="post" name="frm" action="jabatan-simpan.php">
<table border="1">
<tr><td>Id Jabatan</td>
    <td><input type="text" name="id_jabatan" size="20" maxlength="20"></td></tr>
<tr><td>Nama Jabatan</td>
	<td><input type="text" name="nama_jabatan" size="15" maxlength="15"></td></tr>
<tr><td>Mulai Menjabat</td>
	<td><input type="date" name="mulai_jabat" size="7"></td></tr>
<tr><td>Akhir Menjabat</td>
	<td><input type="date" name="akhir_jabat" size="7"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblSimpan" value="Simpan"></td></tr>
</table>
</form>
</body>
</html>