@extends('web.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
<section class="container">
  <h1 class="content-tit visual05">
    <span>고객센터</span>
  </h1>
  <div class="header">
    <h2>받은 쪽지함</h2>
    <div class="navi">
      <a href="/index.php">홈으로</a>
      <span>마이페이지</span>
      <span>@yield('subtitle', '쪽지')</span>
    </div>
  </div>
  <div class="contents">
    
    <div class="inner-contents">
        <form name="bbs_search_form" method="get" action="/mypage/message">
        <div class="table-head">
            <div class="search-w">
                <span class="search_span">제목</span>
                <input type="text" name="title" id="ts_txt" value="{{$title}}">
                <button type="button" onclick="javascript:search();" title="검색">
                    <img src="{{asset('images/web/btn_search.png')}}" alt="검색">
                </button>
            </div>
            <div class="list-tit">전체쪽지수: <em class="t-red">{{$totalCnt}}</em>건 </div>
        </div>
        </form>
        <div class="table-lisw-w type-bbs mt20">
        <div class="item th-head">
            <div class="pw8p">상태</div>
            <div class="pwauto">제목</div>
            <div class="pw15p">작성일</div>
            <div class="pw10p">비고</div>
        </div>
        <div class="tbody">
            @foreach($messages as $message)
            <div class="item">       
                <div class="pw8p" style="color:{{ $message->status == 0 ? 'red' : 'green'}}">{{ $message->status == 0 ? '읽지 않음' : '읽음' }}</div>
                <div class="pwauto align-items-center">
                    <a href="/mypage/message_view?id={{$message->id}}">{{$message->title}}</a>
                </div>
                <div class="pw15p">{{ \Carbon\Carbon::parse($message->created_at)->format('Y/m/d') }}</div>
                <div class="pw10p">
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteMessage({{ $message->id }});">삭제</button>
                </div>
            </div>
            @endforeach
        </div>
        </div>
        <div class="paging">
        {{ $messages->appends(request()->except('page'))->links() }}
        </div>
    </div>
    
  </div>
</section>
<script language="javascript">
    function search(){    
        bbs_search_form.submit();
    }
    function deleteMessage(id) {
        if (!confirm('정말 삭제하시겠습니까?')) return;

        $.ajax({
            url: '/mypage/message/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('삭제되었습니다.');
                location.reload();  // 새로고침
            },
            error: function(xhr) {
                alert('삭제 실패: ' + xhr.responseText);
            }
        });
    }
</script>

<style>
.search_span{
    width: 70px;
    border: 1px solid #e0e0e0;
    text-align: center;
    align-content: center;
}
</style>

