<?php include '../config/function.php'; ?>
<?php $pasien = mysqli_query($koneksi, "SELECT * FROM tb_user tu INNER JOIN master_status_user  msu ON tu.kode_su=msu.kode_su"); ?>
<?php $status_user = mysqli_query($koneksi, "SELECT * FROM master_status_user"); ?>
<?php
if (isset($_POST['adduser'])) {
    if ($_POST > 0) {
        addUser($_POST);
        die;
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
      $kode = $_GET['kd_user'];
      $query = mysqli_query($koneksi, "SELECT * FROM tb_user INNER JOIN master_status_user ON tb_user.kode_su=master_status_user.kode_su WHERE tb_user.kode_user='$kode'");
      $result = mysqli_fetch_array($query);

      if (isset($_POST['ubah'])) {
          if ($_POST>0) {
            editUser($_POST);
          }
      }
      include 'layout/header.php';
      include 'layout/sidebar.php';
        ?>
        <main class="ms-sm-auto col-10 px-md-2">
  <form action="" method="post">
    <div class="row">
      <div class="col-7">
        <fieldset class="border p-2 mt-3">
          <h3 id="addData">Ubah Data User</h3>
          <div class="mt-2 row">
            <label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="nama_user" name="nama_user" value=<?=$result['nama_user']?>>
              <input type="hidden" class="form-control mb-2" id="kode_user" name="kode_user" value=<?=$result['kode_user']?>>
            </div>
          </div>
          <div class="mt-2 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="username" name="username" value=<?=$result['username']?> disabled>
            </div>
          </div>
          <div class="mt-2 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="password" name="password"">
            </div>
          </div>
          <div class="mt-1 row">
            <label for="usia" class="col-sm-2 col-form-label">Status User</label>
            <div class="col-sm-10">
              <select name="kode_su" id="kode_su" class="form-control mb-2" required>
                <option value="<?=$result['kode_su']?>"><?=$result['status_user']?></option>
                <?php while ($jk = mysqli_fetch_array($status_user)) {
                        ?>
                <option value="<?=$jk['kode_su']?>"><?=$jk['status_user']?></option>
                <?php } ?>
              </select>
              <button type="submit" name="ubah" id="ubah" class="btn btn-md btn-dark mt-2">Ubah
                User</button>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </form>
</main>
        <?php
        break;

        case 'cari':
            echo 'cari';
        break;
    }
}else{
   include 'layout/header.php';
   include 'layout/sidebar.php';
   $status = mysqli_query($koneksi, "SELECT * FROM master_status_user");
   
   ?>
<main class="ms-sm-auto col-10 px-md-2">
  <h3 class="mt-2">Data User</h3>
  <table class="table table-bordered table-striped mt-2" id="tabel-data1">
    <thead>
      <th>Kode User</th>
      <th>Nama User</th>
      <th>Status User</th>
      <th>Username</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php 
            $no =1;
            while ($data=mysqli_fetch_array($pasien)) {
            ?>
      <tr>
        <td width="10%"><?=$data['kode_user']?></td>
        <td><?=$data['nama_user']?></td>
        <td width="10%"><?=$data['status_user']?></td>
        <td width="10%"><?=$data['username']?></td>
        <td width="10%">
          <a href="?module=user&action=ubah&kd_user=<?=$data['kode_user']?>">Edit</a>
          <a href="?module=user&action=hapus&kd_user=<?=$data['kode_user']?>">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <form action="" method="post">
    <div class="row">
      <div class="col-7">
        <fieldset class="border p-2">
          <h3 id="addData">Tambah Data User</h3>
          <div class="mt-2 row">
            <label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="nama_user" name="nama_user">
            </div>
          </div>
          <div class="mt-2 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="username" name="username">
            </div>
          </div>
          <div class="mt-2 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="text" class="form-control mb-2" id="password" name="password">
            </div>
          </div>
          <div class="mt-1 row">
            <label for="usia" class="col-sm-2 col-form-label">Status User</label>
            <div class="col-sm-10">
              <select name="kode_su" id="kode_su" class="form-control mb-2" required>
                <option value="">Pilih Status User ..</option>
                <?php while ($jk = mysqli_fetch_array($status_user)) {
                        ?>
                <option value="<?=$jk['kode_su']?>"><?=$jk['status_user']?></option>
                <?php } ?>
              </select>
              <button type="submit" name="adduser" id="adduser" class="btn btn-md btn-dark mt-2">Tambah
                User</button>
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
?>
<?php include 'layout/footer.php'; ?>