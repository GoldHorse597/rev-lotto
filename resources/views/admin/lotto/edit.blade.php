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
        <h1 class="h3 mb-0 text-gray-800">로또 수정</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{$game->game}} 수정</h6>
        </div>
        <div class="card-body">
            
            <div class="tab-content">
                <div class="tab-pane active" id="main_info">
                    <form id="gameEditForm" action="{{route('admin.lotto.edit', $game->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" style="min-width: 600px;">
                                <tbody>
                                    <tr>
                                        <th>로또명</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="gameEditgame" name="game" value="{{$game->game}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>생략어</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="gameEditabbr" name="abbr" value="{{$game->abbr}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>진행날짜</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="gameEditweekday" name="weekday" value="{{$game->weekday}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>최신결과</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="gameEditpricekr" name="lastresult" value="{{$game->lastresult}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>보너스</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="gameEditprice" name="bonus" value="{{$game->bonus}}">
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
        $('#amount').on('input', function() {
            let value = $(this).val();
            value = value.replace(/[^0-9]/g, ''); // 숫자만 남기기
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // 천단위 , 찍기
            $(this).val(value);
        });
    </script>
@endsection