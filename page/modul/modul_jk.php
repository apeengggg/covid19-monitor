<?php include '../config/function.php'; ?>
<?php $jenis_kelamin = mysqli_query($koneksi, "SELECT * FROM master_jk"); ?>

<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
    case 'ubah':
        include 'layout/header.php';
        include 'layout/sidebar.php';

        // ubah
        if (isset($_POST['ubahjk'])) {
            if ($_POST > 0) {
                EditJK($_POST);
            }
        }

        // get kode pasien form url
        $kode = $_GET['kd_jk'];

        // search with kode pasiend
        $query = mysqli_query($koneksi, "SELECT * FROM master_jk WHERE kode_jk='$kode'");
        $data = mysqli_fetch_array($query);
        ?>
        <main class="ms-sm-auto col-10 px-md-2">
        <form action="" method="post" id="addData">
        <div class="row">
            <div class="col-7">
                <fieldset class="border p-2 mt-3">
                    <h3>Ubah Data Pasien</h3>
                    <div class="mb-6 row">
                        <label for="nama" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jk" name="jk" value="<?=$data['jk']?>">
                            <input type="hidden" class="form-control" id="kode_jk" name="kode_jk" value="<?=$data['kode_jk']?>">
                            <button type="submit" name="ubahjk" id="ubahjk" class="btn btn-md btn-dark mt-2">Ubah Data</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</main>
        <?php
        break;
    }
}else{
   include 'layout/header.php';
   include 'layout/sidebar.php';
   ?>
<main class="ms-sm-auto col-10 px-md-2">
    <h3 class="mt-2">Data Master Jenis Kelamin</h3>
    <table class="table table-bordered table-striped mt-2" id="tabel-data">
        <thead>
            <th>No</th>
            <th>Kode Jenis Kelamin</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php 
            $no =1;
            while ($data=mysqli_fetch_array($jenis_kelamin)) {
            ?>
            <tr>
                <td width="10%"><?=$no++?></td>
                <td width="40%"><?=$data['kode_jk']?></td>
                <td width="40%"><?=$data['jk']?></td>
                <td width="10%">
                    <a href="?module=master_jk&action=ubah&kd_jk=<?=$data['kode_jk']?>">Edit</a>
                    <!-- <a href="?module=master_jk&action=hapus&kd_jk=<?=$data['kode_jk']?>">Hapus</a> -->
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