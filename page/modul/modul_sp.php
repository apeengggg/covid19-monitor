<?php include '../config/function.php'; ?>
<?php $pasien = mysqli_query($koneksi, "SELECT * FROM master_status_pasien"); ?>

<?php
if (isset($_POST['add'])) {
    if ($_POST > 0) {
        addMasterStatusPasien($_POST);
    }
}
?>


<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
    case 'ubah':
        include 'layout/header.php';
        include 'layout/sidebar.php';

        // ubah
        if (isset($_POST['ubahstatus'])) {
            if ($_POST > 0) {
                EditMasterStatusPasien($_POST);
            }
        }

        // get kode pasien form url
        $kode = $_GET['kd_sp'];

        // search with kode pasiend
        $query = mysqli_query($koneksi, "SELECT * FROM master_status_pasien WHERE kode_status_pasien='$kode'");
        $data = mysqli_fetch_array($query);
        ?>
        <main class="ms-sm-auto col-10 px-md-2">
    <form action="" method="post" id="addData">
        <div class="row">
            <div class="col-7">
                <fieldset class="border p-2 mt-3">
                    <h3>Ubah Data Master Status Pasien</h3>
                    <div class="mb-6 row">
                        <label for="nama" class="col-sm-2 col-form-label">Status Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status_pasien" name="status_pasien" value="<?=$data['status_pasien']?>">
                            <input type="hidden" class="form-control" id="kode_status_pasien" name="kode_status_pasien" value="<?=$data['kode_status_pasien']?>">
                            <button type="submit" name="ubahstatus" id="ubahstatus" class="btn btn-md btn-dark mt-2">Ubah Data</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</main>
        <?php
        break;

        case 'hapus':
            $kode = $_GET['kd_sp'];
            DeleteMasterStatusPasien($kode);
        break;
    }
}else{
   include 'layout/header.php';
   include 'layout/sidebar.php';
   ?>
<main class="ms-sm-auto col-10 px-md-2">
    <form action="" method="post" id="addData">
        <div class="row">
            <div class="col-7">
                <fieldset class="border p-2 mt-3">
                    <h3>Tambah Data Master Status Pasien</h3>
                    <div class="mb-6 row">
                        <label for="nama" class="col-sm-2 col-form-label">Status Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status_pasien" name="status_pasien" required>
                            <button type="submit" name="add" id="add" class="btn btn-md btn-dark mt-2">Tambah Data Master Status Pasien</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
    <h3 class="mt-2">Data Master Status Pasien</h3>
    <table class="table table-bordered table-striped mt-2" id="tabel-data">
        <thead>
            <th>No</th>
            <th>Kode Status</th>
            <th>Status Pasien</th>
            <th>Aksi Pasien</th>
        </thead>
        <tbody>
            <?php 
            $no =1;
            while ($data=mysqli_fetch_array($pasien)) {
            ?>
            <tr>
                <td width="10%"><?=$no++?></td>
                <td width="40%"><?=$data['kode_status_pasien']?></td>
                <td width="40%"><?=$data['status_pasien']?></td>
                <td width="10%">
                    <a href="?module=master_status_pasien&action=ubah&kd_sp=<?=$data['kode_status_pasien']?>">Edit</a>
                    <a href="?module=master_status_pasien&action=hapus&kd_sp=<?=$data['kode_status_pasien']?>">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php
}
?>
<?php include 'layout/footer.php'; ?>