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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.inquiry_templates')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" data-toggle="modal" data-target="#inquiryTemplateCreateModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.create') </button>
            </div>
        </div>
        <div class="card-body">
            {!! $partial_view !!}
        </div>
    </div>
    <div class="modal fade" id="inquiryTemplateCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('admin/app.inquiry_template')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.inquirytemplate.create')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inquiryTemplateTitle" class="col-sm-4 col-form-label">@lang('admin/app.subject')</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <input type="text" class="form-control" id="inquiryTemplateTitle" name="title" value=""
                                        data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.subject')) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inquiryTemplateContent" class="col-sm-4 col-form-label">@lang('admin/app.content')</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <textarea class="rich-textarea form-control" id="inquiryTemplateContent" name="content"
                                        data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.content')) }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inquiryTemplateStatus" class="col-sm-4 col-form-label">@lang('admin/app.status')</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control" id="inquiryTemplateStatus" name="status" data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.status')) }}">
                                        <option value="0">@lang('admin/app.turn_off')</option>
                                        <option value="1">@lang('admin/app.turn_on')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
                        <button class="btn btn-success btn-create" type="submit">@lang('admin/app.create')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form id="deleteForm" action="" method="post">
        @method('DELETE')
        @csrf
    </form>
@endsection

@section('script')
    @parent
    <script>
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            let action = $(this).attr('href');
            alertify.confirm("공지사항 삭제", "공지사항을 삭제하시겠습니까?",
                function () {
                    $('#deleteForm').attr('action', action).submit();
                },
                function () {
                }
            );
        });
    </script>
@endsection