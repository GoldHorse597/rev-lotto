<form method="get">
    <ul class="nav nav-pills d-flex justify-content-end">
        <li class="nav-item mr-2 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('admin/app.subject')</span>
                </div>
                <input class="form-control" type="text" name="title" value="{{request()->get('title')}}">
            </div>
        </li>
        <li class="nav-item mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search fa-sm text-white-50"></i>
                @lang('admin/app.search')
            </button>
        </li>
    </ul>
</form>
<div class="table-responsive" style="min-height: 500px;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>@lang('admin/app.number')</th>
                @if (Auth::guard('admin')->user()->parent_level == 0)
                <th>@lang('admin/app.sender')</th>
                @endif
                <th>@lang('admin/app.subject')</th>
                <th>@lang('admin/app.content')</th>
                <th>@lang('admin/app.status')</th>
                <th>@lang('admin/app.date')</th>
                <th>@lang('admin/app.manage')</th>
            </tr>
        </thead>
        <tbody>
            @if ($inquiries->isEmpty())
            <tr>
                @if (Auth::guard('admin')->user()->parent_level == 0)
                <td class="text-center" colspan="7"> @lang('admin/app.no_data') </td>
                @else
                <td class="text-center" colspan="6"> @lang('admin/app.no_data') </td>
                @endif
            </tr>
            @else
            @foreach ($inquiries as $index => $inquiry)
            <tr>
                <td> {{ $inquiries->firstItem() + $index }} </td>
                @if (Auth::guard('admin')->user()->parent_level == 0)
                <td>
                    <div class="dropdown">
                        <a class="d-block dropdown-toggle text-decoration-none text-dark" href="#" data-toggle="dropdown" aria-expanded="true">
                            <div>{{$inquiry->sender_nickname}}</div>
                            <code>{{'@'.$inquiry->sender_identity}}</code>
                        </a>
                        <div class="dropdown-menu">
                            <h6 class="dropdown-header">@lang('admin/app.user')</h6>
                            <a class="dropdown-item" href="{{route('admin.user.edit', $inquiry->sender_id)}}"> @lang('admin/app.modify') </a>
                        </div>
                    </div>
                </td>
                @endif
                <td> {{ $inquiry->title }} </td>
                <td> {{ $inquiry->content }} </td>
                <td> 
                    @if (empty($inquiry->status == 2))
                        <span class="badge badge-secondary">@lang('admin/app.unconfirmed')</span>
                    @else
                        <span class="badge badge-success">@lang('admin/app.confirmed')</span>
                    @endif
                </td>
                <td> {{ $inquiry->created_at }} </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-warning btn-view text-white" data-id="{{$inquiry->id}}"> @lang('admin/app.view') </button>
                        <a class="btn btn-primary" href="{{route('admin.inquiry.edit', $inquiry->id)}}"> @lang('admin/app.modify') </a>
                        <button class="btn btn-danger btn-delete text-white" href="{{route('admin.inquiry.delete', $inquiry->id)}}"> @lang('admin/app.delete') </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $inquiries->appends(request()->except('page'))->links() }}
</div>
<script>
    $('.btn-view').on('click', function() {
        var $this = $(this);     
        var inquiryId = $(this).data('id');
        var $parent = $this.parents('tr');
        if ($parent.next().hasClass('inquiryContent')) {
            $('.table .inquiryContent').remove();
            $this.html('@lang('admin/app.view')');
        } else {
            $('.table .inquiryContent').remove();
            $this.html('@lang('admin/app.collapse')');
            $.ajax({
                type: 'POST',
                url: '{{route('admin.inquiry.read', 'INQUIRY_ID')}}'.replace('INQUIRY_ID', inquiryId),
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success) {
                        $parent.after(data.html);
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
        }
    });

    @if (Auth::guard('admin')->user()->parent_level == 0)
    $(document).on('click', '.btn-template', function() {
        var replyContent = $(this).data('content');
        $('#replyContent').val(replyContent);
    });
    
    $(document).on('click', '.btn-reply', function() {
        var replyContent = $('#replyContent').val();
        if (!replyContent) {
            alertify.alert('알림', '답변글을 입력하세요.');
            return;
        }
        var inquiryId = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: '{{route('admin.inquiry.reply', 'INQUIRY_ID')}}'.replace('INQUIRY_ID', inquiryId),
            data: { content: replyContent },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.success) {
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
    @endif
</script>