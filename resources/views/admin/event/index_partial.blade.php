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
                <th>@lang('admin/app.subject')</th>
                <th>@lang('admin/app.status')</th>
                <th>@lang('admin/app.manage')</th>
            </tr>
        </thead>
        <tbody>
            @if ($events->isEmpty())
            <tr>
                <td class="text-center" colspan="4"> @lang('admin/app.no_data') </td>
            </tr>
            @else
            @foreach ($events as $index => $event)
            <tr>
                <td> {{ $events->firstItem() + $index }} </td>
                <td> {{ $event->title }} </td>
                <td>
                    @switch ($event->status)
                        @case(0)
                            <span class="badge badge-warning p-2">@lang('admin/app.waiting')</span>
                            @break
                        @case(1)
                            <span class="badge badge-success p-2">@lang('admin/app.normal')</span>
                            @break
                        @case(2)
                            <span class="badge badge-danger p-2">@lang('admin/app.blocked')</span>
                            @break
                    @endswitch
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary text-white" href="{{route('admin.event.edit', $event->id)}}"> @lang('admin/app.modify') </a>
                        <button class="btn btn-danger btn-delete text-white" href="{{route('admin.event.delete', $event->id)}}"> @lang('admin/app.delete') </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $events->appends(request()->except('page'))->links() }}
</div>