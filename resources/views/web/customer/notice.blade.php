@extends('web.customer.app')
@section('subtitle', '공지')
@section('menu', 'notice')
@section('infocontent')  
<div class="inner-contents">
    <form name="bbs_search_form" method="post" action="/ver_02/w_customer/event.php?code=event&amp;search_item='+this.value">
    <div class="table-head">
        <div class="search-w">
        <select id="ts_select" name="search_item">
            <option value="1">제목</option>
            <option value="2">내용</option>
            <option value="3">제목 + 내용</option>
        </select>
        <input type="text" name="search_order" id="ts_txt" value="">
        <button type="button" onclick="javascript:search();" title="검색">
            <img src="../asset/images/btn_search.png" alt="검색">
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
        <div class="item">
        <div class="pw8p">398</div>
        <div class="pwauto t-l">
            <a href="./event_view.php?bbs_data=aWR4PTcwMTkmc3RhcnRQYWdlPTAmbGlzdE5vPTM5OCZ0YWJsZT1jc19iYnNfZGF0YSZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||">[5월이벤트-3] 2025 Contra el Cancer 항암 특별복권 이벤트 (실버등..</a>
        </div>
        <div class="pw15p">2025/05/14</div>
        <div class="pw10p">173</div>
        </div>
    </div>
    </div>
    <div class="paging">
    <a href="#none" class="btn-num on">1</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTI1JmNvZGU9ZXZlbnQmdGFibGU9Y3NfYmJzX2RhdGEmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0mY2F0ZV9uYW1lPQ==||" class="btn-num">2</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTUwJmNvZGU9ZXZlbnQmdGFibGU9Y3NfYmJzX2RhdGEmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0mY2F0ZV9uYW1lPQ==||" class="btn-num">3</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTc1JmNvZGU9ZXZlbnQmdGFibGU9Y3NfYmJzX2RhdGEmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0mY2F0ZV9uYW1lPQ==||" class="btn-num">4</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTEwMCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">5</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTEyNSZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">6</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTE1MCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">7</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTE3NSZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">8</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTIwMCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">9</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTIyNSZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">10</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTI1MCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">11</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTI3NSZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">12</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTMwMCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">13</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTMyNSZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">14</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTM1MCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">15</a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTM3NSZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">
        <img src="../asset/images/arrow_next.png" alt="다음">
    </a>
    <a href="/ver_02/w_customer/event.php?bbs_data=c3RhcnRQYWdlPTM1MCZjb2RlPWV2ZW50JnRhYmxlPWNzX2Jic19kYXRhJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9JmNhdGVfbmFtZT0=||" class="btn-num">
        <img src="../asset/images/arrow_next_double.png" alt="맨 마지막">
    </a>
    </div>
</div>
@endsection