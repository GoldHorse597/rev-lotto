@extends('web.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
@section('content')
<section class="container">
    <h1 class="content-tit visual02">
        <span>입금/출금</span>
    </h1>
    <div class="header">
        <h2>{{$title}}</h2>
        <div class="navi">
        <a href="/index.php">홈으로</a>
        <span>마이페이지</span>
        <span>{{$title}}</span>
        </div>
    </div>
    <div class="contents">    
        <div class="inner-contents">
        @if($type != 3)
        <form name="search_form" method="post" action="/mypage/{{$type == 1? 'deposit':'withdrawal'}}">
            @csrf
            <div class="search-box al-left">
            <div class="item  item-etc" style="justify-content: center" >
                <div class="item-inner m-justify-space">
                <span class="tit">신청금액</span>
                <input type="text" name="amount" id="amount" value="" class="w300 " onblur="roundToManUnit(this)">  
                </div>
            </div>
            </div>  
            <div class="mt30 al-center">
                <a href="#none" onclick="javascript:searchit();" class="btn-comm btn-bl w250">신 청</a>
            </div>      
        </form>
        @endif
        <h3 class="tit-h3 mt50">{{$type == 3? '입출금':'신청'}}내역 </h3>
        <div class="table-lisw-w table-type-mobile table-line-type buy-etc-list">
            <div class="item th-head">
            <div class="pw5p">번호</div>
            <div class="pw15p">종류</div>
            <div class="pw12p">금액</div>
            <div class="pw12p">상태</div>
            <div class="pwauto">신청일자</div>
            </div>
            @foreach($items as $index =>$item )
            <div class="tbody">
            <div class="item">
                <div class="pw5p none"> {{ $items->firstItem() + $index }} </div>
                @if($type != 3)
                <div class="pw15p last type">{{$type==1?'입금':'출금'}}</div>
                @else
                <div class="pw15p last type" style="color:{{$item->type == 0 ? 'red' : 'blue'}}">{{$item->type==0?'입금':'출금'}}</div>
                @endif
                <div class="pw12p charge-point">{{number_format(floor($item->amount),0)}}</div>
                @if($type != 3)
                <div class="pw12p"><span style="color:red">신청</span></div>
                @else
                <div class="pw12p"><span style="color:{{$item->status == 1 ? 'green' : 'red'}}">{{$item->status == 1 ? '승인' : '취소'}}</span></div>
                 @endif
                <div class="pwauto last save">{{ \Carbon\Carbon::parse($item->created_at)->format('Y.m.d H:i:s') }}</div>
            </div>
            </div>
            @endforeach
        </div>
        <div class="paging">
            {{ $items->appends(request()->except('page'))->links() }}
        </div>   
        </div>
    </div>
</section>
<script>
    function searchit(){

		frm = document.search_form;
		frm.submit();		
	}
    function roundToManUnit(input) {
        const value = parseInt(input.value);
    
        if (isNaN(value)) return;

        if (value % 10000 !== 0) {
            alert("금액은 만(10,000) 단위로만 입력 가능합니다.");
            input.value = ""; // 입력값 지우기
            input.focus();    // 다시 포커스 주기
        }
    }
    $('#amount').on('input', function() {
        let value = $(this).val();
        value = value.replace(/[^0-9]/g, ''); // 숫자만 남기기
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // 천단위 , 찍기
        $(this).val(value);
    });
</script>
@endsection