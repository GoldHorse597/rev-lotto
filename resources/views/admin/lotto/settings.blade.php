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
        <h1 class="h3 mb-0 text-gray-800">배당률 설정</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="mr-1">배당률</span>
                <span class="badge badge-primary badge-pill">{{ $settings->count() }}</span>
            </h6>
        </div>
        <div class="card-body">           
            <div class="table-responsive" style="min-height: 500px;">
                <table class="table table-bordered" id="usersDataTable">
                    <thead>
                        <tr>
                            <th>@lang('admin/app.number')</th>                           
                            <th>등급</th>                            
                            <th>1등</th>
                            <th>2등</th>
                            <th>3등</th>
                            <th>4등</th>
                            <th>5등</th>
                            <th>꽝</th>                            
                            <th>@lang('admin/app.manage')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($settings->isEmpty())
                        <tr>
                            <td class="text-center" colspan="12"> @lang('admin/app.no_data') </td>
                        </tr>
                        @else
                        @foreach($settings as $index => $setting)
                        <tr>
                            <td> {{ $index + 1 }} </td>                            
                            <td>
                                {{ $setting->level == 10 ? '프리미엄' : $setting->level }}
                            </td>
                            <td>
                                {{$setting->rate_1}}
                            </td>
                            <td>
                                {{$setting->rate_2}}
                            </td>
                            <td>
                                {{$setting->rate_3}}
                            </td>
                            <td>
                                {{$setting->rate_4}}
                            </td>
                            <td>
                                {{$setting->rate_5}}
                            </td>
                            <td>
                                {{$setting->rate_7}}
                            </td>
                           
                            <td>
                                <div class="btn-group btn-group-sm">                                   
                                   
                                    <a class="btn btn-primary" href="{{route('admin.lotto.settingedit')}}?id={{ $setting->id}}"> @lang('admin/app.modify') </a>
                                    
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