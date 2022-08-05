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
</style><title>Pengelolaan Jabatan</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Data Jabatan</h1>
<form action='?cari' method='get'>
<input type='text' name='cari-data'/>
<button type='submit'>CARI</button>
</form>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	$halaman = 10; //batasan halaman
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
	$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
	$sql = $db->query("select * from jabatan");
	$total = $db->query("select * from jabatan");
	$pages = ceil($total->num_rows/$halaman);
	$res=null;
	if (isset($_GET["cari-data"])) {
    $cari = isset($_GET["cari-data"]) ? (string) $_GET["cari-data"] : "";	
	$res =carijabatan($cari,$mulai);
	$pageCari = ceil($res->num_rows / $halaman);
    $pages = ($pages >= 1) ? $pageCari : $pages;
	}else 
	{
    $sql1 ="SELECT * from jabatan limit $mulai,$halaman";
	$res=$db->query($sql1);
	}	
	if($res!=null){
		?>
		<a href="jabatan-tambah.php"><button>Tambah</button></a>
		<table border="1">
		<tr><th>Id Jabatan</th><th>Jabatan</th>
		    <th>Mulai Menjabat</th><th>Akhir Menjabat</th>
			</tr>
		<?php
		$data=$res->fetch_row();
		do{
		list($id_jabatan,$nama_jabatan,$mulai_jabat,$akhir_jabat) =$data;
			?>
			<tr>
			<td><?php echo $id_jabatan;?></td>
			<td><?php echo $nama_jabatan;?></td>
			<td><?php echo $mulai_jabat;?></td>
			<td><?php echo $akhir_jabat;?></td>
			<td><a href="jabatan-form-edit.php?id_jabatan=<?php	
			echo urlencode(openssl_encrypt($id_jabatan,
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );?>"><button>Edit</button></a> | 
			<a href="jabatan-konfirmasi-hapus.php?id_jabatan=<?php			
			echo urlencode(openssl_encrypt($id_jabatan,
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );?>"><button>Hapus</button></a></td>
			</tr>
			<?php
		}while($data=$res->fetch_row());
		?>
		</table>
		<?php for ($i=1; $i<=$pages ; $i++){ ?>
		<a  href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>

		<?php } 

		?>
		<?php
		$res->free();
	}else
		echo "<div style='color: white'>Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br></div>";
}
else
	echo "<div style='color: white'>Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br></div>";
?>
</body>
</html>
</body>
</html>
</body>
</html>