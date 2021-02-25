<!-- query chart 1 line -->
<?php $positif = mysqli_query($koneksi, "SELECT tgl_input FROM tb_status_pasien tp INNER JOIN master_pasien mp ON tp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' GROUP BY tgl_input ORDER BY tgl_input ASC LIMIT 8");
  $count_positif = mysqli_query($koneksi, "SELECT COUNT(tgl_input) as tgl_input FROM tb_status_pasien tp LEFT JOIN master_pasien mp ON tp.kode_pasien=mp.kode_pasien LEFT JOIN master_status_pasien msp ON tp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' GROUP BY tgl_input ORDER BY tgl_input DESC LIMIT 8");


  // hari
$sql = mysqli_query($koneksi,"SELECT * FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien GROUP BY tsp.tgl_input ORDER BY tsp.tgl_input DESC LIMIT 0,7"); 
$sql1 = mysqli_query($koneksi,"SELECT * FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien GROUP BY tsp.tgl_input ORDER BY tsp.tgl_input DESC LIMIT 0,7");        
// while($data3 = mysqli_fetch_array($sql)){
// $positifa = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' AND tsp.tgl_input='$data3[tgl_input]'");
// $p = mysqli_fetch_array($positifa);
// }

  // query chart 2
  $positif_age1 = mysqli_query($koneksi, "SELECT COUNT(master_pasien.usia) AS usia1 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Positif' AND (master_pasien.usia >=17 AND master_pasien.usia <=40)");
  $result_age1 = mysqli_fetch_array($positif_age1);
  $positif_age2 = mysqli_query($koneksi, "SELECT COUNT(master_pasien.usia) AS usia2 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Positif' AND master_pasien.usia < 17");
  $result_age2 = mysqli_fetch_array($positif_age2);
  $positif_age3 = mysqli_query($koneksi, "SELECT COUNT(master_pasien.usia) AS usia3 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Positif' AND master_pasien.usia > 40");
  $result_age3 = mysqli_fetch_array($positif_age3);

  // query chart 3
  $positif_con1 = mysqli_query($koneksi, "SELECT COUNT(master_status_pasien.status_pasien) AS kondisi1 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Positif'");
  $result_con1 = mysqli_fetch_array($positif_con1);
  $positif_con2 = mysqli_query($koneksi, "SELECT COUNT(master_status_pasien.status_pasien) AS kondisi2 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Sembuh'");
  $result_con2 = mysqli_fetch_array($positif_con2);
  $positif_con3 = mysqli_query($koneksi, "SELECT COUNT(master_status_pasien.status_pasien) AS kondisi3 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Dirawat'");
  $result_con3 = mysqli_fetch_array($positif_con3);
  $positif_con4 = mysqli_query($koneksi, "SELECT COUNT(master_status_pasien.status_pasien) AS kondisi4 FROM tb_status_pasien INNER JOIN master_pasien ON tb_status_pasien.kode_pasien=master_pasien.kode_pasien INNER JOIN master_status_pasien ON tb_status_pasien.kode_status_pasien=master_status_pasien.kode_status_pasien WHERE master_status_pasien.status_pasien='Meninggal'");
  $result_con4 = mysqli_fetch_array($positif_con4);
  ?>
  <script>
  // chart 1 line
    var ctx = document.getElementById('myChart1');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [<?php while($datahr = mysqli_fetch_array($sql)){
                        $positifhr = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' AND tsp.tgl_input='$datahr[tgl_input]' LIMIT 0,7");
                        while ($p = mysqli_fetch_array($positifhr)) {
                            $tgl = date('d-M-Y', strtotime($datahr['tgl_input']));
                        echo '"' . $tgl . '",';
                        }
                        }?>],
            datasets: [{
                label: 'Positif',
                backgroundColor: 'transparent',
                borderColor: '#0041C2',
                data: [<?php while($datahr1 = mysqli_fetch_array($sql1)){
                        $positifhr1 = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' AND tsp.tgl_input='$datahr1[tgl_input]' LIMIT 0,7");
                        while ($p1 = mysqli_fetch_array($positifhr1)) {
                        echo '"' . $p1['total'] . '",';
                        }
                        }?>]
            }],
        },

        // Configuration options go here
        options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                gridLines : {
              display : false,
          }
            }]
        },
        legend: {
            position: 'right'
    }
    }
    });

    // chart 2
    var ctx = document.getElementById('myChart2');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        labels: ['< 17', '17-40', '40 >'],
        datasets: [{
            // label: 'Positif',
            backgroundColor: [
            '#800000',
            '#bde0ff',
            '#00ff00'
            ],
            borderColor: '#transparent',
            data: [<?=$result_age2['usia2']?>,<?=$result_age1['usia1']?>,<?=$result_age3['usia3']?>]
        }]
    },

    // Configuration options go here
    options: {
    responsive: true,
    maintainAspectRatio: false,
        legend: {
        position: 'right'
        }   
    }
});
    // chart 3
    var ctx = document.getElementById('myChart3').getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        labels: ['Positif', 'Sembuh', 'Dirawat', 'Meninggal'],
        datasets: [{
            // label: 'Positif',
            backgroundColor: [
            '#f08080',
            '#8b0000',
            '#00ff00',
            '#ffd700'
            ],
            borderColor: 'transparent',
            data: [<?=$result_con1['kondisi1']?>,<?=$result_con2['kondisi2']?>,<?=$result_con3['kondisi3']?>,<?=$result_con4['kondisi4']?>]
        }]
    },

    // Configuration options go here
    options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
        position: 'right'
}
}
});
</script>