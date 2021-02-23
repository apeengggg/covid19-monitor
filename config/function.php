<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_monitoring_covid19');
date_default_timezone_set('Asia/Jakarta');

function addPasien($data){
    global $koneksi;
    // get max kode pasien
    $max_kode       = mysqli_query($koneksi, "SELECT max(kode_pasien) AS max_kode FROM master_pasien") or die (mysqli_error($koneksi));
    $result_max_kode= mysqli_fetch_array($max_kode);
    // split kode pasien to number of kode pasien
    $add_new        = (int) substr($result_max_kode['max_kode'], 3,6);
    $add_new++;
    // initialize kode
    $kode           = 'NO_';
    // create new kode pasien
    $kode_pasien    = $kode.sprintf("%04s", $add_new);

    // get pasien data
    $nama           = htmlspecialchars($_POST['nama_pasien']);
    $jk             = htmlspecialchars($_POST['kode_jk']);
    $usia           = htmlspecialchars($_POST['usia']);

    // check usia
    if ($usia < 0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Pasien, Dengan Nama: <?=$nama?>, Usia Tidak Boleh Negatif!");
			window.location="pagging.php?module=pasien&kd_pasien=<?=$kd_pasien?>&age=<?=$age?>";
		</script>
        <?php
        die;
    }

    // insert to db master_pasien
    $query          = mysqli_query($koneksi, "INSERT INTO master_pasien (kode_pasien, nama, kode_jk, 
                                        usia) VALUES 
                                        ('$kode_pasien', '$nama', '$jk', '$usia')");

    // get new data after insert to add new data status_pasien
    $id_pasien      = mysqli_insert_id($koneksi);
    $query1         = mysqli_query($koneksi, "SELECT kode_pasien, usia FROM master_pasien WHERE id_pasien='$id_pasien'");
    $result         = mysqli_fetch_array($query1);
    $kd_pasien      = $result['kode_pasien'];
    $age            = $result['usia'];

    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Menambahkan Data Pasien, Dengan Nama: <?=$nama?>");
			window.location="pagging.php?module=pasien&kd_pasien=<?=$kd_pasien?>&age=<?=$age?>";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
         window.alert('Gagal Menambahkan Data Pasien!')
        </script>
        <?php
    }
}

function addStatusPasien($data){
    global $koneksi;
    
    // get data from form
    $kode_pasien    = htmlspecialchars($_POST['kode_pasien']);
    $kode_status    = htmlspecialchars($_POST['kode_status']);
    $age            = htmlspecialchars($_POST['usia']);
    
    // check are kode_pasien is exist in tb_status_pasien
    $check = mysqli_query($koneksi, "SELECT * FROM tb_status_pasien WHERE kode_pasien='$kode_pasien'");
    if (mysqli_num_rows($check)>0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Status Pasien, Dengan No Pasien: <?=$kode_pasien?>, Terdapat No Pasien Yang Sama!");
			window.location="pagging.php?module=pasien";
		</script>
        <?php
        die;
    }

    // insert to tb_status_pasien
    $query = mysqli_query($koneksi, "INSERT INTO tb_status_pasien (kode_pasien, kode_status_pasien) VALUES ('$kode_pasien', '$kode_status')");

    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Menambahkan Data Status Pasien, Dengan No Pasien: <?=$kode_pasien?>");
			window.location="pagging.php?module=pasien";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Status Pasien, Dengan No Pasien: <?=$kode_pasien?>");
			window.location="pagging.php?module=pasien&kd_pasien=<?=$kode_pasien?>&age=<?=$age?>";
		</script>
        <?php
    }
}

// function editPasien($data){
//     global $koneksi;

//     $nama           = htmlspecialchars($_POST['nama']);
//     $tl             = htmlspecialchars($_POST['tanggal_lahir']);
//     $kode           = htmlspecialchars($_POST['kode_pasien']);
//     $jk             = htmlspecialchars($_POST['jenis_kelamin']);
//     $status_pasien  = htmlspecialchars($_POST['status_pasien']);

//     // update master pasien
//     $sql1 = mysqli_query($koneksi, "UPDATE master_pasien SET nama='$nama', tanggal_lahir='$tl',
//                                     kode_jk='$jk' WHERE kode_pasien='$kode'");
//     // update tb_status_pasien
//     $sql2 = mysqli_query($koneksi, "UPDATE tb_status_pasien SET kode_status_pasien='$status_pasien'
//                                     WHERE kode_pasien='$kode'");
// }

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
       header('location: pagging.php?module=dashboard');
    // if no, go to login page again
    }else{
        header('location: index.php');
    }
}

function getPasienMaster(){
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM master_pasien mp INNER JOIN master_jk mj ON mp.kode_jk=mj.kode_jk");
    $result = mysqli_fetch_assoc($query);
}





?>