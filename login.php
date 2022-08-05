<?php include_once("functions.php");?>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	if(isset($_POST["TblLogin"])){
		$id_akun=$db->escape_string($_POST["id_akun"]);
		$password=$db->escape_string($_POST["password"]);
		$sql="SELECT akunpetugas.id_petugas, akunpetugas.nama_petugas, akunpetugas.email, akunpetugas.jenis_kelamin, akunpetugas.tanggal_lahir FROM akunpetugas
			  WHERE akunpetugas.id_petugas='$id_akun' and akunpetugas.password='$password'";
			//   password=md5('$password')
		$res=$db->query($sql);
		if($res){
			if($res->num_rows==1){
				$data=$res->fetch_assoc();
				session_start();
				$_SESSION["id_petugas"]=$data["id_petugas"];
				$_SESSION["nama_petugas"]=$data["nama_petugas"];
				$_SESSION["email"]=$data["email"];
				$_SESSION["jenis_kelamin"]=$data["jenis_kelamin"];
				// tambahkan passphrase dan iv secara random
				$_SESSION["passphrase"]=openssl_random_pseudo_bytes(16);
				$_SESSION["iv"]=openssl_random_pseudo_bytes(16);
				header("Location: index-admin.php");
			}
			else
				header("Location: index.php?error=1");
		}
	}
	else
		header("Location: index.php?error=2");
}
else
	header("Location: index.php?error=3");
?>
<?php banner();?>
<?php navigator();?>

