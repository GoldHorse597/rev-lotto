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
        <h1 class="h3 mb-0 text-gray-800">@lang('admin/app.message')</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">            
            <div class="d-flex justify-content-end">
                @if (Auth::guard('admin')->user()->parent_level == 0)
                <button class="btn btn-success" data-toggle="modal" data-target="#sendMessageModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i> @lang('admin/app.new_message') </button>
                @else
                <button class="btn btn-primary ml-2" id="btn_read_all">
                    <i class="fas fa-edit fa-sm text-white-50"></i> @lang('admin/app.all') @lang('admin/app.read') </button>
                @endif
                <button class="btn btn-danger ml-2" id="btn_delete_all">
                    <i class="fas fa-trash fa-sm text-white-50"></i> @lang('admin/app.all') @lang('admin/app.delete') </button>
            </div>
        </div>
        <div class="card-body">
            {!! $partial_view !!}
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

        @if (Auth::guard('admin')->user()->parent_level > 0)
        $('#btn_read_all').click(function (e) {
            e.preventDefault();
            alertify.confirm("쪽지 읽기", "전체 쪽지를 읽기하시겠습니까?",
                function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.message.readall') }}',
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
        @endif

        $('#btn_delete_all').click(function (e) {
            e.preventDefault();
            let action = '{{ route('admin.message.deleteall') }}';
            alertify.confirm("쪽지 삭제", "전체 쪽지를 삭제하시겠습니까?",
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
            alertify.confirm("쪽지 삭제", "쪽지를 삭제하시겠습니까?",
                function () {
                    $('#deleteForm').attr('action', action).submit();
                },
                function () {
                }
            );
        });
    </script>
@endsection