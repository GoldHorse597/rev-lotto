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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.setting_and_info')</h1>
    </div>

    <div class="row">
        <div class="card shadow col mr-1 mb-4 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('admin/app.main_info')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <th class="w-25">@lang('admin/agent.kind')</th>
                                @if(Auth::guard('admin')->user()->parent_level == 0)         
                                    <td> @lang('admin/agent.level1') </td>
                                @elseif(Auth::guard('admin')->user()->parent_level == 1)
                                    <td> @lang('admin/agent.level2') </td>
                                @elseif(Auth::guard('admin')->user()->parent_level == 2)
                                    <td> @lang('admin/agent.level3') </td>
                                @elseif(Auth::guard('admin')->user()->parent_level == 3)
                                    <td> @lang('admin/agent.level4') </td>
                                @elseif(Auth::guard('admin')->user()->parent_level > 3)
                                    <td> @lang('admin/agent.level5') {{Auth::guard('admin')->user()->parent_level-3}} </td>
                                @endif
                            </tr>
                            <tr hidden>
                                <th>@lang('admin/app.type')</th>
                                @if(Auth::guard('admin')->user()->type == 0)
                                    <td> @lang('admin/app.online_agent') </td>
                                @elseif(Auth::guard('admin')->user()->type == 1)
                                    <td> @lang('admin/app.offline_agent') </td>
                                @endif
                            </tr>
                            
                            <tr>
                                <th>@lang('admin/app.identity')</th>
                                <td>{{Auth::guard('admin')->user()->identity}}</td>
                            </tr>
                           
                            <tr>
                                <th>@lang('admin/app.password')</th>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#passwordChangeModal">@lang('admin/app.change_password')</button>
                                </td>
                            </tr>
                            
                            <tr>
                                <th>@lang('admin/agent.child_user_count')</th>
                                <td>{{number_format($child_users_cnt, 0)}} @lang('admin/app.myong')</td>
                            </tr>
                            <tr>
                                <th>@lang('admin/agent.created_at')</th>
                                <td>{{Auth::guard('admin')->user()->created_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if (Auth::guard('admin')->user()->parent_level == 0)
        <div class="card shadow col ml-1 mb-4 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('admin/app.setting')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive w-100 h-100">
                    <form action="{{route('admin.setting')}}" method="post">
                        @csrf
                        <div class="form-group row m-0">
                            <label for="serviceStatus" class="col-sm-3 col-form-label">@lang('admin/app.service_status')</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="site_closed" name="site_closed" data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.service_status')) }}">
                                    <option value="0" {{ $_setting->site_closed == 0 ? 'selected' : '' }}>@lang('admin/app.normal')</option>
                                    <option value="1" {{ $_setting->site_closed == 1 ? 'selected' : '' }}>@lang('admin/app.site_closed')</option>
                                    <option value="2" {{ $_setting->site_closed == 2 ? 'selected' : '' }}>@lang('admin/app.site_closed_em')</option>
                                </select>
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">@lang('admin/app.site_closed_time')</label>
                                    </div>
                                    <input type="text" class="form-control text-center datetimepicker" id="closed_start_time" name="closed_start_time" value="{{ empty($_setting->closed_start_time) ? '' : date('Y-m-d H:i:s', strtotime($_setting->closed_start_time)) }}">~
                                    <input type="text" class="form-control text-center datetimepicker" id="closed_end_time" name="closed_end_time" value="{{ empty($_setting->closed_end_time) ? '' : date('Y-m-d H:i:s', strtotime($_setting->closed_end_time)) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-0 pt-2">
                            <label class="col-sm-3 col-form-label">@lang('admin/app.forbidden_ip')</label>
                            <div class="col-sm-5">
                                <label class="col-form-label pb-0">@lang('admin/app.user_forbidden_ip')</label>
                                <div class="input-group">
                                    <textarea class="form-control" id="user_forbidden_ip" name="user_forbidden_ip" rows="3">{{ empty($_setting->user_forbidden_ip) ? '' : $_setting->user_forbidden_ip }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label pb-0">@lang('admin/app.admin_forbidden_ip')</label>
                                <div class="input-group">
                                    <textarea class="form-control" id="admin_forbidden_ip" name="admin_forbidden_ip" rows="3">{{ empty($_setting->admin_forbidden_ip) ? '' : $_setting->admin_forbidden_ip }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-0 mt-4">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-success" id="btn_save_setting">@lang('admin/app.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });

        $(".datetimepicker").datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            icons: {
                time: 'fa fa-clock',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });

        $(".timepicker").datetimepicker({
            format: 'HH:mm:ss',
            icons: {
                time: 'fa fa-clock',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });

        $('select#mySiteId').select2({
            width: '100%'
        });

        $('#btn_save_setting').click(function () {
            var site_closed = $('#site_closed').val();
            var closed_start_time = $('#closed_start_time').val();
            var closed_end_time = $('#closed_end_time').val();
            
            var user_forbidden_ip = $('#user_forbidden_ip').val();
            var admin_forbidden_ip = $('#admin_forbidden_ip').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.setting') }}',
                data: {
                    site_closed: site_closed,
                    closed_start_time: closed_start_time,
                    closed_end_time: closed_end_time,
               
                    user_forbidden_ip: user_forbidden_ip,
                    admin_forbidden_ip: admin_forbidden_ip
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success) {
                        alertify.alert('', '@lang('admin/app.setting_saved_successfully')');
                    }
                    else {
                        alertify.alert('', '@lang('admin/app.setting_saving_failed')');
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete : function() {
                }
            });
        });
    </script>
@endsection