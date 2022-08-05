<?php
	session_start();
	if(!isset($_SESSION["id_petugas"]))
		header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><style>
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
</style><title>Pembaruan Data Jabatan</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Pembaruan Data Jabatan</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$IdJabatan  =$db->escape_string($_POST["id_jabatan"]);
		$NamaJabatan	=$db->escape_string($_POST["nama_jabatan"]);
		$MulaiJabat		=$db->escape_string($_POST["mulai_jabat"]);
		$AkhirJabat	   =$db->escape_string($_POST["akhir_jabat"]);
		// Susun query update
		$sql="UPDATE jabatan SET id_jabatan='$IdJabatan',
			  jabatan='$NamaJabatan',mulai_jabat='$MulaiJabat',akhir_jabat='$AkhirJabat'
			  WHERE id_jabatan='$IdJabatan'";
		// Eksekusi query update
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada update data
				?>
				<div style="color: white"> Data berhasil diupdate.<br> </div>
				<a href="jabatan.php"><button>View Jabatan</button></a>
				<?php
			}
			else{ // Jika sql sukses tapi tidak ada data yang berubah
				?>
				<div style="color: white"> Data berhasil diupdate tetapi tanpa ada perubahan data.<br> </div>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="jabatan.php"><button>View Jabatan</button></a>
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