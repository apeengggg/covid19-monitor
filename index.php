<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Monitoring COVID-19</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/dashboard.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Irfan Foundation</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Login</a>
            </li>
        </ul>
    </header>

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

    <!-- bootstrap js -->
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <!-- feather icon -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <!-- chart js  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- chart line -->
    <script src="assets/dist/js/chartline.js"></script>
    <!-- chart line -->
    <script src="assets/dist/js/chartpie1.js"></script>
    <!-- chart line -->
    <script src="assets/dist/js/chartpie2.js"></script>
</body>

</html>