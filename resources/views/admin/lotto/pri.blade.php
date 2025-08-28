@extends('admin.layouts.' . $layout)

@section('head')
    <title>{{ $app_name }} - {{ $page_title }}</title>
@endsection

@section('main-content')

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
        <h1 class="h3 mb-0 text-gray-800">{{ $page_title }}</h1>
    </div>

    <div class="card shadow mb-4">       
        <div class="card-body">        
            <form method="get">
                <ul class="nav nav-pills d-flex ">
                   
                    <li class="nav-item mb-3" style="margin-right:20px;">
                        <button type="submit" name="status" value="0"  class="btn btn-info">대기중</button>
                    </li>
                    <li class="nav-item mb-3" style="margin-right:20px;">
                        <button type="submit" name="status" value="1" class="btn btn-danger">완료</button>
                    </li>
                    <li class="nav-item mb-3" style="margin-right:20px;">
                        <button type="submit" name="status" value="2" class="btn btn-primary">전체</button>
                    </li>
                </ul>
            </form>   
            <div class="table-responsive" style="min-height: 500px;">
                <table class="table table-bordered" id="usersDataTable">
                    <thead>
                        <tr>
                            <th>@lang('admin/app.number')</th>
                            <th>라운드</th>
                            <th>진행날짜</th>
                            <th>최신결과</th>
                            <th>보너스</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($lotteries->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($lotteries as $index => $lottery)
                        <tr>
                            <td> {{ $index + 1 }} </td>                            
                            <td>
                                {{ $lottery['round'] }}
                            </td>
                            <td>
                               {{ \Carbon\Carbon::parse($lottery['startAt'])->setTimezone('Asia/Seoul')->format('Y-m-d H:i:s') }}
                            </td>
                            <td>
                               {{ implode(', ', $lottery['result']['mainNumbers']) }}
                            </td>
                            <td> {{ $lottery['result']['bonusNumber'] }}</td>
                           
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $lotteries->links() }}
@endsection
