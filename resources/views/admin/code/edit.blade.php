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
        <h1 class="h3 mb-0 text-gray-800"> #{{$code->name}} @lang('admin/app.modify')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary"> #{{$code->code}} @lang('admin/app.modify')</h6>
        </div>
        <div class="card-body">
            
            <div class="tab-content">
                <div class="tab-pane active" id="main_info">
                    <form id="userEditForm" action="{{route('admin.code.edit', $code->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" style="min-width: 600px;">
                                <tbody>                                    
                                    <tr>
                                        <th>추천코드</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="code" name="code" value="{{$code->code}}"
                                                    data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.password')) }}"
                                                    data-rule-minlength="4" data-msg-minlength="{{ sprintf(trans('admin/app.min_length'), trans('admin/app.password'), 4) }}"
                                                    data-rule-maxlength="255" data-msg-maxlength="{{ sprintf(trans('admin/app.max_length'), trans('admin/app.password'), 255) }}">
                                            </div>
                                        </td>
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
    </script>
@endsection