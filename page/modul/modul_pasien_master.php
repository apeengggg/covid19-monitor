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
    case 'ubah':
        include 'layout/header.php';
        include 'layout/sidebar.php';

        // ubah
        if (isset($_POST['ubahpasien'])) {
            if ($_POST > 0) {
                EditPasien($_POST);
            }
        }

        // get kode pasien form url
        $kode = $_GET['kd_pasien'];

        // search with kode pasiend
        $query = mysqli_query($koneksi, "SELECT * FROM master_pasien INNER JOIN master_jk ON master_pasien.kode_jk=master_jk.kode_jk WHERE kode_pasien='$kode'");
        $data = mysqli_fetch_array($query);
        ?>
        <main class="ms-sm-auto col-10 px-md-2">
    <form action="" method="post" id="addData">
        <div class="row">
            <div class="col-7">
                <fieldset class="border p-2 mt-3">
                    <h3>Ubah Data Pasien</h3>
                    <div class="mb-6 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?=$data['nama']?>">
                            <input type="hidden" class="form-control" id="kode_pasien" name="kode_pasien" value="<?=$data['kode_pasien']?>">
                        </div>
                    </div>
                    <div class="mt-2 row">
                        <label for="usia" class="col-sm-2 col-form-label">Usia</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control mb-2" id="usia" name="usia" min="1" value="<?=$data['usia']?>">
                        </div>
                    </div>
                    <div class="mt-1 row">
                        <label for="usia" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="kode_jk" id="kode_jk" class="form-control mb-2" required>
                                <option value="<?=$data['kode_jk']?>"><?=$data['jk']?></option>
                                <?php while ($jk = mysqli_fetch_array($jenis_kelamin)) {
                        ?>
                                <option value="<?=$jk['kode_jk']?>"><?=$jk['jk']?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="ubahpasien" id="ubahpasien" class="btn btn-md btn-dark">Ubah Data</button>
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
            $kode = $_GET['kd_pasien'];
            DeleteMasterPasien($kode);
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
                            <button type="submit" name="addpasien" id="addpasien" class="btn btn-md btn-dark">Tambah
                                Pasien</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
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
                    <a href="?module=master_pasien&action=ubah&kd_pasien=<?=$data['kode_pasien']?>">Edit</a>
                    <a href="?module=master_pasien&action=hapus&kd_pasien=<?=$data['kode_pasien']?>">Hapus</a>
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