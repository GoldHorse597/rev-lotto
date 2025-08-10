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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.inquiry') @lang('admin/app.modify')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">@lang('admin/app.inquiry')@lang('admin/app.modify')</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.inquiry.list')}}" >
                        목록으로 가기
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="main_info">
                    <form id="inquiryEditForm" name="inquiryEditForm" action="{{route('admin.inquiry.edit', $inquiry->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="mode" value="0">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" style="min-width: 600px;">
                                <tbody>
                                   
                                    <tr>
                                        <th>제목</th>
                                        <td class="form-group">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $inquiry->title }}" placeholder="제목을 입력하세요" required>                                                 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>내용</th>
                                        <td class="form-group">
                                            <textarea
                                                class="rich-textarea form-control"
                                                id="content"
                                                name="content"
                                                rows="10"
                                                placeholder="내용을 입력하세요"
                                                required
                                                data-rule-required="true"
                                                data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.content')) }}"
                                            >{!! $inquiry->content !!}</textarea>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <th>답변</th>
                                        <td class="form-group">
                                            <textarea
                                                class="rich-textarea form-control"
                                                id="reply"
                                                name="reply"
                                                rows="10"
                                                placeholder="답변을 입력하세요"
                                                required
                                                data-rule-required="true"
                                                data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.content')) }}"
                                            >{!! $reply->content !!}</textarea>
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
        function searchit(id) {
            frm = document.userEditForm;
            if(id ==1)
                frm.mode.value = 1;
            else
                frm.mode.value = 2;
            frm.submit();
        }
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