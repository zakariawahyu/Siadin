<?php
	include 'database/koneksi.php';

  $nama = $_POST['namalengkap'];
  $genderguru = $_POST['gender'];
  $tgl = $_POST['tgllahir'];
	$date = date('dmy', strtotime($tgl));
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
  $repass = md5($_POST['repassword']);
	$address = $_POST['alamat'];

	$cekuser = mysqli_query($koneksi, "SELECT * FROM tbl_guru sw, tbl_user sr where sw.no_identitas = sr.no_identitas and username='$user'");

		if(mysqli_num_rows($cekuser) > 0) {
     echo '<script language="javascript">alert("Username Sudah Terdaftar ! "); document.location="register.php";</script>';
   } else {
     if(!$user || !$pass || !$nama || !$tgl || !$genderguru || !$address) {
       echo '<script language="javascript">alert("Masih Ada Data Yang Kosong !"); document.location="register.php";</script>';
     } else if ($pass == $repass) {

			 $guru  = mysqli_query($koneksi, "SELECT max(no_identitas) as NoIdentitas from tbl_guru");
			 $data = mysqli_fetch_array($guru);
			 $noIdentitas = $data['NoIdentitas'];
			 $noIden = (int) substr($noIdentitas, 8,2);
			 $noIden++;

			 $char = $date.'01';
			 $no = $char . sprintf("%02s", $noIden);

       $simpan = mysqli_query($koneksi, "INSERT INTO tbl_user VALUES('','$no','$user','$pass','guru')");

			 $save = mysqli_query($koneksi, "INSERT INTO tbl_guru VALUES('$no', '$nama', '$genderguru', '$address','$tgl') ");

       if($simpan && $save) {
         echo '<script language="javascript">alert("Pendaftaran Sukses, Silahkan Login ! "); document.location="index.php";</script>';
       } else {
         echo '<script language="javascript">alert("Pendaftaran Gagal ! "); document.location="register.php";</script>';
       }
     }
		 else {
		    echo '<script language="javascript">alert("Password tidak sama "); document.location="register.php";</script>';
		 }
   }
?>
