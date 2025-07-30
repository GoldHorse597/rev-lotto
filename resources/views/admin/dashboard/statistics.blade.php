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
        <h1 class="h3 mb-0 text-gray-800">입출금관리</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="mr-1">입출금내역</span>
                <span class="badge badge-primary badge-pill">{{ $total }}</span>
            </h6>
        </div>
        <div class="card-body">
  
            <div class="container my-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card border-success text-center">
                            <div class="card-body">
                                <h6 class="card-title text-success">입금신청금액</h6>
                                <p class="card-text h5">{{ number_format(floor($reqDeposit), 0) }} 원</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card border-danger text-center">
                            <div class="card-body">
                                <h6 class="card-title text-danger">출금신청금액</h6>
                                <p class="card-text h5">{{ number_format(floor($reqWithdrawal), 0) }} 원</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card border-success text-center">
                            <div class="card-body">
                                <h6 class="card-title text-success">총입금금액</h6>
                                <p class="card-text h5">{{ number_format(floor($totalDeposit), 0) }} 원</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card border-danger text-center">
                            <div class="card-body">
                                <h6 class="card-title text-danger">총출금금액</h6>
                                <p class="card-text h5">{{ number_format(floor($totalWithdrawal), 0) }} 원</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="get">
                <ul class="nav nav-pills d-flex justify-content-end">
                <li class="nav-item mr-2">
                    <select class="form-control" name="type" aria-invalid="false">
                    <option value="" {{ $type == '' ? 'selected' : '' }}> 전체 </option>
                    <option value="0" {{ $type === '0' ? 'selected' : '' }}> 입금 </option>
                    <option value="1" {{ $type === '1' ? 'selected' : '' }}> 출금 </option>
                    </select>
                </li>
                <li class="nav-item mr-2">
                    <select class="form-control" name="status" aria-invalid="false">
                    <option value="" {{ $status == '' ? 'selected' : '' }}> 전체 </option>
                    <option value="0" {{ $status == '0' ? 'selected' : '' }}> 대기중 </option>
                    <option value="1" {{ $status == '1' ? 'selected' : '' }}> 정상 </option>
                    <option value="2" {{ $status == '2' ? 'selected' : '' }}> 취소 </option>
                    </select>
                </li>
                <li class="nav-item mr-2 mb-3">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@lang('admin/app.user') @lang('admin/app.identity')</span>
                    </div>
                    <input class="form-control" type="text" name="identity" value="{{$identity}}">
                    </div>
                </li>
                <li class="nav-item mb-3">
                    <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search fa-sm text-white-50"></i> @lang('admin/app.search') </button>
                </li>
                </ul>
            </form>

            <div class="table-responsive" style="min-height: 500px;">
                <table class="table table-bordered" id="usersDataTable">
                    <thead>
                        <tr>
                            <th>@lang('admin/app.number')</th>                           
                            <th>회원아이디</th>
                            <th>회원이름</th>
                            <th style="text-align:center">종류</th>
                            <th>금액</th>
                            <th style="text-align:center">상태</th>
                            <th>신청일자</th>                            
                            <th style="text-align:center">@lang('admin/app.manage')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($statistics->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($statistics as $index => $statistic)
                        <tr>
                            <td> {{  $statistics->firstItem() + $index}} </td>                            
                            <td>
                                <div>{{$statistic->identity}}</div>
                            </td>
                            <td>
                                <div>{{$statistic->name}}</div>
                            </td>
                            <td style="text-align:center"> <span class="badge p-2" style="color:white;background-color: {{ $statistic->type == 1 ? 'red' : 'blue' }}">{{$statistic->type==0?'입금':'출금'}}</span></td>
                            
                            <td> {{number_format(floor($statistic->amount),0)}}</td>               
                             <td style="text-align:center">
                                @switch ($statistic->status)
                                    @case(0)
                                        <span class="badge badge-warning p-2">@lang('admin/app.waiting')</span>
                                        @break
                                    @case(1)
                                        <span class="badge badge-success p-2">@lang('admin/app.normal')</span>
                                        @break
                                    @case(2)
                                        <span class="badge badge-danger p-2">취소</span>
                                        @break
                                @endswitch
                            </td>
                              
                            <td> {{$statistic->created_at}} </td>
                            <td style="text-align:center">
                                <div class="btn-group btn-group-sm">                                    
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-info dropdown-toggle text-decoration-none text-white " href="#" data-toggle="dropdown"> @lang('admin/app.manage') </a>
                                        <div class="dropdown-menu" id="dropdown_process">
                                            @switch ($statistic->status)
                                                @case(0)
                                                <a class="dropdown-item btn btn-success btn-process" data-param="approve" href="{{route('admin.statistic.process', ['id'=> $statistic->id, 'param' => 'approve'])}}"> @lang('admin/app.approve') </a>
                                                <a class="dropdown-item btn btn-danger btn-process" data-param="block" href="{{route('admin.statistic.process', ['id'=> $statistic->id, 'param' => 'block'])}}">취소</a>
                                                @break
                                                                                      
                                            @endswitch
                                            <a class="dropdown-item btn btn-danger btn-process" data-param="delete" href="{{route('admin.statistic.process', ['id'=> $statistic->id, 'param' => 'delete'])}}"> @lang('admin/app.delete') </a>
                                        </div>
                                    <div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $statistics->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#userCreateModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.new_user') </button>
    </div>
    <form id="processForm" action="" method="post">
        @csrf
    </form>
@endsection

@section('script')
    @parent
    <script>
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });

        $('.btn-process').click(function (e) {
            e.preventDefault();
            let param = $(this).data('param');
            if (param == 'delete' && !confirm('정말로 삭제하시겠습니까?')) {
                return;
            }
            let form = $('#processForm');
            let action = $(this).attr('href');
            form.attr('action', action).submit();
        });
    </script>
@endsection