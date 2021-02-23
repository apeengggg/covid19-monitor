<?php include '../config/function.php';?>
<?php include 'layout/header.php';?>


<div class="container-fluid">
  <div class="row">
    <?php require 'layout/sidebar.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <fieldset class="border p-2">
                    <h5>Grafik 1</h5>
                    <canvas id="myChart1"></canvas>
                </fieldset>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <fieldset class="border p-2">
                    <h5>Grafik 2</h5>
                    <canvas id="myChart2" width="50%"></canvas>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="border p-2">
                    <h5>Grafik 3</h5>
                    <canvas id="myChart3" width="50%"></canvas>
                </fieldset>
            </div>
        </div>
    </div>

    </main>
  </div>
</div>

<?php include 'layout/footer.php';?>
<?php include '../assets/charts.php';?>