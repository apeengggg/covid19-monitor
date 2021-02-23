<?php include '../config/function.php'; ?>
<?php $pasien = mysqli_query($koneksi, "SELECT * FROM master_pasien mp INNER JOIN master_jk mj ON mp.kode_jk=mj.kode_jk ORDER BY id_pasien DESC"); ?>
<?php $jenis_kelamin = mysqli_query($koneksi, "SELECT * FROM master_jk"); ?>

<?php
if (isset($_POST['addpasien'])) {
    if ($_POST > 0) {
        addPasien($_POST);
    }
}
?>


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
<main class="ms-sm-auto col-10 px-md-2">
    <h3 class="mt-2">Data Master Pasien</h3>
    <table class="table table-bordered table-striped mt-2" id="tabel-data">
        <thead>
            <th>No</th>
            <th>No Pasien</th>
            <th>Nama Pasien</th>
            <th>Usia</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php 
            $no =1;
            while ($data=mysqli_fetch_array($pasien)) {
            ?>
            <tr>
                <td width="5%"><?=$no++?></td>
                <td width="10%"><?=$data['kode_pasien']?></td>
                <td><?=$data['nama']?></td>
                <td width="10%"><?=$data['usia']?></td>
                <td width="10%"><?=$data['jk']?></td>
                <td width="10%">
                    <a href="?module=master_pasien&action=ubah">Edit</a>
                    <a href="?module=master_pasien&action=hapus">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<form action="" method="post">
    <div class="row">
        <div class="col-7">
        <fieldset class="border p-2">
                <h3>Tambah Data Pasien</h3>
            <div class="mb-6 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
                </div>
            </div>
            <div class="mt-2 row">
                <label for="usia" class="col-sm-2 col-form-label">Usia</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control mb-2" id="usia" name="usia" min="1" required>
                    <!-- <button type="submit" name="addpasien" id="addpasien" class="btn btn-md btn-dark">Tambah Pasien</button> -->
                </div>
            </div>
            <div class="mt-1 row">
                <label for="usia" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select name="kode_jk" id="kode_jk" class="form-control mb-2" required>
                        <option value="">Pilih Jenis Kelamin ..</option>
                        <?php while ($jk = mysqli_fetch_array($jenis_kelamin)) {
                        ?>
                        <option value="<?=$jk['kode_jk']?>"><?=$jk['jk']?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" name="addpasien" id="addpasien" class="btn btn-md btn-dark">Tambah Pasien</button>
                </div>
            </div>
        </fieldset>
        </div>
    </div>
</form>
</main>
<?php
}
?>
<?php include 'layout/footer.php'; ?>