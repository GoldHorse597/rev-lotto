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
        <h1 class="h3 mb-0 text-gray-800">추천코드 목록</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="mr-1">추천코드 목록</span>
                <span class="badge badge-primary badge-pill">{{ $codes->count() }}</span>
            </h6>
        </div>
        <div class="card-body">
            <form method="get">
                <ul class="nav nav-pills d-flex justify-content-end">
                    
                    <li class="nav-item mr-2 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">추천코드</span>
                            </div>
                            <input class="form-control" type="text" name="codeName" value="{{$codeName}}">
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
                            <th>추천코드</th>                            
                            <th>@lang('admin/app.manage')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($codes->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($codes as $index => $code)
                        <tr>
                            <td> {{ $index + 1 }} </td>                            
                            <td >{{ $code->code }}</td>  
                            <td>
                                <div class="btn-group btn-group-sm">
                                    
                                    <a class="btn btn-primary" href="{{route('admin.code.edit', $code->id)}}"> @lang('admin/app.modify') </a>
                                    
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-info dropdown-toggle text-decoration-none text-white " href="#" data-toggle="dropdown"> @lang('admin/app.manage') </a>
                                        <div class="dropdown-menu" id="dropdown_process">                                          
                                            <a class="dropdown-item btn btn-danger btn-process" data-param="delete" href="{{route('admin.code.process', ['id'=> $code->id, 'param' => 'delete'])}}"> @lang('admin/app.delete') </a>
                                        </div>
                                    <div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $codes->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#codeCreateModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.new_code') </button>
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