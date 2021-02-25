<?php
error_reporting(0);
$koneksi = mysqli_connect('localhost', 'root', '', 'db_monitoring_covid19');
date_default_timezone_set('Asia/Jakarta');
session_start();

function searchDataPasien($data){
    $cond = "";
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if (!isset($_GET['usia'])) {
                if (!isset($_GET['tgl']) AND (!isset($_GET['tgl_awal']) AND (!isset($_GET['tgl_akhir'])))) {
                    $cond .= 'kode_status_pasien='."'".$status."'".' ';
                }else{
                    $cond .= 'kode_status_pasien='."'".$status."'".' OR ';
                }
            }else{
                $cond .= 'kode_status_pasien='."'".$status."'".' OR ';
            }
            }else{
                $cond .= ' ';
            }
            if (isset($_GET['usia'])) {
                $usia = $_GET['usia'];
                    if (!isset($_GET['tgl']) AND (!isset($_GET['tgl_awal']) AND (!isset($_GET['tgl_akhir'])))) {
                        $cond .= 'usia='."'".$usia."'".' ';
                    }else{
                        $cond .= 'usia='."'".$usia."'".' OR ';
                    }
            }else{
            }
            if (isset($_GET['tgl'])) {
                $tgl = $_GET['tgl'];
                $cond .= 'tgl_input='."'".$tgl."'".' ';
            }else{
            }
            if (isset($_GET['tgl_awal']) AND isset($_GET['tgl_akhir'])) {
                $begin = $_GET['tgl_awal'];
                $end = $_GET['tgl_akhir'];
                $cond .= 'tgl_input BETWEEN '.$begin.' AND '.$end;
            }else{
            }

            if (!isset($_GET['status']) AND !isset($_GET['usia']) AND !isset($_GET['tgl']) AND !isset($_GET['tgl_awal']) AND !isset($_GET['tgl_akhir'])) {
                $query = "SELECT * FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien";
            }else{
                $query = "SELECT * FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE ".$cond;
            }
            return $query;
}


function editUser($data){
    global $koneksi;

    $nama = htmlspecialchars($_POST['nama_user']);
    $kode_status = htmlspecialchars($_POST['kode_su']);
    $kode_user = htmlspecialchars($_POST['kode_user']);
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $pwd = sha1($password);
        $update = mysqli_query($koneksi, "UPDATE tb_user SET nama_user='$nama', kode_su='$kode_status', password='$pwd' WHERE kode_user='$kode_user'");
    }else{
        $update = mysqli_query($koneksi, "UPDATE tb_user SET nama_user='$nama', kode_su='$kode_status' WHERE kode_user='$kode_user'");
    }
    if ($update) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Mengubah Data User, Dengan Kode User: <?=$kode_user?>");
			window.location="pagging.php?module=user";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Mengubah Data User, Dengan Kode User: <?=$kode_user?>");
			window.location="pagging.php?module=user&action=ubah&kd_user=<?=$kode_user?>";
		</script>
        <?php
    }
    
    



}

function addUser($data){
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama_user']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $kode_status = htmlspecialchars($_POST['kode_su']);
    // echo $kode_status; die;
    $pwd = sha1($password);

    // get max kode pasien
    $max_kode       = mysqli_query($koneksi, "SELECT max(kode_user) AS max_kode FROM tb_user") or die (mysqli_error($koneksi));
    $result_max_kode= mysqli_fetch_array($max_kode);
    // split kode pasien to number of kode pasien
    $add_new        = (int) substr($result_max_kode['max_kode'], 2,5);
    $add_new++;
    // initialize kode
    $kode           = 'US';
    // create new kode pasien
    $kode_pasien    = $kode.sprintf("%03s", $add_new);

    // cek
    $query1 = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
    // die;
    if (mysqli_num_rows($query1)>0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data User, Dengan Username: <?=$username?>, Username Sudah Terdaftar");
			window.location="pagging.php?module=user";
		</script>
        <?php
    }else{
        // insert
    $query2 = mysqli_query($koneksi, "INSERT INTO tb_user (kode_user, nama_user, username, password, kode_su) VALUES('$kode_pasien','$nama', '$username', '$pwd', '$kode_status')");
    if ($query2) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Menambahkan Data User, Dengan Username: <?=$username?>");
			window.location="pagging.php?module=user";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data User, Dengan Username: <?=$username?>");
			window.location="pagging.php?module=user";
		</script>
        <?php
    }
    }
}


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

function EditJK($data){
    global $koneksi;

    $jk             = htmlspecialchars($_POST['jk']);
    $kode           = htmlspecialchars($_POST['kode_jk']);

    // update master pasien
    $query = mysqli_query($koneksi, "UPDATE master_jk SET jk='$jk' WHERE kode_jk='$kode'");
    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Mengubah Data Jenis Kelamin : <?=$jk?>");
			window.location="pagging.php?module=master_jk";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Mengubah Data Jenis Kelamin: <?=$kode?>");
			window.location="pagging.php?module=master_jk&action=ubah&kd_jk=<?=$kode?>";
		</script>
        <?php
    }
}

function addMasterStatusPasien($data){
    global $koneksi;

    // get max kode pasien
    $max_kode       = mysqli_query($koneksi, "SELECT max(kode_status_pasien) AS max_kode FROM master_status_pasien") or die (mysqli_error($koneksi));
    $result_max_kode= mysqli_fetch_array($max_kode);
    // split kode pasien to number of kode pasien
    $add_new        = (int) substr($result_max_kode['max_kode'], 2,4);
    $add_new++;
    // initialize kode
    $kode           = 'SP';
    // create new kode pasien
    $kode_pasien    = $kode.sprintf("%03s", $add_new);

    // get data from form
    $status_pasien = htmlspecialchars($_POST['status_pasien']);

    // ck apakah sudah ada?
    $check = mysqli_query($koneksi, "SELECT status_pasien FROM master_status_pasien WHERE status_pasien='$status_pasien'");
    if (mysqli_num_rows($check)>0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Status Pasien: <?=$status_pasien?>, Terdapat Status Pasien Yang Sama!");
			window.location="pagging.php?module=master_status_pasien";
		</script>
        <?php
    }else{
        // insert
        $query = mysqli_query($koneksi, "INSERT INTO master_status_pasien (kode_status_pasien, status_pasien) VALUES ('$kode_pasien', '$status_pasien')");
        if ($query) {
            ?>
        <script type="text/javascript">
			window.alert("Berhasil Menambahkan Data Status Pasien: <?=$status_pasien?>");
			window.location="pagging.php?module=master_status_pasien";
		</script>
        <?php
        }else{
            ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Status Pasien: <?=$status_pasien?>");
			window.location="pagging.php?module=master_status_pasien";
		</script>
        <?php
        }
    }
}

function addMasterStatusUser($data){
    global $koneksi;

    // get max kode pasien
    $max_kode       = mysqli_query($koneksi, "SELECT max(kode_su) AS max_kode FROM master_status_user") or die (mysqli_error($koneksi));
    $result_max_kode= mysqli_fetch_array($max_kode);
    // split kode pasien to number of kode pasien
    $add_new        = (int) substr($result_max_kode['max_kode'], 2,4);
    $add_new++;
    // initialize kode
    $kode           = 'SU';
    // create new kode pasien
    $kode_pasien    = $kode.sprintf("%03s", $add_new);

    // get data from form
    $status_pasien = htmlspecialchars($_POST['status_user']);

    // ck apakah sudah ada?
    $check = mysqli_query($koneksi, "SELECT status_user FROM master_status_user WHERE status_user='$status_pasien'");
    if (mysqli_num_rows($check)>0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Status User: <?=$status_pasien?>, Terdapat Status User Yang Sama!");
			window.location="pagging.php?module=master_status_user";
		</script>
        <?php
    }else{
        // insert
        $query = mysqli_query($koneksi, "INSERT INTO master_status_user (kode_su, status_user) VALUES ('$kode_pasien', '$status_pasien')");
        if ($query) {
            ?>
        <script type="text/javascript">
			window.alert("Berhasil Menambahkan Data Status User: <?=$status_pasien?>");
			window.location="pagging.php?module=master_status_user";
		</script>
        <?php
        }else{
            ?>
        <script type="text/javascript">
			window.alert("Gagal Menambahkan Data Status Pasien: <?=$status_pasien?>");
			window.location="pagging.php?module=master_status_user";
		</script>
        <?php
        }
    }
}

function DeleteMasterStatusPasien($data){
    global $koneksi;

    // get kode pasien from url
    $kode = $data;
    
    // delete
    // cek dulu ada data yang terhubung ?
    $check = mysqli_query($koneksi, "SELECT * FROM tb_status_pasien WHERE kode_status_pasien='$kode'");
    if (mysqli_num_rows($check)>0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menghapus Data Master Status Pasien, Dengan No Status Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_status_pasien";
		</script>
        <?php
    }else{
    $query = mysqli_query($koneksi, "DELETE FROM master_status_pasien WHERE kode_status_pasien='$kode'");

    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Menghapus Data Master Status Pasien, Dengan No Kode Status Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_status_pasien";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menghapus Data Master Status Pasien, Dengan No Kode Status Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_pasien";
		</script>
        <?php
    }
    }
}

function DeleteMasterStatusUser($data){
    global $koneksi;

    // get kode pasien from url
    $kode = $data;
    
    // delete
    // cek dulu ada data yang terhubung ?
    $check = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE kode_su='$kode'");
    if (mysqli_num_rows($check)>0) {
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menghapus Data Master Status User, Dengan Kode Status User: <?=$kode?>");
			window.location="pagging.php?module=master_status_user";
		</script>
        <?php
    }else{
    $query = mysqli_query($koneksi, "DELETE FROM master_status_user WHERE kode_su='$kode'");

    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Menghapus Data Master Status User, Dengan No Kode Status User: <?=$kode?>");
			window.location="pagging.php?module=master_status_user";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menghapus Data Master Status user, Dengan No Kode Status user: <?=$kode?>");
			window.location="pagging.php?module=master_user";
		</script>
        <?php
    }
    }
}

function EditMasterStatusPasien($data){
    global $koneksi;

    $kode           = htmlspecialchars($_POST['kode_sp']);
    $status         = htmlspecialchars($_POST['status_pasien']);

    // update master pasien
    $query = mysqli_query($koneksi, "UPDATE master_status_pasien SET status_pasien='$status' WHERE kode_status_pasien='$kode'");
    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Mengubah Data Master Status Pasien, Dengan No Status Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_status_pasien";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Mengubah Data Master Status Pasien, Dengan No Status Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_status_pasien&action=ubah&kd_sp=<?=$kode?>";
		</script>
        <?php
    }
}

function EditMasterStatusUser($data){
    global $koneksi;

    $kode           = htmlspecialchars($_POST['kode_su']);
    $status         = htmlspecialchars($_POST['status_user']);

    // update master pasien
    $query = mysqli_query($koneksi, "UPDATE master_status_user SET status_user='$status' WHERE kode_su='$kode'");
    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Mengubah Data Master Status User, Dengan No Status User: <?=$kode?>");
			window.location="pagging.php?module=master_status_user";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Mengubah Data Master Status User, Dengan No Status User: <?=$kode?>");
			window.location="pagging.php?module=master_status_user&action=ubah&kd_sp=<?=$kode?>";
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


function editPasien($data){
    global $koneksi;

    $nama           = htmlspecialchars($_POST['nama']);
    $usia           = htmlspecialchars($_POST['usia']);
    $kode           = htmlspecialchars($_POST['kode_pasien']);
    $jk             = htmlspecialchars($_POST['kode_jk']);

    // update master pasien
    $query = mysqli_query($koneksi, "UPDATE master_pasien SET nama='$nama', usia='$usia',
                                    kode_jk='$jk' WHERE kode_pasien='$kode'");
    if ($query) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Mengubah Data Master Pasien, Dengan No Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_pasien";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Mengubah Data Master Pasien, Dengan No Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_pasien&action=ubah&kd_pasien=<?=$kode?>";
		</script>
        <?php
    }
}

function DeleteMasterPasien($data){
    global $koneksi;

    // get kode pasien from url
    $kode = $data;
    
    // delete
    $query = mysqli_query($koneksi, "DELETE FROM tb_status_pasien WHERE kode_pasien='$kode'");
    $query2 = mysqli_query($koneksi, "DELETE FROM master_pasien WHERE kode_pasien='$kode'");

    if ($query && $query2) {
        ?>
        <script type="text/javascript">
			window.alert("Berhasil Menghapus Data Master Pasien, Dengan No Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_pasien";
		</script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
			window.alert("Gagal Menghapus Data Master Pasien, Dengan No Pasien: <?=$kode?>");
			window.location="pagging.php?module=master_pasien";
		</script>
        <?php
    }
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
        $_SESSION['login'] = true;
        $_SESSION['level'] = $data['status_user'];
        $_SESSION['nama_user'] = $data['nama_user'];
        // echo $_SESSION['status_user']; die;
       header('location: pagging.php?module=dashboard');
    // if no, go to login page again
    }else{
        header('location: index.php');
    }
}
?>