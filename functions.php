<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
	$db=new mysqli("localhost:3306","root","","kel-1 if6_if-6_kepegawaian");// Sesuaikan dengan konfigurasi server anda.
	return $db;
}

function getDataAkunPetugas($id_petugas){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * from akunpetugas where id_petugas='$id_petugas'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataAbsen($id_absen){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("select absen.id_absen,absen.alfa,absen.sakit,absen.izin, akunpetugas.id_petugas, jabatan.id_jabatan from absen inner join akunpetugas on absen.id_petugas = akunpetugas.id_petugas inner join jabatan on absen.id_jabatan = jabatan.id_jabatan where id_absen='$id_absen';");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataJabatan($id_jabatan){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("select jabatan.id_jabatan,jabatan.jabatan,jabatan.mulai_jabat,jabatan.akhir_jabat from jabatan where id_jabatan='$id_jabatan';");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function cariakun($cari,$mulai){
	$db=dbConnect();
	$sql = "select * from akunpetugas where nama_petugas LIKE '%$cari%' limit $mulai,10";
	$res=$db->query($sql);
	return $res;
}

function carijabatan($cari,$mulai){
	$db=dbConnect();
	$sql = "select * from jabatan where nama_jabatan LIKE '%$cari%' limit $mulai,10";
	$res=$db->query($sql);
	return $res;
}

function cariabsen($cari,$mulai){
	$db=dbConnect();
	$sql = "select * from absen where alfa LIKE '%$cari%' OR sakit LIKE '%$cari%' OR izin LIKE '%$cari%' limit $mulai,10";
	$res=$db->query($sql);
	return $res;
}

function banner(){
	?>
<div id="banner"><h1 style="color: white">Data Petugas KominClown</h1>
</div>
	<?php
}
function navigator(){
	?>
<div id="navigator">
| <a href="akunpetugas.php">Akun Petugas</a> 
| <a href="absen.php">Absen Petugas</a> 
| <a href="jabatan.php">Jabatan</a> 
| <a href="logout.php">LogOut</a>
| 
</div>
	<?php
}
function showError($message){
	?>
<div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
<?php echo $message;?>
</div>
	<?php
}
?>