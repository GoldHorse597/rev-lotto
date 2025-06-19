<div class="dropdown">
@if($member instanceof App\Models\User)
    <div class="dropdown">
        <a class="d-block dropdown-toggle text-decoration-none text-dark" href="#" data-toggle="dropdown" aria-expanded="true">
            <div>{{$member->nickname}}</div>
            <code>{{'@'.$member->identity}}</code>
        </a>
        <div class="dropdown-menu">
            <h6 class="dropdown-header">@lang('admin/app.user')</h6>
            <a class="dropdown-item" href="{{route('admin.user.edit', $member->id)}}"> @lang('admin/app.modify') </a>
        </div>
    </div>
@else
    @if ($member->id == Auth::guard('admin')->user()->id)
    <a class="d-block dropdown-toggle text-decoration-none text-info " href="#" data-toggle="dropdown">
        <div>{{$member->nickname}}</div>
        <code>{{'@'.$member->identity}}</code>
    </a>
    <div class="dropdown-menu">
        <h6 class="dropdown-header">@lang('admin/app.agent')</h6>
        <a class="dropdown-item" href="{{route('admin.agent.settings')}}"> @lang('admin/app.modify') </a>
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">@lang('admin/app.user')</h6>
        <a class="dropdown-item" href="{{route('admin.user.list', ['agentUsername'=>$member->identity])}}"> @lang('admin/app.users') </a>
    </div>
    @else
    <a class="d-block dropdown-toggle text-decoration-none text-dark " href="#" data-toggle="dropdown">
        <div>{{$member->nickname}}</div>
        <code>{{'@'.$member->identity}}</code>
    </a>
    <div class="dropdown-menu">
        <h6 class="dropdown-header">@lang('admin/app.agent')</h6>
        <a class="dropdown-item" href="{{route('admin.agent.edit', $member->id)}}"> @lang('admin/app.modify') </a>
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">@lang('admin/agent.child_user')</h6>
        <a class="dropdown-item" href="{{route('admin.user.list', ['agentUsername'=>$member->identity])}}"> @lang('admin/app.users') </a>
    </div>
    @endif
@endif
</div>