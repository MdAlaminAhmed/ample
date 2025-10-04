  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><!-- Dashboard v2 --></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="head">


      </div>
      <div class="container-fluid">
        <!-- .row -->
        <div class="row">

          <div class="col-xl-3 col-xxl-6 col-sm-6">
            <div class="info-box " style="background-color: #FEE4E2;">
              <div class="info-box-content">
                <span class="info-box-text">Total customer</span>
                <span class="info-box-number">
                  <?php
                  echo $all_customer = $obj->total_count('member');
                  ?>
                </span>
              </div>
              <span class="info-box-icon "><i class="material-symbols-outlined">
                  supervisor_account</i></span>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <!-- /.col -->
          <div class="col-xl-3 col-xxl-6 col-sm-6">
            <div class="info-box" style="background-color:  #F9CE94 ;">
              <div class="info-box-content">
                <span class="info-box-text">Total Suppliers</span>
                <span class="info-box-number">
                  <?php
                  echo $all_customer = $obj->total_count('suppliar');
                  ?>
                </span>
              </div>
              <span class="info-box-icon elevation-1"><i class="material-symbols-outlined">group</i></span>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-xl-3 col-xxl-6 col-sm-6">
            <div class="info-box " style="background-color:#93D3A2;">

              <div class="info-box-content">
                <span class="info-box-text">Total sells</span>
                <span class="info-box-number">

                  <?php
                  $stmt = $pdo->prepare("SELECT SUM(`sub_total`) FROM `invoice`");
                  $stmt->execute();
                  $res = $stmt->fetch(PDO::FETCH_NUM);
                  echo $total_sell_amount =  $res[0];
                  ?>
                </span>
              </div>
              <span class="info-box-icon elevation-1"><i class="material-symbols-outlined">sell</i></span>

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-xl-3 col-xxl-6 col-sm-6">
            <div class="info-box  " style="background-color: #7FBDFF">

              <div class="info-box-content">
                <span class="info-box-text">Total purchase</span>
                <span class="info-box-number">
                  <?php
                  $stmt = $pdo->prepare("SELECT SUM(`purchase_subtotal`) FROM `purchase_products`");
                  $stmt->execute();
                  $res = $stmt->fetch(PDO::FETCH_NUM);
                  echo $total_purchase =  $res[0];
                  ?>
                </span>
              </div>
              <span class="info-box-icon elevation-1"><i class="material-symbols-outlined">payments</i></span>

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <!-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending orders</span>
                <span class="info-box-number">760</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Incomplete Orders</span>
                <span class="info-box-number">2,000</span>
              </div>
            </div>
          </div> -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class=" col-md-6">
            <div class="info-box bg-cards-1">
              <div class="info-box-content  text-center ">
                <h2 class="info-box-text">Today</h2>
                <span class="sell">Sell:
                  <?php
                  $today = date('Y-m-d');
                  $stmt = $pdo->prepare("SELECT SUM(`net_total`) FROM `invoice` WHERE `order_date` = '$today'");
                  $stmt->execute();
                  $res = $stmt->fetch(PDO::FETCH_NUM);
                  echo $res[0];

                  ?>

                </span><br>
                <span class="buy">Buy:
                  <?php
                  $today = date('Y-m-d');
                  $stmt = $pdo->prepare("SELECT SUM(`purchase_net_total`) FROM `purchase_products` WHERE `purchase_date` = '$today'");
                  $stmt->execute();
                  $res = $stmt->fetch(PDO::FETCH_NUM);
                  echo $res[0];

                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-md-6">
            <div class="info-box bg-cards-2">
              <div class="info-box-content  text-center">
                <h2 class="info-box-text">Monthly</h2>
                <span class="sell">Sell:
                  <?php
                  $start_data = date('Y-m-01-');
                  $end_date =   date('Y-m-t');
                  $stmt = $pdo->prepare("SELECT SUM(`net_total`) FROM `invoice` WHERE `order_date` BETWEEN '$start_data' AND  '$end_date' ");
                  $stmt->execute();
                  $res = $stmt->fetch(PDO::FETCH_NUM);
                  echo $res[0];

                  ?>
                </span><br>
                <span class="buy">Buy:
                  <?php
                  $start_data = date('Y-m-01-');
                  $end_date =   date('Y-m-t');
                  $stmt = $pdo->prepare("SELECT SUM(`purchase_net_total`) FROM `purchase_products` WHERE `purchase_date` BETWEEN '$start_data' AND  '$end_date'");
                  $stmt->execute();
                  $res = $stmt->fetch(PDO::FETCH_NUM);
                  echo $res[0];

                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

        </div>
        <!-- /.row -->

        <!-- Sales Chart Row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-white">
                <h5 class="card-title">
                  <i class="fas fa-chart-line text-success mr-2"></i>
                  Sales Statistics (Last 30 Days)
                </h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body bg-white pt-0">
                <?php
                // Get sales data for the last 30 days
                $salesData = array();
                $dateLabels = array();

                // Calculate date range for the last 30 days
                $endDate = date('Y-m-d');
                $startDate = date('Y-m-d', strtotime('-29 days'));

                // Create an array of all dates in the last 30 days
                $currentDate = $startDate;
                while (strtotime($currentDate) <= strtotime($endDate)) {
                  $dateLabels[] = date('d M', strtotime($currentDate));
                  $formattedDate = $currentDate; // Format for SQL query

                  // Query to get sales for this specific date
                  $stmt = $pdo->prepare("SELECT SUM(net_total) as daily_sales FROM invoice WHERE order_date = ?");
                  $stmt->execute([$formattedDate]);
                  $result = $stmt->fetch(PDO::FETCH_ASSOC);

                  // Add sales amount or 0 if no sales
                  $salesData[] = ($result['daily_sales']) ? $result['daily_sales'] : 0;

                  // Move to next day
                  $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
                }

                // Convert data to JSON for JavaScript
                $salesDataJson = json_encode($salesData);
                $dateLabelsJson = json_encode($dateLabels);

                // Calculate total of the last 30 days
                $totalSales = array_sum($salesData);
                ?>
                <div class="d-flex justify-content-between mb-3 pt-3">
                  <div>
                    <p class="mb-0 text-muted">Total Sales</p>
                    <h4 class="font-weight-bold">৳<?php echo number_format($totalSales); ?></h4>
                  </div>
                  <div class="text-right">
                    <p class="mb-0 text-muted">Current Month</p>
                    <h4 class="font-weight-bold text-success"><?php echo date('F Y'); ?></h4>
                  </div>
                </div>
                <div class="chart-container" style="position: relative;">
                  <canvas id="monthlySalesChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
                <?php
                // JSON variables were moved up in the code
                ?>
                <script>
                  console.log('Dashboard script loaded');
                  // Sales Chart JavaScript - Will execute when document is fully loaded
                  document.addEventListener('DOMContentLoaded', function() {
                    console.log('DOM Content Loaded');
                    try {
                      // Get sales chart canvas
                      var salesChartCanvas = document.getElementById('monthlySalesChart').getContext('2d');

                      // Sales chart data from PHP
                      var salesChartData = {
                        labels: <?php echo $dateLabelsJson; ?>,
                        datasets: [{
                          label: 'Daily Sales',
                          backgroundColor: 'rgba(53, 217, 133, 0.1)',
                          borderColor: 'rgb(53, 217, 133)',
                          pointRadius: 4,
                          pointBackgroundColor: 'white',
                          pointBorderColor: 'rgb(53, 217, 133)',
                          pointBorderWidth: 2,
                          fill: true,
                          lineTension: 0.4, // Note: tension was renamed to lineTension in some Chart.js versions
                          borderWidth: 3,
                          data: <?php echo $salesDataJson; ?>
                        }]
                      };

                      // Chart configuration options
                      var salesChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                          display: false
                        },
                        scales: {
                          xAxes: [{
                            gridLines: {
                              display: false,
                              drawBorder: false
                            },
                            ticks: {
                              fontColor: '#999',
                              padding: 10
                            }
                          }],
                          yAxes: [{
                            gridLines: {
                              color: 'rgba(0, 0, 0, 0.05)',
                              drawBorder: false,
                              zeroLineColor: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                              beginAtZero: true,
                              padding: 10,
                              fontColor: '#999',
                              callback: function(value) {
                                return '৳' + value.toLocaleString(); // Format with Taka symbol
                              }
                            }
                          }]
                        },
                        tooltips: {
                          backgroundColor: 'rgba(0, 0, 0, 0.7)',
                          titleFontColor: '#fff',
                          bodyFontColor: '#fff',
                          titleFontSize: 14,
                          bodyFontSize: 13,
                          xPadding: 12,
                          yPadding: 12,
                          displayColors: false,
                          callbacks: {
                            label: function(tooltipItem, data) {
                              return '৳' + tooltipItem.yLabel.toLocaleString();
                            }
                          }
                        }
                      };

                      // Create the sales chart
                      var salesChart = new Chart(salesChartCanvas, {
                        type: 'line',
                        data: salesChartData,
                        options: salesChartOptions
                      });

                      console.log('Chart created successfully');
                    } catch (error) {
                      console.error('Error creating chart:', error);
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-6">
            <div class="card">
              <div class="card-header">
                <b>Factory product stock Alert</b>
              </div>
              <div class="card-body">
                <div class="responsive">
                  <table class="display dataTable text-center">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>name</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $stmt = $pdo->prepare("SELECT * FROM `factory_products` WHERE `quantity` <= `alert_quantity` ; ");
                      $stmt->execute();
                      $res = $stmt->fetchAll(PDO::FETCH_OBJ);
                      foreach ($res as $product) {
                      ?>
                        <tr>
                          <td>1</td>
                          <td><?= $product->product_id; ?></td>
                          <td><?= $product->product_name; ?></td>
                          <td><?= $product->quantity; ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="card">
              <div class="card-header">
                <b>Stock Alert</b>
              </div>
              <div class="card-body">
                <div class="responsive">
                  <table class="display dataTable text-left">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>name</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `quantity` <= `alert_quanttity` ; ");
                      $stmt->execute();
                      $res = $stmt->fetchAll(PDO::FETCH_OBJ);



                      foreach ($res as $product) {
                      ?>
                        <tr>
                          <td>1</td>
                          <td><?= $product->product_id; ?></td>
                          <td><?= $product->product_name; ?></td>
                          <td><?= $product->quantity; ?></td>
                        </tr>
                      <?php
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>