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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.user') #{{$user->identity}} @lang('admin/app.modify')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">@lang('admin/app.user') #{{$user->identity}} @lang('admin/app.modify')</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#main_info" data-toggle="tab">
                        @lang('admin/app.main_info')
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="main_info">
                    <form id="userEditForm" action="{{route('admin.user.edit', $user->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" style="min-width: 600px;">
                                <tbody>
                                   
                                    <tr>
                                        <th>@lang('admin/app.identity')</th>
                                        <td>{{$user->identity}}</td>
                                    </tr>
                                    <tr>
                                        <th>이름</th>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin/app.password')</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="userEditPassword" name="password" value="{{old('password') !== null ? old('password') : $user->password_original}}"
                                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.password')) }}"
                                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.password'), 4) }}"
                                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.password'), 255) }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin/app.current_balance')</th>
                                        <td>  <input type="text" style="max-width:200px;text-align:right; display:inline" class="form-control" id="amount" name="amount" value="{{number_format(floor($user->amount))}}" >@lang('admin/app.pot') </td>
                                    </tr>
                                    <tr>
                                        <th>은행</th>
                                        <td>  
                                            <select name="bank_name" id="bank_name" class="w250 mw100p" style="text-align:center">
                                                @foreach ($banks as $bank)
                                                <option value="{{ $bank->name }}"
                                                    @if ($user->bank_name == $bank->name) selected @endif>
                                                    {{ $bank->name }} 
                                                </option>
                                                @endforeach                  
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>계좌번호</th>
                                        <td>  <input type="text" class="form-control" id="bank_num" name="bank_num" value="{{$user->bank_num}}" ></td>
                                    </tr>
                                    <tr>
                                        <th>예금주</th>
                                        <td>  <input type="text" class="form-control" id="bank_owner" name="bank_owner" value="{{$user->bank_owner}}" ></td>
                                    </tr>
                                    <tr>
                                        <th>휴대전화</th>
                                        <td>  <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" ></td>
                                    </tr>
                                   
                                    <tr>
                                        <th>@lang('admin/user.last_access_at')</th>
                                        <td>{{$user->last_access_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin/user.created_at')</th>
                                        <td>{{$user->created_at}}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">@lang('admin/app.save')</button>
                        </div>
                    </form>
                </div>
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
        $('#amount').on('input', function() {
            let value = $(this).val();
            value = value.replace(/[^0-9]/g, ''); // 숫자만 남기기
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // 천단위 , 찍기
            $(this).val(value);
        });
    </script>
@endsection