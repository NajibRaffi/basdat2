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
</style><title>Pengelolaan Data Absen</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Data Absen</h1>
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
	$sql = $db->query("select * from absen");
	$total = $db->query("select * from absen");
	$pages = ceil($total->num_rows/$halaman);
	$res=null;
    if (isset($_GET["cari-data"])) {
    $cari = isset($_GET["cari-data"]) ? (string) $_GET["cari-data"] : "";	
	$res =cariabsen($cari,$mulai);
	$pageCari = ceil($res->num_rows / $halaman);
    $pages = ($pageCari >= 1) ? $pageCari : $pages;
	}else 
	{
    $sql1 ="SELECT * from absen limit $mulai,$halaman";
	$res=$db->query($sql1);
	}	
	if($res!=null){
		?>
		<a href="absen-tambah.php"><button>Tambah</button></a>
		<table border="1">
		<tr><th>Id Absen</th><th>Alfa</th><th>Sakit</th>
		    <th>Izin</th><th>Id Petugas</th><th>Id Jabatan</th>
			</tr>
		<?php
		$data=$res->fetch_row();
		do{
		list($id_absen,$alfa,$sakit,$izin,$id_petugas,$id_jabatan) =$data;
			?>
			<tr>
			<td><?php echo $id_absen;?></td>
			<td><?php echo $alfa;?></td>
			<td><?php echo $sakit;?></td>
			<td><?php echo $izin;?></td>
			<td><?php echo $id_petugas;?></td>
			<td><?php echo $id_jabatan;?></td>
			<td><a href="absen-form-edit.php?id_absen=<?php			
			echo urlencode(openssl_encrypt($id_absen,
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );?>"><button>Edit</button></a> | 
			<a href="absen-konfirmasi-hapus.php?id_absen=<?php			
			echo urlencode(openssl_encrypt($id_absen,
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