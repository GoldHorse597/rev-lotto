@extends('web.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
@section('content')
<section class="container">
  <h1 class="content-tit visual05">
    <span>고객센터</span>
  </h1>
  <div class="header">
    <h2>@yield('subtitle', '공지사항')</h2>
    <div class="navi">
      <a href="/index.php">홈으로</a>
      <span>고객센터</span>
      <span>@yield('subtitle', '공지사항')</span>
    </div>
  </div>
  <div class="contents">
    <ul class="depth2-menu menu-item-9">     
      <li class="item {{ (trim($__env->yieldContent('menu')) == 'notice') ? 'select' : '' }}">
        <a href="/customer/notice">공지사항</a>
      </li>
      <li class="item {{ (trim($__env->yieldContent('menu')) == 'event') ? 'select' : '' }}">
        <a href="/customer/event">이벤트</a>
      </li>     
      <li class="item {{ (trim($__env->yieldContent('menu')) == 'faq') ? 'select' : '' }}">
        <a href="/customer/faq">1:1문의</a>
      </li>
      <!-- <li class="item {{ (trim($__env->yieldContent('menu')) == 'message') ? 'select' : '' }}">
        <a href="/mypage/message">받은쪽지함</a>
      </li> -->
      
    </ul>
    {{-- 컨텐츠 --}}
    @yield('infocontent')
    
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
@endsection