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
</style><title>Penyimpanan Data Akun Petugas</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Penyimpanan Data Akun Petugas</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$IdPetugas  =$db->escape_string($_POST["id_petugas"]);
		$NamaPetugas	   =$db->escape_string($_POST["nama_petugas"]);
		$Email		=$db->escape_string($_POST["email"]);
		$JenisKelamin=$db->escape_string($_POST["jenis_kelamin"]);
		$TanggalLahir	   =$db->escape_string($_POST["tanggal_lahir"]);
		$Password =md5($_POST["password"]);
		// Susun query insert
		$sql="INSERT INTO akunpetugas(id_petugas,nama_petugas,email,jenis_kelamin,tanggal_lahir,password)
			  VALUES('$IdPetugas','$NamaPetugas','$Email','$JenisKelamin','$TanggalLahir','$Password')";
		// Eksekusi query insert
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada penambahan data
				?>
				<div style="color: white">Data berhasil disimpan.</div><br>
				<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
				<?php
			}
		}
		else{
			?>
			<div style="color: white">Data gagal disimpan karena adanya kesalahan dalam memasukan data. Silahkan Cek Kembali</div><br>
			<a href="javascript:history.back()"><button>Kembali</button></a>
			<?php
		}
	}
	else
		echo "<div style='color: white'>Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br></div>";
}
?>
</body>
</html>