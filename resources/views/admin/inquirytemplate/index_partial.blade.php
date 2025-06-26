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
                <th width="5%">@lang('admin/app.number')</th>
                <th width="15%">@lang('admin/app.subject')</th>
                <th width="40%">@lang('admin/app.content')</th>
                <th width="10%">@lang('admin/app.status')</th>
                <th width="10%">@lang('admin/app.manage')</th>
            </tr>
        </thead>
        <tbody>
            @if ($inquiryTemplates->isEmpty())
            <tr>
                <td class="text-center" colspan="5"> @lang('admin/app.no_data') </td>
            </tr>
            @else
            @foreach ($inquiryTemplates as $index => $inquiryTemplate)
            <tr>
                <td> {{ $inquiryTemplates->firstItem() + $index }} </td>
                <td>
                    <input type="text" class="form-control" name="title" value="{{ $inquiryTemplate->title }}">
                </td>
                <td>
                    <textarea class="form-control" name="content" rows="3">{{ $inquiryTemplate->content }}</textarea>
                </td>
                <td>
                    <input type="checkbox" class="checkbox-inquirytemplate-status" name="status" data-toggle="switch" data-size="small" data-on-color="success" 
                            data-on-text="@lang('admin/app.turned_on')" data-off-text="@lang('admin/app.turned_off')" {{ $inquiryTemplate->status == 1 ? 'checked' : '' }}>
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-primary btn-edit text-white" href="{{route('admin.inquirytemplate.edit', $inquiryTemplate->id)}}"> @lang('admin/app.modify') </a>
                        <button class="btn btn-danger btn-delete text-white" href="{{route('admin.inquirytemplate.delete', $inquiryTemplate->id)}}"> @lang('admin/app.delete') </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $inquiryTemplates->appends(request()->except('page'))->links() }}
</div>
<script>
    $('[data-toggle="switch"]').bootstrapSwitch();

    $('.btn-edit').on('click', function() {
        var $this = $(this);
        var $parent = $(this).parents('tr');
        var url = $(this).attr('href');
        var title = $('input[name=title]', $parent).val();
        var content = $('textarea[name=content]', $parent).val();
        var status = $('input[name=status]', $parent).is(':checked') ? 1 : 0;
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                title: title,
                content: content,
                status: status
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.success) {
                    alertify.alert('알림', data.msg);
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
</script>