@extends('web.customer.app')
@section('subtitle', '공지')
@section('menu', 'notice')
@section('infocontent')  
<div class="inner-contents">
    <form name="bbs_search_form" method="get" action="/customer/notice">
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
         @foreach($notices as $index => $notice)
        <div class="item">       
            <div class="pw8p">{{$notices->firstItem() + $index }}</div>
            <div class="pwauto t-l">
                <a href="/customer/notice_view?id={{$notice->id}}">{{$notice->title}}</a>
            </div>
            <div class="pw15p">{{ \Carbon\Carbon::parse($notice->created_at)->format('Y/m/d') }}</div>
            <div class="pw10p">{{$notice->hits}}</div>
        </div>
        @endforeach
    </div>
    </div>
    <div class="paging">
    {{ $notices->appends(request()->except('page'))->links() }}
    </div>
</div>
@endsection