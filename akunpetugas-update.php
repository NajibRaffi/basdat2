<?php
	session_start();
	if(!isset($_SESSION["id_petugas"]))
		header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/690168942530002987/854245036488654858/unknown.png" />
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
</style><title>Pembaruan Data Akun Petugas</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Pembaruan Data Akun Petugas</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$IdPetugas  =$db->escape_string($_POST["id_petugas"]);
		$NamaPetugas	   =$db->escape_string($_POST["nama_petugas"]);
		$Email		=$db->escape_string($_POST["email"]);
		$JenisKelamin=$db->escape_string($_POST["jenis_kelamin"]);
		$TanggalLahir	   =$db->escape_string($_POST["tanggal_lahir"]);
		$Password =($_POST["password"]);
        // validasi password
		$Password =($_POST["password"]);
		$dataakunpetugas=getDataAkunPetugas($IdPetugas);
		if($Password == $dataakunpetugas["password"])
		{
		$Password=($_POST["password"]);
		}
		else
		{
		$Password=md5($_POST["password"]);
		}
		// Susun query update
		$sql="UPDATE akunpetugas SET 
			  id_petugas='$IdPetugas',nama_petugas='$NamaPetugas',email='$Email',
			  jenis_kelamin='$JenisKelamin',tanggal_lahir='$TanggalLahir',
			  password='$Password'
			  WHERE id_petugas='$IdPetugas'";
		// Eksekusi query update
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada update data
				?>
				<div style="color: white">Data berhasil diupdate.</div><br>
				<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
				<?php
			}
			else{ // Jika sql sukses tapi tidak ada data yang berubah
				?>
				<div style="color: white">Data berhasil diupdate tetapi tanpa ada perubahan data.</div><br>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
				<?php
			}
		}
		else{ // gagal query
			?>
			<div style="color: white">Data gagal diupdate.</div>
			<a href="javascript:history.back()"><button>Edit Kembali</button></a>
			<?php
		}
	}
	else
		echo "<div style='color: white'>Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br></div>";
}
?>
</body>
</html>