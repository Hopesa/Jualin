<?php
//This is CAF File (Central Admin File)
//We Check User Login Again/Not Now
//We Check User Level
require('element.php');
$user = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$level = $dataid["rank"];
$id_user = $dataid["id_user"];//ID User grabbed
if($level!=1000){echo "403 Not Authorized Please Exit this Page"; exit;}
//Taking data
$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Verifikasi'") or trigger_error("Query Failed: " . mysql_error());
$newtranspenver=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Konfirmasi'") or trigger_error("Query Failed: " . mysql_error());
$penkon=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Seller Pending'") or trigger_error("Query Failed: " . mysql_error());
$selpentrans=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Verifikasi Resi'") or trigger_error("Query Failed: " . mysql_error());
$penveres=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Delivery'") or trigger_error("Query Failed: " . mysql_error());
$deliverpen=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Selesai'") or trigger_error("Query Failed: " . mysql_error());
$sls=mysql_num_rows($sql);

//Hell be unleashed upon this piece of codes
$jan = 0;$feb = 0;$mar = 0; $apr = 0; $may = 0; $june = 0; $july = 0;
$aug = 0;$sep = 0; $okt = 0; $nov = 0; $dec = 0;
$sqldate = mysql_query("SELECT * FROM `cart_final`") or trigger_error("Query Failed: " . mysql_error());
while($datasql=mysql_fetch_array($sqldate)){
$dataprocess = "";
$datatgl = $datasql['waktu_trans'];
$dafak = substr($datatgl,5,2);
$dataprocess = substr($datatgl,5,2);
    //More force to be unleashed
    if($dataprocess == 01){
        $jan++;
    }
    else if($dataprocess == 02){
        $feb++;
    }
    else if($dataprocess == 03){
        $mar++;
    }
    else if($dataprocess == 04){
        $apr++;
    }
    else if($dataprocess == 05){
        $may++;
    }
    else if($dataprocess == 06){
        $june++;
    }
    else if($dataprocess == 07){
        $july++;
    }
    else if($dataprocess == 08){
        $aug++;
    }
    else if($dataprocess == 09){
        $sep++;
    }
    else if($dataprocess == 10){
        $okt++;
    }
    else if($dataprocess == 11){
        $nov++;
    }
    else {
        $dec++;
    }
}
$arraydata = "";
$arraydata .='['.$jan.', '.$feb.', '.$mar.', '.$apr.', '.$may.', '.$june.', '.$july.', '.$aug.', '.$sep.', '.$okt.', '.$nov.', '.$dec.']';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Master Panel | Jualin.id</title>
    <?php
   echo $style;

echo $script;
    ?>
    
    <script src="js/chart.js"></script> 
    <script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<script type="text/javascript" src="js/highcharts-more.src.js"></script>
    <script src="js/modules/data.js"></script>
<script src="js/modules/drilldown.js"></script>
  <script type="text/javascript">
$(function () {
    $('#grafik').highcharts({
        title: {
            text: 'Status Transaksi',
            x: -20 //center
        },
        subtitle: {
            text: 'Data Transaksi Dari Jualin.id',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            },
            plotLines: [{
                value: 0,
                width: 1,
                min : 0,
                color: '#808080'
            }],tickPositions: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]
            
        },
        tooltip: {
            valueSuffix: 'Transaksi'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
             name: 'Jumlah Transaksi',
            data: <?php echo $arraydata; ?>
        }]
    });
});
		</script>
    <script type="text/javascript">
$(function () {

    Highcharts.data({
        csv: document.getElementById('tsv').innerHTML,
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];

            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseFloat(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {

                    // Remove special edition notes
                    name = name.split(' -')[0];

                    // Split into brand and version
                    version = name.match(/([0-9]+[\.0-9x]*)/);
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');

                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push(['v' + version, columns[1][i]]);
                    }
                }

            });

            $.each(brands, function (name, y) {
                brandsData.push({
                    name: name,
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data: value
                });
            });

            // Create the chart
            $('#bar').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Data Bulan : Mei'
                },
                subtitle: {
                    text: 'Data Transaksi Bulan Mei.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total percent market share'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                },

                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    series: drilldownSeries
                }
            });
        }
    });
});


		</script>
</head><!--/head-->

<body>
<?php
    
    echo $header;
?>
    <pre id="tsv" style="display:none">Browser Version	Total Market Share
Pending Konfirmasi 8.0	6.61%
Pending Konfirmasi 9.0	16.96%
Pending Verifikasi 18.0	8.01%
Pending Verifikasi 19.0	7.73%
Seller Pending 12	6.72%
Pending Konfirmasi 6.0	6.40%
Seller Pending 11	4.72%
Pending Konfirmasi 7.0	3.55%
Pending Delivery 5.1	3.53%
Seller Pending 13	2.16%
Seller Pending 3.6	1.87%
Pending Resi 11.x	1.30%
Pending Verifikasi 17.0	1.13%
Seller Pending 10	0.90%
Pending Delivery 5.0	0.85%
Seller Pending 9.0	0.65%
Seller Pending 8.0	0.55%
Seller Pending 4.0	0.50%
Pending Verifikasi 16.0	0.45%
Seller Pending 3.0	0.36%
Seller Pending 3.5	0.36%
Seller Pending 6.0	0.32%
Seller Pending 5.0	0.31%
Seller Pending 7.0	0.29%
Proprietary or Undetectable	0.29%
Pending Verifikasi 18.0 - Maxthon Edition	0.26%
Pending Verifikasi 14.0	0.25%
Pending Verifikasi 20.0	0.24%
Pending Verifikasi 15.0	0.18%
Pending Verifikasi 12.0	0.16%
Pending Resi 12.x	0.15%
Pending Delivery 4.0	0.14%
Pending Verifikasi 13.0	0.13%
Pending Delivery 4.1	0.12%
Pending Verifikasi 11.0	0.10%
Seller Pending 14	0.10%
Seller Pending 2.0	0.09%
Pending Verifikasi 10.0	0.09%
Pending Resi 10.x	0.09%</pre>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Admin Master</li>
				</ol>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<center><h3>Global Master Panel(Pre-Alpha)</h3>
				<p>Jualin.id Status and Management.</p></center>
			</div>
			<div class="row">
				<div id="grafik" style="min-width: 310px; height: 400px; margin: 0 auto"></div><div id="bar" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                
				<div class="col-sm-6">
                    
					<div class="total_area">
						<ul>
                            <li>Transaksi Baru Hari Ini<span><?php echo $newtranspenver ?></span></li>
							<li>Konfirmasi Transaksi <span><?php echo $penkon ?></span> </li>
							<li>Transaksi Pending Verifikasi <span><?php echo $newtranspenver ?></span> </li>
							<li>Transaski Seller Pending <span><?php echo $selpentrans ?></span> </li>
                            <li>Transaksi Selesai <span><?php echo $sls ?></span> </li>
						</ul>
							<center><a class="btn btn-default check_out" href="">Lihat Master Panel Transaksi</a></center>
					</div>
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Konfirmasi baru <span><?php echo $penkon ?></span> </li>
							<li>Konfirmasi Deposit Dompetin</li>
							<li>Konfirmasi Pembayaran Lain</li>
                            <li>Konfirmasi Resi <span><?php echo $penveres ?></span></li>
                            <li>Verifikasi Delivery<span><?php echo $deliverpen?></span></li>
                            <center><a class="btn btn-default check_out" href="">Lihat Panel Konfirmasi</a></center>
						</ul>
					</div>
                    
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
                            <li>Aduan Baru</li>
							<li>Pesan Support Baru</li>
							<li>Laporan Produk </li>
							<li>Laporan Transaksi Mencurigakan</li>
                            <li>Dispute </li>
						</ul>
							<center><a class="btn btn-default check_out" href="">Lihat Master Panel Customer</a></center>
					</div>
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Expected Expenses</li>
							<li>Expected Profit Today</li>
							<li>Turn Over</li>
                            <li>Uang Masuk Hari Ini</li>
                            <li>Uang Keluar Hari Ini</li>
                        <center> <a class="btn btn-default check_out" href="">Lihat Panel Finance</a></center>
						</ul>
					</div>
                    
				</div>
                 <div class="col-sm-6 col-md-offset-3">
					<div class="total_area">
						<ul>
							<li>Staff Verifikasi Online</li>
							<li>Staff Service Online</li>
							<li>Staff Checkers</li>
                        <center> <a class="btn btn-default check_out" href="">Ke Staff Management Panel</a></center>
						</ul>
					</div>
                    
				</div>
                <center><div class="col-sm-12"><h4>Panel Lainnya</h4><button class="btn btn-default check_out">Cek Konfirmasi Pembayaran</button><button onclick="print_d()" class="btn btn-default check_out">Print Halaman Ini</button><button class="btn btn-default check_out">Ke Dompetin Master Panel</button><button class="btn btn-default check_out">Ke Database Management</button><button class="btn btn-default check_out">Lihat Transaksi Baru</button></div></center>
			</div>
		</div><br><br><br><br>
	</section><!--/#do_action-->
<?php
foot:
echo $footer;
?>
    <script>
        function print_d(){
            window.print();
        }
    </script>
</body>
</html>