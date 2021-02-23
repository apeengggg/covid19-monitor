<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_monitoring_covid19');
date_default_timezone_set('Asia/Jakarta');
session_start();

function addPasien($data){
    global $koneksi;

    // get max kode pasien
    $max_kode = mysqli_query($koneksi, "SELECT max(kode_pasien) AS max_kode FROM master_pasien") or die (mysqli_error($koneksi));
    $result_max_kode = mysqli_fetch_array($max_kode);
    // split kode pasien to number of kode pasien
    $add_new = (int) substr($result_max_kode['max_kode'], 3,6);
    $add_new++;
    // initialize kode
    $kode = 'No_';
    // create new kode pasien
    $kode_pasien = $kode.sprintf("%03s", $add_new);

    // get pasien data
    $nama           = htmlspecialchars($_POST['nama_pasien']);
    $jk             = htmlspecialchars($_POST['kode_jk']);
    $tl             = htmlspecialchars($_POST['tanggal_lahir']);
    $status_pasien  = htmlspecialchart($_POST['status_pasien']);

    // insert to db master_pasien
    $sql1 = mysqli_query($koneksi, "INSERT INTO master_pasien (kode_pasien, nama, kode_jk, 
                                        tanggal_lahir) VALUES 
                                        ('$kode_pasien', '$nama', '$jk', '$tl')");
    // insert to db tb_status_pasien
    $sql2 = mysqli_query($koneksi, "INSERT INTO tb_status_pasien (kode_pasien, kode_status_pasien) 
                                        VALUES ('$kode_pasien', '$status_pasien')");

    if ($sql1 AND $sql2) {
        // berhasil isnert
    }else{
        // gagal insert
    }
}

function editPasien($data){
    global $koneksi;

    $nama           = htmlspecialchars($_POST['nama']);
    $tl             = htmlspecialchars($_POST['tanggal_lahir']);
    $kode           = htmlspecialchars($_POST['kode_pasien']);
    $jk             = htmlspecialchars($_POST['jenis_kelamin']);
    $status_pasien  = htmlspecialchars($_POST['status_pasien']);

    // update master pasien
    $sql1 = mysqli_query($koneksi, "UPDATE master_pasien SET nama='$nama', tanggal_lahir='$tl',
                                    kode_jk='$jk' WHERE kode_pasien='$kode'");
    // update tb_status_pasien
    $sql2 = mysqli_query($koneksi, "UPDATE tb_status_pasien SET kode_status_pasien='$status_pasien'
                                    WHERE kode_pasien='$kode'");
}

function login($data){
    global $koneksi;
    // get data login from form
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $hash = sha1($password);

    // check are data exist?
    $check = mysqli_query($koneksi, "SELECT * FROM tb_user tu INNER JOIN master_status_user msu ON tu.kode_su=msu.kode_su WHERE tu.username='$username' AND tu.password='$hash'");
    $data = mysqli_fetch_array($check);
    // if exist go to dashboard
    if (mysqli_num_rows($check)>0) {
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['status_user'] = $data['status_user'];
       header('location: dashboard.php');
    // if no, go to login page again
    }else{
        header('location: index.php');
    }
}



function usia($data){
    global $koneksi;
    // get date today
    $today = new DateTime('today');
    // get diff of today-tanggal lahir
    $usia = $today->diff($data)->y;
    // get usia
    $usia = $usia.' thn';
}




?>