@extends('web.layouts.app')

@section('content') 
    <section class="container">
      <h1 class="content-tit visual04">
        <span>로또안내</span>
      </h1>
      <div class="header">
        <h2>@yield('infotitle', '파워볼') 안내</h2>
        
        <div class="navi">
          <a href="/">홈으로</a>
          <span>로또안내</span>
          <span>@yield('infotitle', '파워볼') 안내</span>
        </div>
      </div>
      <div class="contents">
        <ul class="depth2-menu">
          <li class="item {{ (trim($__env->yieldContent('menu')) == 'pb') ? 'select' : '' }}">
            <a href="/info/lotto_pb">파워볼(미국) 안내</a>
          </li>
          <li class="item {{ (trim($__env->yieldContent('menu')) == 'mm') ? 'select' : '' }}">
            <a href="/info/lotto_mm">메가밀리언(미국) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_sl">실시간로또 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_nl">로또6/45(한국) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_cfl">연금720(한국) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_em">쌍색구(중국) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_eg">따루토(중국) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_lp">로또6(일본) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_ej">로또7(일본) 안내</a>
          </li>
          <li class="item ">
            <a href="/info/lotto_ed">미니로또(일본) 안내</a>
          </li>
         
        </ul>
        {{-- 컨텐츠 --}}
        @yield('infocontent')
      </div>
    </section> 
@endsection