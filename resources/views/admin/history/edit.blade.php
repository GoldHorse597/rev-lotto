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
        <h1 class="h3 mb-0 text-gray-800">배팅내역 수정</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">배팅내역 수정</h6>
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
                    <form id="historyEditForm" action="{{route('admin.history.edit', $history->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" style="min-width: 600px;">
                                <tbody>
                                   
                                    <tr>
                                        <th>@lang('admin/app.identity')</th>
                                        <td>{{$history->identity}}</td>
                                    </tr>
                                    <tr>
                                        <th>이름</th>
                                        <td>{{$history->name}}</td>
                                    </tr>   
                                    <tr>
                                        <th>배팅금</th>
                                        <td>{{number_format(floor($history->amount),0) }}</td>
                                    </tr>                                                                                                       
                                    <tr>
                                        <th>구매한 번호</th>
                                        <td>  <input type="text" class="form-control" id="list" name="list" value="{{$history->list}}" ></td>
                                    </tr>
                                    <tr>
                                        <th>보너스</th>
                                        <td>  <input type="text" class="form-control" id="bonus" name="bonus" value="{{$history->bonus}}" ></td>
                                    </tr>                                   
                                    <tr>
                                        <th>배팅일자</th>
                                        <td>{{$history->created_at}}</td>
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