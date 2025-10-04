<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid mt-5">
      <div class="row ">
        <div class="col-md-6">
          <h1 class="m-0 text-dark">Customer</h1>
          
          </div><!-- /.col -->
          <div class="col-md-6 mt-3">
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- .row -->
             <div class="card">
               <div class="card-body">
                 <div class="row">
                 <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box bg-danger mb-3">
                     <div class="info-box-content">
                      <span class="info-box-text">Total transaction</span>
                      <span class="info-box-number"> 
                      <?php 
                        $stmt = $pdo->prepare("SELECT SUM(`total_buy`) FROM `member`");
                        $stmt->execute();
                        $res = $stmt->fetch(PDO::FETCH_NUM);

                        echo $res[0];

                      ?>
                        </span>
                    </div>
  <span class="info-box-icon "><i class="material-symbols-outlined">stacked_line_chart</i></span>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                 <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box bg-success mb-3">
                    <div class="info-box-content">
                      <span class="info-box-text">Total paid</span>
                      <span class="info-box-number"> 
                        <?php 
                          $stmt = $pdo->prepare("SELECT SUM(`total_paid`) FROM `member`");
                          $stmt->execute();
                          $res = $stmt->fetch(PDO::FETCH_NUM);

                          echo $res[0];

                        ?>
                        </span>
                    </div>
                    <span class="info-box-icon"><i class="material-symbols-outlined">paid</i></span>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                 <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box bg-info mb-3">
              <div class="info-box-content">
                      <span class="info-box-text">Total due</span>
                      <span class="info-box-number"> 
                        <?php 
                          $stmt = $pdo->prepare("SELECT SUM(`total_due`) FROM `member`");
                          $stmt->execute();
                          $res = $stmt->fetch(PDO::FETCH_NUM);

                          echo $res[0];

                        ?>
                        </span>
                    </div>

     <span class="info-box-icon"><i class="material-symbols-outlined">
assignment_add</i></span>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
              </div>
       </div>
     </div>
                <!-- *************  table start here *********** -->
                <div class="row mb-3">
                  <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                      <h3 class="m-0">All Customer info</h3>
                      <div>
                        <button id="deleteSelected" class="btn btn-danger rounded-0 mr-2"><i class="fas fa-trash"></i> Delete Selected</button>
                        <button type="button" class="btn btn-primary rounded-0" data-toggle="modal" data-target=".myModal"><i class="fas fa-plus"></i> Add new</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="empTable" class="display dataTable text-center">
                        <thead>
                          <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>id</th>
                            <th>Name</th>
                            <th>Customer Type</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>total buy</th>
                            <th>total paid</th>
                            <th>total due</th>
                            <th>action</th>
                          </tr>
                        </thead>
                          </table>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.row -->
                      </div><!--/. container-fluid -->
                    </section>
                    <!-- /.content -->
                  </div>
                  <!-- /.content-wrapper -->