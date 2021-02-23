<!DOCTYPE html>
<html>
<head>
	<title>Laporan Rekapitulasi Data Penyebaran Covid-19</title>
</head>
<body>

	<center>

		<h2>Rekapitulasi Data</h2>

	</center>

	<?php 
	include '../config/function.php';
	?>

	<table border="1" style="width: 100%">
		<tr>
			<th>Tanggal</th>
            <th>Jumlah Pasien Positif</th>
            <th>Jumlah Pasien Dirawat</th>
            <th>Jumlah Pasien Sembuh</th>
            <th>Jumlah Pasien Meninggal</th>
            <th>Total</th>
		</tr>
        <?php 
        
        $sql = mysqli_query($koneksi,"SELECT * FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien GROUP BY tsp.tgl_input ORDER BY tsp.tgl_input ASC");        
		while($data = mysqli_fetch_array($sql)){
        $positif = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' AND tsp.tgl_input='$data[tgl_input]'");
        $p = mysqli_fetch_array($positif);
        $rawat = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Dirawat' AND tsp.tgl_input='$data[tgl_input]'");
        $r = mysqli_fetch_array($rawat);
        $sembuh = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Sembuh' AND tsp.tgl_input='$data[tgl_input]'");
        $s = mysqli_fetch_array($sembuh);
        $meninggal = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Meninggal' AND tsp.tgl_input='$data[tgl_input]'");
        $m = mysqli_fetch_array($meninggal);
        $total = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE (msp.status_pasien='Positif' OR msp.status_pasien='Dirawat' OR msp.status_pasien='Sembuh' OR msp.status_pasien='Meninggal') AND tgl_input='$data[tgl_input]'");
        $t = mysqli_fetch_array($total);
		?>
		<tr>
			<td><?php echo $data['tgl_input']; ?></td>
			<td><?php echo $p['total']; ?></td>
            <td><?php echo $r['total']; ?></td>
            <td><?php echo $s['total']; ?></td>
            <td><?php echo $s['total']; ?></td>
            <td><?php echo $t['total']; ?></td>
		</tr>
		<?php 
		}
        ?>
        <tr align="center">
            <th>Total</th>
            <?php
            $positif2 = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif'");
            $p2 = mysqli_fetch_array($positif2);
            $rawat2 = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Dirawat'");
            $r2 = mysqli_fetch_array($rawat2);
            $sembuh2 = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Sembuh'");
            $s2 = mysqli_fetch_array($sembuh2);
            $meninggal2 = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Meninggal'");
            $m2 = mysqli_fetch_array($meninggal2);
            $total2 = mysqli_query($koneksi,"SELECT COUNT(tsp.kode_pasien) as total, tgl_input FROM tb_status_pasien tsp INNER JOIN master_pasien mp ON tsp.kode_pasien=mp.kode_pasien INNER JOIN master_status_pasien msp ON tsp.kode_status_pasien=msp.kode_status_pasien WHERE msp.status_pasien='Positif' OR msp.status_pasien='Dirawat' OR msp.status_pasien='Sembuh' OR msp.status_pasien='Meninggal'");
            $t2 = mysqli_fetch_array($total2);
            ?>
            <th><?php echo $p2['total'] ?></th>
            <th><?php echo $r2['total'] ?></th>
            <th><?php echo $s2['total'] ?></th>
            <th><?php echo $m2['total'] ?></th>
            <th><?php echo $t2['total'] ?></th>
		</tr>
	</table>

	<script>
		window.print();
	</script>

</body>
</html>