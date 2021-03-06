<?php require 'config/function.php';?>
<?php require 'layout/header.php';?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h2 text-center mt-2">Monitoring COVID-19</h1>
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <center>
                    </center>
                </div>
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
                    <canvas id="myChart2"></canvas>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="border p-2">
                    <h5>Grafik 3</h5>
                    <canvas id="myChart3"></canvas>
                </fieldset>
            </div>
        </div>
    </div>

<?php require 'layout/footer.php';?>
<?php include 'assets/charts.php';?>