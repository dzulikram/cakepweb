<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Divisi Sistem dan Teknologi Informasi
            <small>Kalimantan Timur dan Utara</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">FORM</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-lg-10">
                    <table id="main-grid" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th width="75%">NAMA</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>FORM INSIDEN LAYANAN TI</td>
                                    <td><a href="http://bit.ly/insidenIT" class="btn btn-primary">LINK</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>FORM PEKERJAAN HELPDESK</td>
                                    <td><a href="http://bit.ly/HelpdeskUIP" class="btn btn-primary">LINK</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>FORM PEMELIHARAAN SERVER</td>
                                    <td><a href="http://bit.ly/formserver" class="btn btn-primary">LINK</a></td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                </div>
                
                <div class="box-footer">
                    
                </div>
              </div><!-- /.box -->

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">REPORT</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-lg-10">
                    <table id="main-grid" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th width="75%">NAMA</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>REPORT INSIDEN LAYANAN TI</td>
                                    <td><a href="http://bit.ly/reportinsiden" class="btn btn-primary">LINK</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>REPORT PEKERJAAN HELPDESK</td>
                                    <td><a href="http://bit.ly/HelpdeskUIP_report" class="btn btn-primary">LINK</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>DOKUMENTASI KEGIATAN TI</td>
                                    <td><a href="http://bit.ly/driveIT" class="btn btn-primary">LINK</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>REPORT PEMELIHARAAN SERVER</td>
                                    <td><a href="http://bit.ly/reportserver" class="btn btn-primary">LINK</a></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>REPORT GANGGUAN JARINGAN ICON</td>
                                    <td><a href="http://bit.ly/gangguanicon" class="btn btn-primary">LINK</a></td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                </div>
                <div class="box-footer">
                    
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script>
  // $(function () {
  //   /* ChartJS
  //    * -------
  //    * Here we will create a few charts using ChartJS
  //    */

  //   //--------------
  //   //- AREA CHART -
  //   //--------------

  //   var totalData = {
  //         labels: ["January", "February", "March", "April", "May", "June", "July", "Agustus", "September","Oktober","November", "Desember"],
  //         datasets: [
  //           {
  //             label: "Rencana",
  //             fillColor: "rgba(244, 104, 66, 1)",
  //             strokeColor: "rgba(244, 104, 66, 1)",
  //             pointColor: "rgba(244, 104, 66, 1)",
  //             pointStrokeColor: "#c1c7d1",
  //             pointHighlightFill: "#fff",
  //             pointHighlightStroke: "rgba(220,220,220,1)",
  //             data: <?php
  //             $num = count($rekap_komulatif);
  //             $i = 0;
  //             echo "[";
  //             foreach ($rekap_komulatif as $row) 
  //             {
  //               $i++;
  //               if($row->total_rencana == null)
  //               {
  //                 echo 0;
  //               }
  //               else
  //               {
  //                 echo $row->total_rencana;
  //               }
  //               if($i != $num)
  //               {
  //                 echo ",";
  //               }
  //             }
  //             echo "]";
  //             ?>
  //             // [10000000, 20000000, 30000000, 40000000,50000000, 60000000, 70000000, 80000000,90000000, 100000000, 110000000, 120000000]
  //           },
  //           {
  //             label: "Realisasi",
  //             fillColor: "rgba(60,141,188,0.9)",
  //             strokeColor: "rgba(60,141,188,0.8)",
  //             pointColor: "#3b8bba",
  //             pointStrokeColor: "rgba(60,141,188,1)",
  //             pointHighlightFill: "#fff",
  //             pointHighlightStroke: "rgba(60,141,188,1)",
  //             data: <?php
  //             $num = count($rekap_komulatif);
  //             $i = 0;
  //             echo "[";
  //             foreach ($rekap_komulatif as $row) 
  //             {
  //               $i++;
  //               if($row->total_realisasi == null)
  //               {
  //                 echo 0;
  //               }
  //               else
  //               {
  //                 echo $row->total_realisasi;
  //               }
  //               if($i != $num)
  //               {
  //                 echo ",";
  //               }
  //             }
  //             echo "]";
  //             ?>
  //           }
  //         ]
  //       };

  //   var lineChartOptions = {
  //     //Boolean - If we should show the scale at all
  //     showScale: true,
  //     //Boolean - Whether grid lines are shown across the chart
  //     scaleShowGridLines: false,
  //     //String - Colour of the grid lines
  //     scaleGridLineColor: "rgba(0,0,0,.05)",
  //     //Number - Width of the grid lines
  //     scaleGridLineWidth: 1,
  //     //Boolean - Whether to show horizontal lines (except X axis)
  //     scaleShowHorizontalLines: true,
  //     //Boolean - Whether to show vertical lines (except Y axis)
  //     scaleShowVerticalLines: true,
  //     //Boolean - Whether the line is curved between points
  //     bezierCurve: true,
  //     //Number - Tension of the bezier curve between points
  //     bezierCurveTension: 0.3,
  //     //Boolean - Whether to show a dot for each point
  //     pointDot: false,
  //     //Number - Radius of each point dot in pixels
  //     pointDotRadius: 4,
  //     //Number - Pixel width of point dot stroke
  //     pointDotStrokeWidth: 1,
  //     //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
  //     pointHitDetectionRadius: 20,
  //     //Boolean - Whether to show a stroke for datasets
  //     datasetStroke: true,
  //     //Number - Pixel width of dataset stroke
  //     datasetStrokeWidth: 2,
  //     //Boolean - Whether to fill the dataset with a color
  //     datasetFill: true,
  //     //String - A legend template
  //     legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
  //     //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  //     maintainAspectRatio: true,
  //     //Boolean - whether to make the chart responsive to window resizing
  //     responsive: true,
  //     scaleLabel:
  //       function(label){return  ' Rp ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");}
  //   };

  //   //-------------
  //   //- LINE CHART -
  //   //--------------
  //   var totalChartCanvas = $("#totalChart").get(0).getContext("2d");
  //   var totalChart = new Chart(totalChartCanvas);
  //   lineChartOptions.datasetFill = false;
  //   totalChart.Line(totalData, lineChartOptions);

  //   var barData = {
  //         labels: ["January", "February", "March", "April", "May", "June", "July", "Agustus", "September","Oktober","November", "Desember"],
  //         datasets: [
  //           {
  //             label: "Rencana",
  //             fillColor: "rgba(244, 104, 66, 1)",
  //             strokeColor: "rgba(244, 104, 66, 1)",
  //             pointColor: "rgba(244, 104, 66, 1)",
  //             pointStrokeColor: "#1cc1d8",
  //             pointHighlightFill: "#fff",
  //             pointHighlightStroke: "rgba(220,220,220,1)",
  //             data: <?php
  //             $num = count($rekap_perbulan);
  //             $i = 0;
  //             echo "[";
  //             foreach ($rekap_perbulan as $row) 
  //             {
  //               $i++;
  //               if($row->total_rencana == null)
  //               {
  //                 echo 0;
  //               }
  //               else
  //               {
  //                 echo $row->total_rencana;
  //               }
  //               if($i != $num)
  //               {
  //                 echo ",";
  //               }
  //             }
  //             echo "]";
  //             ?>
  //           },
  //           {
  //             label: "Realisasi",
  //             fillColor: "rgba(60,141,188,0.9)",
  //             strokeColor: "rgba(60,141,188,0.8)",
  //             pointColor: "#3b8bba",
  //             pointStrokeColor: "rgba(60,141,188,1)",
  //             pointHighlightFill: "#fff",
  //             pointHighlightStroke: "rgba(60,141,188,1)",
  //             data: <?php
  //             $num = count($rekap_perbulan);
  //             $i = 0;
  //             echo "[";
  //             foreach ($rekap_perbulan as $row) 
  //             {
  //               $i++;
  //               if($row->total_realisasi == null)
  //               {
  //                 echo 0;
  //               }
  //               else
  //               {
  //                 echo $row->total_realisasi;
  //               }
  //               if($i != $num   )
  //               {
  //                 echo ",";
  //               }
  //             }
  //             echo "]";
  //             ?>
  //           }
  //         ]
  //       };


  //   var barChartCanvas = $("#barChart").get(0).getContext("2d");
  //   var barChart = new Chart(barChartCanvas);
  //   var barChartData = barData;
  //   barChartData.datasets[1].fillColor = "#00a65a";
  //   barChartData.datasets[1].strokeColor = "#00a65a";
  //   barChartData.datasets[1].pointColor = "#00a65a";
  //   var barChartOptions = {
  //     //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
  //     scaleBeginAtZero: true,
  //     //Boolean - Whether grid lines are shown across the chart
  //     scaleShowGridLines: true,
  //     //String - Colour of the grid lines
  //     scaleGridLineColor: "rgba(0,0,0,.05)",
  //     //Number - Width of the grid lines
  //     scaleGridLineWidth: 1,
  //     //Boolean - Whether to show horizontal lines (except X axis)
  //     scaleShowHorizontalLines: true,
  //     //Boolean - Whether to show vertical lines (except Y axis)
  //     scaleShowVerticalLines: true,
  //     //Boolean - If there is a stroke on each bar
  //     barShowStroke: true,
  //     //Number - Pixel width of the bar stroke
  //     barStrokeWidth: 2,
  //     //Number - Spacing between each of the X value sets
  //     barValueSpacing: 5,
  //     //Number - Spacing between data sets within X values
  //     barDatasetSpacing: 1,
  //     //String - A legend template
  //     legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
  //     //Boolean - whether to make the chart responsive
  //     responsive: true,
  //     maintainAspectRatio: true,
  //     scaleLabel:
  //       function(label){return  ' Rp ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");}
  //   };

  //   barChartOptions.datasetFill = false;
  //   barChart.Bar(barChartData, barChartOptions);


  // });
</script>