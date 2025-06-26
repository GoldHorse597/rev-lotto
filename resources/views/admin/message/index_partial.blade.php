<form method="get">
    <ul class="nav nav-pills d-flex justify-content-end">
         <li class="nav-item mr-2 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('admin/app.user') @lang('admin/app.identity')</span>
                </div>
                <input class="form-control" type="text" name="identity" value="{{$identity}}">
            </div>
        </li>
        <li class="nav-item mr-2 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">이름</span>
                </div>
                <input class="form-control" type="text" name="name" value="{{$name}}">
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
                <th>받는 회원 아이디</th>
                <th>받는 회원 이름</th>
                <th>@lang('admin/app.subject')</th>
                <th>@lang('admin/app.status')</th>
                <th>@lang('admin/app.date')</th>
                <th>@lang('admin/app.manage')</th>
            </tr>
        </thead>
        <tbody>
            @if ($messages->isEmpty())
            <tr>
                @if (Auth::guard('admin')->user()->parent_level == 0)
                <td class="text-center" colspan="7"> @lang('admin/app.no_data') </td>
                @else
                <td class="text-center" colspan="5"> @lang('admin/app.no_data') </td>
                @endif
            </tr>
            @else
            @foreach ($messages as $index => $message)
            <tr>
                <td> {{ $messages->firstItem() + $index }} </td>
                <td>
                   <div>{{$message->identity}}</div>
                </td>
                <td>
                   <div>{{$message->name}}</div>
                </td>
                <td> {{ $message->title }} </td>
                <td> 
                    @if (empty($message->status))
                        <span class="badge badge-secondary">@lang('admin/app.unconfirmed')</span>
                    @else
                        <span class="badge badge-success">@lang('admin/app.confirmed')</span>
                    @endif
                </td>
                <td> {{ $message->created_at }} </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-primary btn-view text-white" data-id="{{$message->id}}"> @lang('admin/app.view') </button>
                        <button class="btn btn-danger btn-delete text-white" href="{{route('admin.message.delete', $message->id)}}"> @lang('admin/app.delete') </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $messages->appends(request()->except('page'))->links() }}
</div>
<script>
    $('.btn-view').on('click', function() {
        var $this = $(this);     
        var messageId = $(this).data('id');
        var $parent = $this.parents('tr');
        if ($parent.next().hasClass('messageContent')) {
            $('.table .messageContent').remove();
            $this.html('@lang('admin/app.view')');
        } else {
            $('.table .messageContent').remove();
            $this.html('@lang('admin/app.collapse')');
            $.ajax({
                type: 'POST',
                url: '{{route('admin.message.read', 'MESSAGE_ID')}}'.replace('MESSAGE_ID', messageId),
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
</script>