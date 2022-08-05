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
</style><title>Pengelolaan Data Akun Petugas</title></head>
<body background="badut.jpg">
<?php banner();?>
<?php navigator();?>

<h1 style="color: white">Data Akun Petugas</h1>
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
	$sql = $db->query("select * from akunpetugas");
	$total = $db->query("select * from akunpetugas");
	$pages = ceil($total->num_rows/$halaman);
	$res=null;	
	if (isset($_GET["cari-data"])) {
    $cari = isset($_GET["cari-data"]) ? (string) $_GET["cari-data"] : "";	
	$res =cariakun($cari,$mulai);
	$pageCari = ceil($res->num_rows / $halaman);
    $pages = ($pageCari >= 1) ? $pageCari : $pages;
	}else 
	{
    $sql1 ="SELECT * from akunpetugas limit $mulai,$halaman";
	$res=$db->query($sql1);
	}	
	if($res!= null){
		?>
		<a href="akunpetugas-tambah.php"><button>Tambah</button></a>
		<table border="1">
		<tr><th>Id Petugas</th><th>Nama Petugas</th><th>Email</th>
		    <th>Jenis Kelamin</th><th>Tanggal Lahir</th><th>Aksi</th>
			</tr>
		<?php		
		$data=$res->fetch_row();
		do{
		list($id_petugas,$nama_petugas,$email,$jenis_kelamin,$tanggal_lahir) =$data;	
			?>
			<tr>
			<td><?php echo $id_petugas;?></td>
			<td><?php echo $nama_petugas;?></td>
			<td><?php echo $email;?></td>
			<td><?php echo $jenis_kelamin;?></td>
			<td><?php echo $tanggal_lahir;?></td>
			<td><a href="akunpetugas-form-edit.php?id_petugas=<?php			
			echo urlencode(openssl_encrypt($id_petugas,
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );?>"><button>Edit</button></a> | 
			<a href="akunpetugas-konfirmasi-hapus.php?id_petugas=<?php 
			echo urlencode(openssl_encrypt($id_petugas,
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
		<?php echo $db->error; ?>
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