@extends('admin.layouts.' . $layout)

@section('head')
    <title>{{ $app_name }} - {{ $page_title }}</title>
@endsection

@section('main-content')
   <script src="{{ asset('admin/js/chartjs.min.js') }}"></script>
   <script src="{{ asset('admin/js/Chart.extension.js') }}"></script>
    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    
    @if (session('error'))
    <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0 d-inline-block">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.dashboard')</h1>
    </div>
    <div class="row">
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4" >
          <div class="card border-success">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                  <div class="numbers" style="text-align:center">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold" style="color:#f56036">오늘 신규가입자</p>
                    <h5 class="font-weight-bolder" style="margin-top:15px; text-align:center">
                      {{$todayUser}} 명
                    </h5>                    
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4" >
          <div class="card border-success">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                  <div class="numbers" style="text-align:center">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold" style="color:#825ee4">오늘 입금/출금</p>
                    <h5 class="font-weight-bolder" style="margin-top:15px; text-align:center">
                      <span style="color:green">{{$totaldepo}}</span>/<span style="color:red">{{$totalwith}}</span>
                    </h5>                              
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4" >
          <div class="card border-success">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                  <div class="numbers" style="text-align:center">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold" style="color:#2dcecc">오늘 배팅금</p>
                    <h5 class="font-weight-bolder" style="margin-top:15px; text-align:center">
                      {{number_format(floor($totalmoney),0)}}
                    </h5>                    
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4" >
          <div class="card border-success">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                  <div class="numbers" style="text-align:center">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold" style="color:#fbb140 ">오늘 당첨금</p>
                    <h5 class="font-weight-bolder" style="margin-top:15px; text-align:center">
                      {{number_format(floor($totalprize),0)}}
                    </h5>                    
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4" >
          <div class="card border-success">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                  <div class="numbers" style="text-align:center">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold" style="color:#5e72e4">오늘 배팅-당첨금</p>
                    <h5 class="font-weight-bolder" style="margin-top:15px; text-align:center">
                      {{number_format(floor($totalmoney - $totalprize),0)}}
                    </h5>                    
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>

      <h6 class="text-capitalize" style="margin-top:30px">배팅금상황</h6>
      <div>
        
        <canvas id="chart-line" class="chart-canvas" height="300" width="589" style="display: block; box-sizing: border-box; height: 300px; width: 589px;"></canvas>
      </div>
@endsection

@section('script')
    @parent
    <script>
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        })
    </script>
    <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
@endsection