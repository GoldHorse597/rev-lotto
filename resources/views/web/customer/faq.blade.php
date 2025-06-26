@extends('web.customer.app')
@section('subtitle', '1:1 문의')
@section('menu','faq')
@section('infocontent')  
<div class="inner-contents">
    
    <form name="bbs_search_form" method="get" action="/customer/faq">
    <div class="table-head">
        <div class="search-w">
            <span class="search_span">제목</span>
            <input type="text" name="title" id="ts_txt" value="{{$title}}">
            <button type="button" onclick="javascript:search();" title="검색">
                <img src="{{asset('images/web/btn_search.png')}}" alt="검색">
            </button>
        </div>
        <div class="list-tit">전체문의수: <em class="t-red">{{$totalCnt}}</em>건 </div>
    </div>
    </form>
    <div class="table-lisw-w type-bbs mt20">
        <div class="item th-head">
            <div class="pw8p">번호</div>
            <div class="pwauto">제목</div>
            <div class="pw15p">작성일</div>
            <div class="pw10p">구분</div>
        </div>
        <div class="tbody">
            @foreach($faqs as $index => $faq)
            <div class="item">       
                <div class="pw8p">{{$faqs->firstItem() + $index }}</div>
                <div class="pwauto t-l">
                    <a href="/customer/faq_view?id={{$faq->id}}">{{$faq->title}}</a>
                </div>
                <div class="pw15p">{{ \Carbon\Carbon::parse($faq->created_at)->format('Y/m/d') }}</div>
                <div class="pw10p" style="color:{{$faq->status == 0?'green':'red'}}">{{$faq->status == 0?'답변중':'답변완료'}}</div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="paging">
    {{ $faqs->appends(request()->except('page'))->links() }}
    </div>
    <h3 class="tit-h3 mt50">1:1문의 사항</h3>
    <form name="form" method="post" action="/customer/faq_write" style="margin-bottom:10px">
        @csrf
        <input type="hidden" name="mode" value="insert">
        <div class="bbs-edit">
            <input type="text" name="name" id="name_txt" value="{{Auth::user()->name}}" class="w100p" placeholder="이름">
            <input type="text" name="title" id="tit_txt" class="w100p" placeholder="제목">
            <textarea class="w100p" id="con_ta" name="content"></textarea>
        </div>

        <div class="btn-view" style="margin-top:10px">
            <button onclick="sendit_qna();" class="btn-comm btn-bl" type="button">작성완료</button>
        </div>
    </form>
</div>
<script language="javascript">
<!--
    const hasPendingFaq = @json($hasPendingFaq);
	function sendit_qna(){
        if (hasPendingFaq) {
            alert("이전 질문을 확인하세요");
            return;
        }
		frm = document.form;
		if(frm.name.value==""){
			alert ("이름을 입력하세요");
			frm.name.focus();
		}else if(frm.title.value==""){
			alert ("제목을 입력하세요");
			frm.title.focus();
		}else if(frm.content.value==""){
			alert ("내용을 입력하세요");
			frm.content.focus();
		}else{
			frm.submit();
		}
	}
//-->
</script>
@endsection