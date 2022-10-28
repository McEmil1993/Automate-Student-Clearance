
@extends('layouts.header')

@section('content')
<div class="content-wrapper">
<!-- <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
</div> -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Dashboard</li>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>150</h3>

                <p>Students</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>Active Student</p>
              </div>
              <div class="icon">
                <i class="fa fa-align-right"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>44</h3>

                <p>Cleared</p>
              </div>
              <div class="icon">
              <i class="fa fa-check-square-o"></i>
                
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
              <i class="fa fa-times-rectangle-o"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-2 ">
                <div class="form-group">
                    <select name="" id="" class="form-control">
                        <option>Select School year</option>
                        <option>2021-2022</option>
                        <option>2021-2022</option>
                        <option>2021-2022</option>
                        <option>2021-2022</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 ">
            <div class="form-group">
                    <select name="" id="" class="form-control">
                        <option>Select Semester</option>
                        <option>1st Sem</option>
                        <option>2nd Sem</option>
                    </select>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Students Chart
                </h3>
               
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

  <script>
      // start_load();
      $('#dashboard').addClass('active3');
      // start_load_click();
      var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesChartData = {
    labels: ['CCS', 'COEd', 'BSOA', 'BSCRIM', 'AB'],
    datasets: [
      {
        
        backgroundColor: [
                '#9e0000',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)'],
        borderColor:  [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'],
        pointRadius: false,
        pointColor: [
                '#3b8bba',
                '#3b8bba',
                '#3b8bba',
                '#3b8bba',
                '#3b8bba'],
        // pointStrokeColor: 'rgba(60,141,188,1)',
        // pointHighlightFill: '#fff',
        // pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [28, 48, 40, 19, 86, 27, 90]
      }
     
    ]
  }


  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }



  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'bar',
    data: salesChartData,
    options: salesChartOptions
  })
  </script>
  @endsection

