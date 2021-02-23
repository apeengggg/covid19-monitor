<?php include '../config/function.php'; ?>
<?php $pasien = mysqli_query($koneksi, "SELECT * FROM tb_user"); ?>
<?php $status_pasien = mysqli_query($koneksi, "SELECT * FROM master_status_pasien"); ?>
<?php $pasien_not_exist = mysqli_query($koneksi, "SELECT * FROM master_pasien WHERE NOT EXISTS (SELECT * FROM tb_status_pasien WHERE master_pasien.kode_pasien = tb_status_pasien.kode_pasien)");?>
<?php
if (isset($_POST['addstatuspasien'])) {
    if ($_POST > 0) {
        addStatusPasien($_POST);
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
   $status = mysqli_query($koneksi, "SELECT * FROM master_status_pasien");
   
   ?>
<main class="ms-sm-auto col-10 px-md-2">
  <?php
if (isset($_GET['kd_pasien']) && isset($_GET['age'])) {
  // get data pasien
  $query = mysqli_query($koneksi, "SELECT * FROM master_pasien WHERE kode_pasien='$_GET[kd_pasien]'");
  $result = mysqli_fetch_array($query);
  ?>
  <form action="" method="post">
    <div class="row">
      <div class="col-7">
      <fieldset class="border p-2 mt-3">
          <h3>Tambah Data Status Pasien</h3>
          <div class="mb-6 row">
            <label for="tgl_input" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="tgl_input" name="tgl_input" value="<?=date('d-m-y')?>"
                disabled>
            </div>
          </div>
          <div class="mb-6 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="nama_pasien" name="nama_pasien"
                value="<?=$result['nama']?>" disabled>
            </div>
          </div>
          <div class="mb-6 row">
            <label for="kode" class="col-sm-2 col-form-label">No Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kode_pasien" name="kode_pasien"
                value="<?=$result['kode_pasien']?>" readonly>
            </div>
          </div>
          <div class="mt-2 row">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <div class="col-sm-10">
              <input type="number" class="form-control mb-2" id="usia" name="usia" value="<?=$result['usia']?>"
                readonly>
            </div>
          </div>
          <div class="mt-1 row">
            <label for="usia" class="col-sm-2 col-form-label">Status Pasien</label>
            <div class="col-sm-10">
              <select name="kode_status" id="kode_status" class="form-control mb-2" required>
                <option value="">Pilih Status Pasien ..</option>
                <?php while ($jk = mysqli_fetch_array($status_pasien)) {
                        ?>
                <option value="<?=$jk['kode_status_pasien']?>"><?=$jk['status_pasien']?></option>
                <?php } ?>
              </select>
              <button type="submit" name="addstatuspasien" id="addstatuspasien" class="btn btn-md btn-dark">Tambah
                Status Pasien</button>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
  <?php
}else{
?>
  <form action="" method="post" class="mt-2">
    <div class="row">
      <div class="col-7">
        <fieldset class="border p-2">
          <div class="mt-2 row">
            <label for="status_pasien" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <select name="status_pasien" id="status_pasien" class="form-control mb-2">
                <option value="">Pilih Status Pasien...</option>
                <?php while ($result_status = mysqli_fetch_array($status)) {
                        ?>
                <option value="<?=$result_status['kode_status_pasien']?>"><?=$result_status['status_pasien']?></option>
                <?php
                      }?>
              </select>
            </div>
          </div>
          <div class="mt-2 row">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="usia" name="usia" min="1">
            </div>
          </div>
          <div class="mt-2 row">
            <label for="begin_date" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-3">
              <input type="date" class="form-control mb-2" id="begin_date" name="begin_date">
            </div>
            <div class="col-sm-3">
              <input type="date" class="form-control mb-2" id="end_date" name="end_date">
            </div>
            <div class="col-sm-3">
              <button type="submit" name="addstatuspasien" id="addstatuspasien" class="btn btn-md btn-dark">Cari
                Data</button>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
  <a href="#addData" class="btn btn-md btn-dark mt-2">Tambah Data</a>
  <a href="" class="btn btn-md btn-dark mt-2">Download Rekap Data</a>
  <h3 class="mt-2">Data Status Pasien</h3>
  <table class="table table-bordered table-striped mt-2" id="tabel-data1">
    <thead>
      <th>Tanggal</th>
      <th>No Pasien</th>
      <th>Usia</th>
      <th>Status</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php 
            $no =1;
            while ($data=mysqli_fetch_array($pasien)) {
              $tgl = date('d-m-Y', strtotime($data['tgl_input']));
            ?>
      <tr>
        <td width="10%"><?=$tgl?></td>
        <td><?=$data['kode_pasien']?></td>
        <td width="10%"><?=$data['usia']?></td>
        <td width="10%"><?=$data['status_pasien']?></td>
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
          <h3 id="addData">Tambah Data Status Pasien</h3>
          <div class="mt-2 row">
            <label for="tanggal_input" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="tanggal_input" name="tanggal_input"
                value=<?=date('d-m-y')?> disabled>
            </div>
          </div>
          <div class="mb-6 row">
            <label for="nama" class="col-sm-2 col-form-label">No Pasien</label>
            <div class="col-sm-10">
              <select name="kode_pasien" id="kode_pasien" class="form-control mb-2" onchange='changeValue(this.value)'
                required>
                <option value="">Pilih No Pasien ...</option>
                <?php 
                      $a          = "var usia = new Array();\n;";
                      while ($data=mysqli_fetch_array($pasien_not_exist)) {
                        ?>
                <option value="<?=$data['kode_pasien']?>">[<?=$data['kode_pasien']?>]-[<?=$data['nama']?>]</option>
                <?php
                        $a .= "usia['" . $data['kode_pasien'] . "'] = {usia:'" . addslashes($data['usia'])."'};\n"; 
                      }
                      ?>
              </select>

            </div>
          </div>
          <div class="mt-2 row">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="usia" name="usia" min="1" readonly>
            </div>
          </div>
          <div class="mt-1 row">
            <label for="usia" class="col-sm-2 col-form-label">Status Pasien</label>
            <div class="col-sm-10">
              <select name="kode_status" id="kode_status" class="form-control mb-2" required>
                <option value="">Pilih Status Pasien ..</option>
                <?php while ($jk = mysqli_fetch_array($status_pasien)) {
                        ?>
                <option value="<?=$jk['kode_status_pasien']?>"><?=$jk['status_pasien']?></option>
                <?php } ?>
              </select>
              <small class="mt-1 mb-2"><b>*Jika Tidak Ada Data Pada No Pasien, Silahkan Tambah Data Pada Halaman Master Pasien</b> Atau <a href="pagging.php?module=master_pasien">Klik Disini</a></small><br>
              <button type="submit" name="addstatuspasien" id="addstatuspasien" class="btn btn-md btn-dark mt-2">Tambah
                Pasien</button>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
  <?php
}
?>
</main>
<script type="text/javascript">
  < ? php
  echo $a; ? >
  function
  changeValue(id) {
  document.getElementById('usia').value
  =
  usia[id].usia;
  };
</script>
<?php
}
?>
<?php include 'layout/footer.php'; ?>