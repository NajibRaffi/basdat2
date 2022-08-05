<?php
	session_start();
	if(!isset($_SESSION["id_petugas"]))
		header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html>
<head>
<<link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/690968474209615962/1004277406254764072/cropped-logo-kominfo.png" />
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
if(isset($_POST["TblHapus"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		$id_petugas =$db->escape_string($_POST["id_petugas"]);
		// Susun query delete
		$sql="DELETE FROM akunpetugas WHERE id_petugas='$id_petugas'";
		// Eksekusi query delete
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0) // jika ada data terhapus
				echo "<div style='color: white'>Data berhasil dihapus.<br></div>";
			else // Jika sql sukses tapi tidak ada data yang dihapus
				echo "<div style='color: white'>Penghapusan gagal karena data yang dihapus tidak ada.<br></div>";
		}
		else{ // gagal query
			echo "<div style='color: white'>Data gagal dihapus. <br></div>";
		}
		?>
		<a href="akunpetugas.php"><button>View Akun Petugas</button></a>
		<?php
	}
	else
		echo "<div style='color: white'>Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br></div>";
}
?>
</body>
</html>