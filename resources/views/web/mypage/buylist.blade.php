@extends('web.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
<section class="container">
  <h1 class="content-tit visual05">
    <span>고객센터</span>
  </h1>
  <div class="header">
    <h2>거래(구매내역)</h2>
    <div class="navi">
      <a href="/index.php">홈으로</a>
      <span>마이페이지</span>
      <span>@yield('subtitle', '거래(구매내역)')</span>
    </div>
  </div>
  <div class="contents">
    
    <div class="inner-contents">
        <form name="items" method="get" action="{{ route('mypage.buy_list') }}">
            @csrf
                <div class="search-box al-left">
                   <!-- <div class="item">
                        <div class="item-inner m-justify-space">
                            <span class="tit">구매일자</span>
                            <input type="text" name="trade_start_date" id="trade_start_date" readonly value=""  class="w150"> <span class="dash">~</span>
                            <input type="text" name="trade_end_date"  id="trade_end_date"  readonly value="" class="w150"> 
                        </div>
                    </div> -->
                    <!-- <div class="item">
                        <div class="item-inner m-justify-space">
                            <span class="tit">추첨일자</span>
                            <input type="text" name="lottery_start_date" id="lottery_start_date" readonly value="" class="w150"> <span class="dash">~</span>
                            <input type="text" name="lottery_end_date" id="lottery_end_date" readonly value="" class="w150">
                        </div>
                    </div> -->
                    <div class="item item-etc">
                        <!-- <div class="item-inner item-order">
                            <span class="tit">주문번호</span>
                            <input type="text" name="trade_code" id="trade_code " value="" class="w150">
                        </div> -->
                       
                        <div class="item-inner item-stats">
                            <span class="tit">복권종류</span> 

							<select name="part_idx" id="part_idx" class="w150">
                                <option value="" selected="selected">전체</option>
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}" {{ $part_idx == $game->id ? 'selected' : '' }}>
                                        {{ $game->game }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="item-inner item-stats">
                            <span class="tit">결과</span> 

							<select name="status" id="status" class="w150">
                                <option value="" {{ ($status === null || $status === '') ? 'selected' : '' }}> 전체 </option>
                                <option value="0" {{ ($status === 0 || $status === '0') ? 'selected' : '' }}>결과 대기중</option>
                                <option value="1" {{ ($status === 1 || $status === '1') ? 'selected' : '' }}>결과 처리됨</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="mt30 al-center">
                    <a href="#none" onclick="javascript:searchit();" class="btn-comm btn-bl w250">조회하기</a>
                </div>
			</form>
        <div class="table-lisw-w type-bbs mt20">
           <div class="item th-head">
                <div class="w20p">구매일</div>
                <div class="w20p">복권종류</div>
                <div class="pwauto">번호</div>
                <div class="pwauto">금액</div>
                <div class="w15p">당첨여부</div>
                <div class="pwauto">수익금</div>
            </div>
            <div class="tbody">
                @foreach($lists as $list)
                <div class="item">
                    <div class="w20p">{{ \Carbon\Carbon::parse($list->created_at)->format('Y-m-d H:i:s') }}</div>
                    <div class="w20p">{{$list->game}}{{$list->reverse == 1?' - 리버스로또':''}}</div>
                    <div class="pwauto">
                        {{$list->list}}
                        @if(!empty($list->bonus))
                            ,<span style="color:red">{{$list->bonus}}</span>
                        @endif
                    </div>
                    <div class="pwauto">{{number_format(floor($list->amount),0)}}</div>
                    <div class="w15p">
                        @if ($list->status == 0)
                            결과대기중
                        @elseif ($list->result == 0)
                            미당첨
                        @else
                            {{ $list->result }}등
                        @endif
                    </div>
                    <div class="pwauto">{{number_format(floor($list->amount),0)}}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="paging">
         {{ $lists->appends(request()->except('page'))->links() }} 
        </div>
    </div>
    
  </div>
</section>
<script type="text/javascript">
	function searchit(){
        frm = document.items;
        frm.submit();
    }
    // jQuery(function($){
    //     $.datepicker.regional['ko'] = {
    //         closeText: '닫기',
    //         prevText: '이전달',
    //         nextText: '다음달',
    //         currentText: '오늘',
    //         monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
    //         '7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
    //         monthNamesShort: ['1월','2월','3월','4월','5월','6월',
    //         '7월','8월','9월','10월','11월','12월'],
    //         dayNames: ['일','월','화','수','목','금','토'],
    //         dayNamesShort: ['일','월','화','수','목','금','토'],
    //         dayNamesMin: ['일','월','화','수','목','금','토'],
    //         weekHeader: 'Wk',
    //         dateFormat: 'yymmdd',
    //         firstDay: 0,
    //         isRTL: false,
    //         showMonthAfterYear: true,
    //         yearSuffix: ''};
    //     $.datepicker.setDefaults($.datepicker.regional['ko']);

    //     $('input[name$="_date"]').datepicker({
    //         showOn: 'button',
    //         buttonImage: '../asset/images/bt_cal.gif',
    //         buttonImageOnly: true,
    //         buttonText: "달력",
    //         changeMonth: true,
    //         changeYear: true,
    //         showButtonPanel: true,
    //         yearRange: 'c-99:c+99'
    //         //maxDate: '+0d'
    //     });

    //     // select focus
    //     //$('select[name="ca_name"]').focus();
    // });
</script>

<style>
    .search_span{
        width: 70px;
        border: 1px solid #e0e0e0;
        text-align: center;
        align-content: center;
    }
</style>

