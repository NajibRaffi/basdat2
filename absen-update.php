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
</style><title>Pembaruan Data Absen</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Pembaruan Data Absen</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$IdAbsen	   =$db->escape_string($_POST["id_absen"]);
		$Alfa	   =$db->escape_string($_POST["alfa"]);
		$Sakit		=$db->escape_string($_POST["sakit"]);
		$Izin	   =$db->escape_string($_POST["izin"]);
		// Susun query update
		$sql="UPDATE absen SET alfa='$Alfa',sakit='$Sakit',izin='$Izin'
			  WHERE id_absen='$IdAbsen'";
		// Eksekusi query update
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada update data
				?>
				<div style="color: white">Data berhasil diupdate.<br></div>
				<a href="absen.php"><button>View Absen</button></a>
				<?php
			}
			else{ // Jika sql sukses tapi tidak ada data yang berubah
				?>
				<div style="color: white">Data berhasil diupdate tetapi tanpa ada perubahan data.<br> </div>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="absen.php"><button>View absen</button></a>
				<?php
			}
		}
		else{ // gagal query
			?>
			 <div style="color: white"> Data gagal diupdate.</div>
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