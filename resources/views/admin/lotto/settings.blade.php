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

    <div class="row">
        <div class="card shadow col mr-1 mb-4 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">배당률 설정</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{route('admin.lotto.postSetting')}}" method="post">
                         @csrf
                        <table class="table table-bordered" style="width:50%" cellspacing="0">
                            <tbody>                           
                                
                                <tr>
                                    <th>1등</th>
                                    <td><input type="text" class="form-control" id="rate_1" name="rate_1" value="{{$setting->rate_1}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                                <tr>
                                    <th>2등</th>
                                    <td><input type="text" class="form-control" id="rate_2" name="rate_2" value="{{$setting->rate_2}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                                <tr>
                                    <th>3등</th>
                                    <td><input type="text" class="form-control" id="rate_3" name="rate_3" value="{{$setting->rate_3}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                                <tr>
                                    <th>4등</th>
                                    <td><input type="text" class="form-control" id="rate_4" name="rate_4" value="{{$setting->rate_4}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                                <tr>
                                    <th>5등</th>
                                    <td><input type="text" class="form-control" id="rate_5" name="rate_5" value="{{$setting->rate_5}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                                <tr>
                                    <th>6등</th>
                                    <td><input type="text" class="form-control" id="rate_6" name="rate_6" value="{{$setting->rate_6}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                                <tr>
                                    <th>꽝</th>
                                    <td><input type="text" class="form-control" id="rate_7" name="rate_7" value="{{$setting->rate_7}}" style="display:inline-block;width:95%"> %</td>
                                </tr>
                            
                                
                            </tbody>
                        </table>
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
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });

       
        $('#btn_save_setting').click(function () {
            var rate_1 = $('#rate_1').val();
            var rate_2 = $('#rate_2').val();
            var rate_3 = $('#rate_3').val();
            var rate_4 = $('#rate_4').val();
            var rate_5 = $('#rate_5').val();
            var rate_6 = $('#rate_6').val();
            var rate_7 = $('#rate_7').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.lotto.postSetting') }}',
                data: {
                    rate_1: rate_1,
                    rate_2: rate_2,
                    rate_3: rate_3,
                    rate_4: rate_4,
                    rate_5: rate_5,
                    rate_6: rate_6,
                    rate_7: rate_7
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