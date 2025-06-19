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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.notices')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" data-toggle="modal" data-target="#noticeCreateModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.new_notice') </button>
            </div>
        </div>
        <div class="card-body">
            {!! $partial_view !!}
        </div>
    </div>
    <div class="modal fade" id="noticeCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('admin/app.new_notice')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.notice.create')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="noticeTitle" class="col-sm-4 col-form-label">@lang('admin/app.notice') @lang('admin/app.subject')</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <input type="text" class="form-control" id="noticeTitle" name="title" value=""
                                        data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.subject')) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noticeContent" class="col-sm-4 col-form-label">@lang('admin/app.notice') @lang('admin/app.content')</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <textarea class="rich-textarea form-control" id="noticeContent" name="content"
                                        data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.content')) }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noticeStatus" class="col-sm-4 col-form-label">@lang('admin/app.status')</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control" id="noticeStatus" name="status" data-rule-required="true" data-msg-required="{{ sprintf(trans('admin/app.required'), trans('admin/app.status')) }}">
                                        <option value="0">@lang('admin/app.waiting')</option>
                                        <option value="1">@lang('admin/app.normal')</option>
                                        <option value="2">@lang('admin/app.blocked')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('admin/app.cancel')</button>
                        <button class="btn btn-success" type="submit">@lang('admin/app.create')</button>
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
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
        });

        new FroalaEditor('textarea.rich-textarea', {
            key: 'qc1H2pF1B2D3B6C6D5F5hffeitF4A2C-9rscA5A4D4B3E4C2E2E3D1A3==',
            attribution: false,
            charCounterCount: false,
            fontSize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48', '60', '72', '96'],
            toolbarButtons: {
                'moreText': {
                    'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
                },
                'moreParagraph': {
                    'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
                },
                'moreMisc': {
                    'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help']
                }
            },
            events: {
                "image.beforeUpload": function(files) {
                    var editor = this;
                    if (files.length) {
                        // Create a File Reader.
                        var reader = new FileReader();
                        // Set the reader to insert images when they are loaded.
                        reader.onload = function(e) {
                            var result = e.target.result;
                            editor.image.insert(result, null, null, editor.image.get());
                        };
                        // Read image as base64.
                        reader.readAsDataURL(files[0]);
                    }
                    editor.popups.hideAll();
                    // Stop default upload chain.
                    return false;
                }
            }
        });

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