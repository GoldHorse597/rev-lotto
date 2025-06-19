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
                                <span class="input-group-text">@lang('admin/app.parent_agent') @lang('admin/app.identity')</span>
                            </div>
                            <input class="form-control" type="text" name="agentUsername" value="{{$agentUsername}}">
                        </div>
                    </li>
                    <li class="nav-item mr-2 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin/app.user') @lang('admin/app.identity')</span>
                            </div>
                            <input class="form-control" type="text" name="userUsername" value="{{$userUsername}}">
                        </div>
                    </li>
                    <li class="nav-item mr-2 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin/app.user') @lang('admin/app.nickname')</span>
                            </div>
                            <input class="form-control" type="text" name="userNickname" value="{{$userNickname}}">
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
                            <th>@lang('admin/app.parent_agent')</th>
                            <th>@lang('admin/app.user')</th>
                            <th class="text-right">
                                <a href="{{request()->fullUrlWithQuery(['sorts[site]'=>empty($sorts['site']) || $sorts['site'] == 'asc' ? 'desc' : 'asc'])}}">@lang('admin/app.site')<i class="fa fa-fw fa-sort{{empty($sorts['site']) ? '' : ($sorts['site'] == 'asc' ? '-up' : '-down')}}"></i></a>
                            </th>
                            <th class="text-right">
                                <a href="{{request()->fullUrlWithQuery(['sorts[auto_expire_at]'=>empty($sorts['auto_expire_at']) || $sorts['auto_expire_at'] == 'asc' ? 'desc' : 'asc'])}}">@lang('admin/user.auto_expire_at')<i class="fa fa-fw fa-sort{{empty($sorts['auto_expire_at']) ? '' : ($sorts['auto_expire_at'] == 'asc' ? '-up' : '-down')}}"></i></a>
                            </th>
                            <th>@lang('admin/user.created_at')</th>
                            <th>@lang('admin/user.last_access_at')</th>
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
                                <div class="dropdown">
                                    @if ($user->parent_id == Auth::user()->id)
                                    <a class="d-block dropdown-toggle text-decoration-none text-info " href="#" data-toggle="dropdown">
                                        <div>{{$user->parent_nickname}}</div>
                                        <code>{{'@'.$user->parent_identity}}</code>
                                    </a>
                                    <div class="dropdown-menu">
                                        <h6 class="dropdown-header">@lang('admin/app.agent')</h6>
                                        <a class="dropdown-item" href="{{route('admin.agent.settings')}}"> @lang('admin/app.modify') </a>
                                        <a class="dropdown-item" href="{{route('admin.message.list', ['tab'=>'me'])}}" hidden> @lang('admin/app.messages') </a>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">@lang('admin/app.user')</h6>
                                        <a class="dropdown-item" href="{{route('admin.user.list', ['agentUsername'=>$user->parent_identity])}}"> @lang('admin/app.users') </a>
                                    </div>
                                    @else
                                    <a class="d-block dropdown-toggle text-decoration-none text-dark " href="#" data-toggle="dropdown">
                                        <div>{{$user->parent_nickname}}</div>
                                        <code>{{'@'.$user->parent_identity}}</code>
                                    </a>
                                    <div class="dropdown-menu">
                                        <h6 class="dropdown-header">@lang('admin/app.agent')</h6>
                                        <a class="dropdown-item" href="{{route('admin.agent.edit', $user->parent_id)}}"> @lang('admin/app.modify') </a>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">@lang('admin/agent.child_user')</h6>
                                        <a class="dropdown-item" href="{{route('admin.user.list', ['agentUsername'=>$user->parent_identity])}}"> @lang('admin/app.users') </a>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block dropdown-toggle text-decoration-none text-dark" href="#" data-toggle="dropdown" aria-expanded="true">
                                        <div>{{$user->nickname}}</div>
                                        <code>{{'@'.$user->identity}}</code>
                                    </a>
                                    <div class="dropdown-menu">
                                        <h6 class="dropdown-header">@lang('admin/app.user')</h6>
                                        <a class="dropdown-item" href="{{route('admin.user.edit', $user->id)}}"> @lang('admin/app.modify') </a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div>
                                    <span>{{ $user->site_name }}</span>
                                </div>
                                <div>
                                    <code>{{ $user->site_domain }}</code>
                                </div>
                            </td>
                            <td class="text-right"> {{$user->auto_expire_at}} </td>
                            <td> {{$user->created_at}} </td>
                            <td> {{$user->last_access_at}} </td>
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