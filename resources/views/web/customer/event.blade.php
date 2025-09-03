@extends('web.customer.app')
@section('subtitle', '이벤트')
@section('menu', 'event')
@section('infocontent')  
<div class="inner-contents">
    <form name="bbs_search_form" method="get" action="/customer/event">
    <div class="table-head">
        <div class="search-w">
            <span class="search_span">제목</span>
            <input type="text" name="title" id="ts_txt" value="{{$title}}">
            <button type="button" onclick="javascript:search();" title="검색">
                <img src="{{asset('images/web/btn_search.png')}}" alt="검색">
            </button>
        </div>
        <div class="list-tit">전체게시물수: <em class="t-red">{{$totalCnt}}</em>건 </div>
    </div>
    </form>
    <div class="table-lisw-w type-bbs mt20">
    <div class="item th-head">
        <div class="pw8p">번호</div>
        <div class="pwauto">제목</div>
        <div class="pw15p">작성일</div>
        <div class="pw10p">조회</div>
    </div>
    <div class="tbody">
         @foreach($events as $index => $event)
        <div class="item">       
            <div class="pw8p">{{$events->firstItem() + $index }}</div>
            <div class="pwauto t-l">
                <a href="/customer/event_view?id={{$event->id}}">{{$event->title}}</a>
            </div>
            <div class="pw15p">{{ \Carbon\Carbon::parse($event->created_at)->format('Y/m/d') }}</div>
            <div class="pw10p">{{$event->hits}}</div>
        </div>
        @endforeach
    </div>
    </div>
    <div class="paging">
    {{ $events->appends(request()->except('page'))->links() }}
    </div>
</div>
@endsection