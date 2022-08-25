<?php
session_start();
include '../../koneksi/koneksi.php';

$nomor_suratkeluar	                = mysqli_real_escape_string($db, $_POST['nomor_suratkeluar']);
$tanggalkeluar_suratkeluar	        = mysqli_real_escape_string($db, $_POST['tanggalkeluar_suratkeluar']);
$nama_nip              				= mysqli_real_escape_string($db, $_POST['nama_nip']);
$sppd               				= mysqli_real_escape_string($db, $_POST['sppd']);
$no_berkas  	            		= mysqli_real_escape_string($db, $_POST['no_berkas']);
$tanggalsurat_suratkeluar           = mysqli_real_escape_string($db, $_POST['tanggalsurat_suratkeluar']);
$jenis_tugas			            = mysqli_real_escape_string($db, $_POST['jenis_tugas']);
$alamat  	            			= mysqli_real_escape_string($db, $_POST['alamat']);
$operator	                        = mysqli_real_escape_string($db, $_POST['operator']);
$inspektorat	                    = mysqli_real_escape_string($db, $_POST['inspektorat']);
$jenis	                       		= mysqli_real_escape_string($db, $_POST['jenis']);
$perangkat                      	= mysqli_real_escape_string($db, $_POST['perangkat']);
$ketuatim                      		= mysqli_real_escape_string($db, $_POST['ketuatim']);
$anggota1	                        = mysqli_real_escape_string($db, $_POST['anggota1']);
$anggota2	                        = mysqli_real_escape_string($db, $_POST['anggota2']);
$anggota3	                        = mysqli_real_escape_string($db, $_POST['anggota3']);
$anggota4	                        = mysqli_real_escape_string($db, $_POST['anggota4']);
$anggota5	                        = mysqli_real_escape_string($db, $_POST['anggota5']);
$anggota6	                        = mysqli_real_escape_string($db, $_POST['anggota6']);
$anggota7	                        = mysqli_real_escape_string($db, $_POST['anggota7']);
$anggota8	                        = mysqli_real_escape_string($db, $_POST['anggota8']);
$anggota9	                        = mysqli_real_escape_string($db, $_POST['anggota9']);
$anggota10	                        = mysqli_real_escape_string($db, $_POST['anggota10']);
date_default_timezone_set('Asia/Jakarta');
$tanggal_entry  = date("Y-m-d H:i:s");
$thnNow = date("Y");

$nama_file_lengkap 		= $_FILES['file_suratkeluar']['name'];
$nama_file 		= substr($nama_file_lengkap, 0, strripos($nama_file_lengkap, '.'));
$ext_file		= substr($nama_file_lengkap, strripos($nama_file_lengkap, '.'));
$tipe_file 		= $_FILES['file_suratkeluar']['type'];
$ukuran_file 	= $_FILES['file_suratkeluar']['size'];
$tmp_file 		= $_FILES['file_suratkeluar']['tmp_name'];

$tanggalkeluar_suratkeluar                = date('Y-m-d H:i:s', strtotime($tanggalkeluar_suratkeluar));
$tanggalsurat_suratkeluar                  = date('Y-m-d', strtotime($tanggalsurat_suratkeluar));
$ambilnomor                 = substr("$nomor_suratkeluar", 0, 4);

if (
	!($nomor_suratkeluar == '') and !($tanggalkeluar_suratkeluar  == '') and !($nama_nip  == '') and !($sppd   == '') and !($no_berkas   == '') and !($tanggalsurat_suratkeluar == '')   and !($jenis_tugas == '') and !($alamat == '') and !($operator == '') and !($tanggal_entry == '') and
	($tipe_file == "application/pdf") and ($ukuran_file <= 10340000)
) {

	$nama_baru = $thnNow . '-' . $ambilnomor . $ext_file;
	$path = "../surat_keluar/" . $nama_baru;
	move_uploaded_file($tmp_file, $path);

	$sql = "INSERT INTO tb_suratkeluar(nomor_suratkeluar, tanggalkeluar_suratkeluar, nama_nip, sppd, no_berkas, tanggalsurat_suratkeluar, jenis_tugas, alamat, operator, tanggal_entry, file_suratkeluar )
				values ('$nomor_suratkeluar', '$tanggalkeluar_suratkeluar', '$nama_nip', '$sppd', '$no_berkas', '$tanggalsurat_suratkeluar', '$jenis_tugas', '$alamat', '$operator', '$tanggal_entry', '$nama_baru')";
	$execute = mysqli_query($db, $sql);

	echo "<Center><h2><br>Terima Kasih<br>Surat Keluar Telah Dimasukkan</h2></center>
			<meta http-equiv='refresh' content='2;url=../datasuratkeluar.php'>";
} else {
	echo "<Center><h2>Silahkan isi semua kolom lalu tekan submit<br>Terima Kasih</h2></center>
			<meta http-equiv='refresh' content='2;url=../inputsuratkeluar.php'>";
}
