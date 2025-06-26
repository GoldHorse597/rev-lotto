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
        <h1 class="h3 mb-0 text-gray-800">로또 목록</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="mr-1">로또</span>
                <span class="badge badge-primary badge-pill">{{ $games->count() }}</span>
            </h6>
        </div>
        <div class="card-body">           
            <div class="table-responsive" style="min-height: 500px;">
                <table class="table table-bordered" id="usersDataTable">
                    <thead>
                        <tr>
                            <th>@lang('admin/app.number')</th>                           
                            <th>로또명</th>                            
                            <th>생략어</th>
                            <th>진행날짜</th>
                            <th>최신결과</th>
                            <th>보너스</th>
                            <th>@lang('admin/app.manage')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($games->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($games as $index => $game)
                        <tr>
                            <td> {{ $index + 1 }} </td>                            
                            <td>
                                {{$game->game}}
                            </td>
                            <td>
                                {{$game->abbr}}
                            </td>
                            <td>
                                {{$game->weekday}}
                            </td>
                            <td> {{$game->lastresult}}</td>
                            <td> {{$game->bonus}}</td>
                           
                            <td>
                                <div class="btn-group btn-group-sm">                                    
                                    <a class="btn btn-primary" href="{{route('admin.lotto.edit', $game->id)}}"> @lang('admin/app.modify') </a>
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-info dropdown-toggle text-decoration-none text-white " href="#" data-toggle="dropdown"> @lang('admin/app.manage') </a>
                                        <div class="dropdown-menu" id="dropdown_process">                                           
                                            <a class="dropdown-item btn btn-danger btn-process" data-param="delete" href="{{route('admin.lotto.process', ['id'=> $game->id, 'param' => 'delete'])}}"> @lang('admin/app.delete') </a>
                                        </div>
                                    <div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#gameCreateModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> 로또 추가 </button>
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