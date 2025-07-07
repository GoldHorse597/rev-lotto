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
        <h1 class="h3 mb-0 text-gray-800">배팅내역</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="mr-1">배팅내역</span>
                <span class="badge badge-primary badge-pill">{{ $histories->total() }}</span>
            </h6>
        </div>
        <div class="card-body">
            <form method="get">
                <ul class="nav nav-pills d-flex justify-content-end">
                    <li class="nav-item mr-2">
                        <select class="form-control" name="status" aria-invalid="false">
                            <option value="" {{ $status == '' ? 'selected' : '' }}> 전체 </option>
                            <option value="0" {{ $status === '0' ? 'selected' : '' }}> 대기중 </option>
                            <option value="1" {{ $status === '1' ? 'selected' : '' }}> 처리됨 </option>
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
                    <li class="nav-item mr-2 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">이름</span>
                            </div>
                            <input class="form-control" type="text" name="name" value="{{$name}}">
                        </div>
                    </li>
                    <li class="nav-item mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search fa-sm text-white-50"></i>
                            @lang('admin/app.search')
                        </button>
                    </li>
                </ul>
            </form>
            <div class="table-responsive" style="min-height: 500px;">
                <table class="table table-bordered" id="usersDataTable">
                    <thead>
                        <tr>
                            <th>@lang('admin/app.number')</th>                           
                            <th>회원</th>                            
                            <th>로또종류</th>
                            <th>배팅금액</th>
                            <th>구매한 번호</th>
                            <th>배팅종류</th>
                            <th>당첨결과</th>
                            <th>배팅일자</th>
                            <th>@lang('admin/app.manage')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($histories->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($histories as $index => $history)
                        <tr>
                            <td> {{ $index + 1 }} </td>                            
                            <td>
                                <div>{{$history->identity}}</div>
                                <code>{{$history->name}}</code>
                            </td>
                            <td> {{ $history->game_title }} </td>   
                            <td> {{ number_format(floor($history->amount),0) }} </td>   
                            <td> {{ $history->list }},<span style="color:red">{{ $history->bonus }}</span></td>   
                            <td>
                                @if($history->type == 1)
                                    <span style="color: green;">수동선택</span>
                                @elseif($history->type == 2)
                                    <span style="color: blue;">자동선택</span>
                                @else
                                    <span style="color: orange;">반자동선택</span>
                                @endif
                            </td>         
                           <td>
                                @if($history->status == 0)
                                    <span style="color: orange;">대기중</span>
                                @elseif($history->result == 0)
                                    <span style="color: red;">미당첨</span>
                                @else
                                    <span style="color: green;">{{ $history->result }}등 당첨</span>
                                @endif
                            </td>
                            <td> {{$history->created_at}} </td>
                            
                            <td>
                                <div class="btn-group btn-group-sm">                                    
                                    <a class="btn btn-primary" href="{{route('admin.history.edit', $history->id)}}"> @lang('admin/app.modify') </a>
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-info dropdown-toggle text-decoration-none text-white " href="#" data-toggle="dropdown"> @lang('admin/app.manage') </a>
                                        <div class="dropdown-menu" id="dropdown_process">                                           
                                            <a class="dropdown-item btn btn-danger btn-process" data-param="delete" href="{{route('admin.history.process', ['id'=> $history->id, 'param' => 'delete'])}}"> @lang('admin/app.delete') </a>
                                        </div>
                                    <div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $histories->appends(request()->except('page'))->links() }}
            </div>
        </div>
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