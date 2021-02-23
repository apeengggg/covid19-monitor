<?php include '../config/function.php'; ?>
<?php $pasien = mysqli_query($koneksi, "SELECT * FROM master_pasien mp INNER JOIN master_jk mj ON mp.kode_jk=mj.kode_jk"); ?>

<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
    case 'tambah':
        echo 'tambah';
        break;

    case 'ubah':
        echo 'ubah';
        break;

        case 'cari':
            echo 'cari';
        break;
    }
}else{
   include 'layout/header.php';
   include 'layout/sidebar.php';
   ?>

<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">
    <div class="table-responsive">
    <a href="?module=master_pasien&action=tambah" class="btn btn-primary mt-3">Tambah</a>
    <h3 class="mt-2">Data Master Pasien</h3>
    <table class="table table-bordered table-striped" id="example2">
        <thead>
            <th>Kode Pasien</th>
            <th>Nama Pasien</th>
            <th>Usia</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </thead>
        <tbody>
        <?php while ($data=mysqli_fetch_array($pasien)) {
            ?>
            <tr>
                <td><?=$data['kode_pasien']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['usia']?></td>
                <td><?=$data['jk']?></td>
                <td>
                    <a href="?module=master_pasien&action=ubah">Edit</a>
                    <a href="?module=master_pasien&action=hapus">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
    </div>
</main>
<?php
}
?>
<?php include 'layout/footer.php'; ?>
