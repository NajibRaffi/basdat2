<?php
	session_start();
	if(!isset($_SESSION["id_petugas"])){
		header("Location: index.php?error=4");
	}
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
</style><title>View Data Absen</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Tambah Data Absen</h1>
<a href="absen.php"><button>View Absen</button></a>
<form method="post" name="frm" action="absen-simpan.php">
<table border="1">
<tr><td>Id Absen</td>
    <td><input type="text" name="id_absen" size="20" maxlength="20"></td></tr>
<tr><td>Alfa</td>
    <td><input type="number" name="alfa" size="50" maxlength="200"></td></tr>
<tr><td>Sakit</td>
	<td><input type="number" name="sakit" size="50" maxlength="200"></td></tr>
<tr><td>Izin</td>
	<td><input type="number" name="izin" size="50" maxlength="200"></td></tr>
	<tr><td>Id Petugas</td>
	<td><select type="text" name="id_petugas">
	<?php
	$db  = dbConnect();
	$sql = "Select id_petugas from akunpetugas";
	$res = $db->query($sql);
	$row = $res->fetch_row();
	do{
		list($id_petugas)=$row;?>
		<option value ="<?php echo $id_petugas ?>"><?php echo $id_petugas ?></option>
	<?php
	}while($row=$res->fetch_row());
	?>
	</select></td></tr>
<tr><td>Id Jabatan</td>
	<td><select type="text" name="id_jabatan">
	<?php
	$db  = dbConnect();
	$sql = "Select id_jabatan from jabatan";
	$res = $db->query($sql);
	$row = $res->fetch_row();
	do{
		list($id_jabatan)=$row;?>
		<option value ="<?php echo $id_jabatan ?>"><?php echo $id_jabatan ?></option>
	<?php
	}while($row=$res->fetch_row());
	?>
	</select></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblSimpan" value="Simpan"></td></tr>
</table>
</form>
</body>
</html>