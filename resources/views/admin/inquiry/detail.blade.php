<tr class="inquiryContent">
    <td></td>
    <td colspan="6">
        <div class="panel panel-primary">
            <div class="panel-heading clearfix">
                <strong class="title" style="color: #ffcc00">@lang('admin/app.content'):</strong>
            </div>
            <div class="panel-body"> <span class="ng-binding">{!! $inquiry->content !!}</span> </div>
        </div>
        @foreach ($reply_inquiries as $reply_inquiry)
        <div class="panel panel-primary mt-2">
            <div class="panel-heading clearfix">
                <strong class="title" style="color: #ffcc00">@lang('admin/app.reply'):</strong> <span class="ml-4">[{{ $reply_inquiry->created_at }}]</span>
            </div>
            <div class="panel-body"> <span class="ng-binding">{!! $reply_inquiry->content !!}</span> </div>
        </div>
        @endforeach
        @if (Auth::guard('admin')->user()->parent_level == 0)
            @if ($reply_inquiries->isEmpty())
            <div class="panel panel-primary">
                <div class="panel-body">
                    <textarea class="form-control mt-1 mb-1" id="replyContent" name="replyContent" rows="5"></textarea>
                    <div class="row">
                        <div class="col-md-10 text-wrap">
                            @foreach($inquiry_templates as $inquiry_template)
                            <button class="btn btn-warning btn-template text-white mr-1 mb-1" data-content="{{ $inquiry_template->content }}"> {{ $inquiry_template->title }} </button>
                            @endforeach
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-reply text-white float-right" data-id="{{ $inquiry->id }}"> @lang('admin/app.reply') </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </td>
</tr>