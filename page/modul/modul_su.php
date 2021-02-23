<?php include '../config/function.php'; ?>
<?php $pasien = mysqli_query($koneksi, "SELECT * FROM master_status_user"); ?>

<?php
if (isset($_POST['add'])) {
    if ($_POST > 0) {
        addMasterStatusUser($_POST);
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
                EditMasterStatusUser($_POST);
            }
        }

        // get kode pasien form url
        $kode = $_GET['kd_sp'];

        // search with kode pasiend
        $query = mysqli_query($koneksi, "SELECT * FROM master_status_user WHERE kode_su='$kode'");
        $data = mysqli_fetch_array($query);
        ?>
        <main class="ms-sm-auto col-10 px-md-2">
    <form action="" method="post" id="addData">
        <div class="row">
            <div class="col-7">
                <fieldset class="border p-2 mt-3">
                    <h3>Ubah Data Master Status User</h3>
                    <div class="mb-6 row">
                        <label for="nama" class="col-sm-2 col-form-label">Status User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status_user" name="status_user" value="<?=$data['status_user']?>">
                            <input type="hidden" class="form-control" id="kode_su" name="kode_su" value="<?=$data['kode_su']?>">
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
            DeleteMasterStatusUser($kode);
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
                    <h3>Tambah Data Master Status User</h3>
                    <div class="mb-6 row">
                        <label for="nama" class="col-sm-2 col-form-label">Status User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status_user" name="status_user" required>
                            <button type="submit" name="add" id="add" class="btn btn-md btn-dark mt-2">Tambah Data Master Status Pasien</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
    <h3 class="mt-2">Data Master Status User</h3>
    <table class="table table-bordered table-striped mt-2" id="tabel-data">
        <thead>
            <th>No</th>
            <th>Kode Status</th>
            <th>Status User</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php 
            $no =1;
            while ($data=mysqli_fetch_array($pasien)) {
            ?>
            <tr>
                <td width="10%"><?=$no++?></td>
                <td width="40%"><?=$data['kode_su']?></td>
                <td width="40%"><?=$data['status_user']?></td>
                <td width="10%">
                    <a href="?module=master_status_user&action=ubah&kd_sp=<?=$data['kode_su']?>">Edit</a>
                    <a href="?module=master_status_user&action=hapus&kd_sp=<?=$data['kode_su']?>">Hapus</a>
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