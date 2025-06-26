@extends('web.customer.app')
@section('subtitle', $type_name)
@section('menu', $type)
@section('infocontent')  
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
      @if($type != 'faq')
      <b><font color="red">리</font>
        <font color="green">버</font>
        <font color="orange">스</font>
        <font color="blue">로또</font>
      </b>
      @endif
    </div>
    @if($type == 'faq')
    <div class="message-box-gy">
      @if($item1 != null)
      {!!$item1->content!!}
      @endif
    </div>
    @endif
     @if($type != 'faq')
    <b>
      <div class="list-relation">
        <div class="item">
          <span>
            <img src="{{asset('/images/web/ico_aw_up.gif')}}"> 이전글 </span>
          <a href="{{$type}}_view?id={{$prev && $prev->id ? $prev->id :''}}">{{$prev && $prev->title?$prev->title:''}}</a>
        </div>
        <div class="item">
          <span>
            <img src="{{asset('/images/web/ico_aw_down.gif')}}"> 다음글 </span>
          <a href="{{$type}}_view?id={{$next && $next->id ? $next->id :''}}">{{$next && $next->title ? $next->title :''}}</a>
        </div>
      </div>
    </b>
     @endif
  </div>
  <b>
    <div class="btn-view">
      <a href="/customer/{{$type}}" class="btn-comm btn-bl">목록</a>
    </div>
    
  </b>
</div>
@endsection