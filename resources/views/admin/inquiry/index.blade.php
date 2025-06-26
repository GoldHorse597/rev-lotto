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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.inquiry')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-end">
                @if (Auth::guard('admin')->user()->parent_level > 0)
                <button class="btn btn-success" data-toggle="modal" data-target="#sendInquiryModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.new_inquiry') </button>
                <button class="btn btn-success ml-2" id="btn_bank_inquiry">
                    <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.bank_inquiry') </button>
                @endif
                <button class="btn btn-primary ml-2" id="btn_read_all">
                    <i class="fas fa-edit fa-sm text-white-50"></i> @lang('admin/app.all') @lang('admin/app.read') </button>
                <button class="btn btn-danger ml-2" id="btn_delete_all">
                    <i class="fas fa-trash fa-sm text-white-50"></i> @lang('admin/app.all') @lang('admin/app.delete') </button>
            </div>
        </div>
        <div class="card-body">
            {!! $partial_view !!}
        </div>
    </div>
    @if (Auth::guard('admin')->user()->parent_level > 0)
    <div class="modal fade" id="sendInquiryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('admin/app.new_inquiry')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.inquiry.send')}}" id="inquiryForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inquiryTitle" class="col-sm-4 col-form-label">@lang('admin/app.subject')</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <input type="text" class="form-control" id="inquiryTitle" name="title" value=""
                                        data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.subject')) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inquiryContent" class="col-sm-4 col-form-label">@lang('admin/app.content')</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <textarea class="form-control" id="inquiryContent" name="content" rows="10"
                                        data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.content')) }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
                        <button class="btn btn-success" type="submit">@lang('admin/app.send')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <form id="deleteForm" action="" method="post">
        @method('DELETE')
        @csrf
    </form>
@endsection

@section('script')
    @parent
    <script>
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });

        @if (Auth::guard('admin')->user()->parent_level > 0)
        $(document).on('submit', '#inquiryForm', function(e) {
            e.preventDefault();
            var inquiryTitle = $(this).find('#inquiryTitle').val();
            var inquiryContent = $(this).find('#inquiryContent').val();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: { title: inquiryTitle, content: inquiryContent },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success) {
                        alertify.alert('', data.msg);
                        window.location.reload();
                    }
                    else {
                        if (data.msg)
                            alertify.alert('오류', data.msg);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete : function() {
                }
            });
        });

        $('#btn_bank_inquiry').click(function (e) {
            alertify.confirm("계좌문의", "계좌문의 메시지를 전송하시겠습니까?",
                function () {
                    $('#inquiryTitle').val('계좌문의');
                    $('#inquiryContent').val('입금 계좌문의 드립니다!');
                    $('#inquiryForm').submit();
                },
                function () {
                }
            );
        });
        @endif

        $('#btn_read_all').click(function (e) {
            e.preventDefault();
            @if (Auth::guard('admin')->user()->parent_level == 0)
            alertify.confirm("1:1문의 읽기", "전체 1:1문의를 읽기하시겠습니까?",
            @else
            alertify.confirm("1:1문의 읽기", "전체 1:1문의답변을 읽기하시겠습니까?",
            @endif
                function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.inquiry.readall') }}',
                        data: {},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.success) {
                                alertify.alert('', data.msg);
                                window.location.reload();
                            }
                            else {
                                if (data.msg) 
                                    alertify.alert('오류', data.msg);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        },
                        complete : function() {
                        }
                    });
                },
                function () {
                }
            );
        });

        $('#btn_delete_all').click(function (e) {
            e.preventDefault();
            let action = '{{ route('admin.inquiry.deleteall') }}';
            alertify.confirm("1:1문의 삭제", "전체 1:1문의를 삭제하시겠습니까?",
                function () {
                    $('#deleteForm').attr('action', action).submit();
                },
                function () {
                }
            );
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            let action = $(this).attr('href');
            alertify.confirm("1:1문의 삭제", "1:1문의를 삭제하시겠습니까?",
                function () {
                    $('#deleteForm').attr('action', action).submit();
                },
                function () {
                }
            );
        });
    </script>
@endsection