@extends('web.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
<section class="container">
  <h1 class="content-tit visual05">
    <span>마이페이지</span>
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
      <div class="bbs-view-w">
        <h3>{{$item->title}}</h3>
        <div class="bbs-write">
          <span>작성자: 관리자</span>
          <span>작성일자: {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
        </div>
        <div class="bbs-view">
          <font size="3">{!!$item->content!!}
          </font>
          <br>
          <br>
         
        </div>
        <b>
          <div class="list-relation">
            @if($prev && $prev->id)
            <div class="item">
              <span><img src="{{asset('/images/web/ico_aw_up.gif')}}"> 이전 쪽지 </span>
              <a href="message_view?id={{$prev->id}}">{{$prev->title}}</a>
            </div>
            @endif
            @if($next && $next->id)
            <div class="item">
              <span><img src="{{asset('/images/web/ico_aw_down.gif')}}"> 다음 쪽지</span>
              <a href="message_view?id={{$next->id}}">{{$next->title}}</a>
            </div>
            @endif
          </div>
        </b>
      </div>
      <b>
        <div class="btn-view">
          <a href="/mypage/message" class="btn-comm btn-bl">목록</a>
        </div>        
      </b>
    </div>    
  </div>
</section>
<script language="javascript">
  function search(){    
      bbs_search_form.submit();
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

