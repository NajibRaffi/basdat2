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
</style><title>Penyimpanan Data Jabatan</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Penyimpanan Data Jabatan</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$IdJabatan  =$db->escape_string($_POST["id_jabatan"]);
		$NamaJabatan		=$db->escape_string($_POST["nama_jabatan"]);
		$MulaiJabat		=$db->escape_string($_POST["mulai_jabat"]);
		$AkhirJabat	   =$db->escape_string($_POST["akhir_jabat"]);
		// Susun query insert
		$sql="INSERT INTO jabatan(id_jabatan,jabatan,mulai_jabat,akhir_jabat) VALUES('$IdJabatan','$NamaJabatan','$MulaiJabat','$AkhirJabat')";
		// Eksekusi query insert
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada penambahan data
				?>
				<div style="color: white">Data berhasil disimpan.<br></div>
				<a href="jabatan.php"><button>View Jabatan</button></a>
				<?php
			}
		}
		else{
			?>
			<div style="color: white">Data gagal disimpan karena id jabatan tidak ada. Silahkan kembali ke jabatan lalu tekan tambah untuk menambahkan data<br></div>
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