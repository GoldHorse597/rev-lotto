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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.online_users')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="mr-1">@lang('admin/app.online_users')</span>
                <span class="badge badge-primary badge-pill">{{ $myusers->total() }}</span>
            </h6>
        </div>
        <div class="card-body">
            <form method="get">
                <ul class="nav nav-pills d-flex justify-content-end">
                    
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
                            <th>보유금액</th>
                            <th>은행정보</th>
                            <th>폰번호</th>
                            <th>추천코드</th>
                            <th>총 입금</th>
                            <th>총 출금</th>
                            <th>총 입-출</th>
                            <th>@lang('admin/user.created_at')</th>
                            <th>@lang('admin/user.last_access_at')</th>
                            <th>@lang('admin/app.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($myusers->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($myusers as $index => $user)
                        <tr>
                            <td> {{ $index + 1 }} </td>                            
                            <td>
                                <div>{{$user->identity}}</div>
                                <code>{{$user->name}}</code>
                            </td>
                            
                           
                            <td> {{number_format(floor($user->amount),0)}}</td>
                            <td> 
                                <div>{{$user->bank_name}} - {{$user->bank_owner}}</div>
                                <code>{{$user->bank_num}}</code>
                            </td>
                            <td> {{$user->phone}}</td>
                            <td> {{$user->code}}</td>

                            <td style="color:red"> {{number_format(floor($user->total_deposit),0)}}</td>
                            <td style="color:blue"> {{number_format(floor($user->total_withdrawal),0)}}</td>
                            <td style="color: {{ $user->profit >= 0 ? 'green' : 'red' }};"> {{number_format(floor($user->profit),0)}}</td>
                            
                            <td> {{$user->created_at}} </td>
                            <td> {{$user->last_access_at}} </td>
                             <td>
                                @switch ($user->status)
                                    @case(0)
                                        <span class="badge badge-warning p-2">@lang('admin/app.waiting')</span>
                                        @break
                                    @case(1)
                                        <span class="badge badge-success p-2">@lang('admin/app.normal')</span>
                                        @break
                                    @case(2)
                                        <span class="badge badge-danger p-2">@lang('admin/app.blocked')</span>
                                        @break
                                @endswitch
                            </td>
                           
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $myusers->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#userCreateModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.new_user') </button>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>
@endsection