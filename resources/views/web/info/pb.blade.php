@extends('web.info.app')
@section('title', '파워볼(미국) 안내')
@section('infotitle', '파워볼 안내')
@section('menu', 'pb')
@section('infocontent') 
   <div class="inner-contents">
          <h3 class="tit-h3 mt20">파워볼이란?</h3>
          <div class="img-prize mt30 img-prize-logo">
            <img src="{{asset('/images/web/info/img_info_pb.jpg')}}" alt="파워볼">
          </div>
          <div class="mt30"> Powerball은 미국의 아리조나, 콜로라도, 커네티컷, 델라웨어, 인디애나, 아이다호, 아이오와, 캔사스, 켄터키, 루이지애나, 미네소타, 미주리, 몬태나, 네브라스카, 뉴햄프셔, 뉴멕시코, 오레곤, 펜실베니아, 로드아일랜드, 사우스 캐롤라이나, 워싱턴 DC등 43개주가 연합하여 구성한 미국 최대 연합복권입니다. <br>
            <br> 2010년 2월 이후에는 또 다른 연합복권인 메가밀리언도 같이 판매를해서 명실공히 미국 내 최대연합복권의 명성을 이어가고 있습니다. 2013년부터는 인구가 많은 캘리포니아주도 포함되어 더욱 규모가 큰 로또로 거듭납니다. <br>
            <br> 이 복권의 게임방법은 69개의 번호 중 5개를 선택하고, 26개 파워볼 중 1개를 선택하여 총 6개의 숫자를 맞추는 방식으로 운영(2015년10월4일 룰개정)되며, 대한민국에서 시행되고 있는 6/45 로또복권 보다 당첨확률은 낮아지고 당첨금액은 천문학적으로 커집니다. <br>
            <br> 2012년1월까지는 39개중 1개의 파워볼을 선택했고 이후 35개의 파워볼 중 1개를 선택하였으나 2015년 10월 4일부터는 26개의 파워볼 중 1개를 선택합니다. <br>
            <br> 현재까지 <span class="t-red">파워볼의 최고당첨금액은 기록은 2022년 11월 7일 총 20억 4천만불(한화 약2조 8천억원)로</span> 세계최고의 로또중 하나로 자리잡고 있습니다.
          </div>
          <div class="img-prize mt30">
            <img src="{{asset('/images/web/info/info_pb_img_02_250402.jpg')}}" alt="파워볼">
          </div>
          <h3 class="tit-h3 mt50">게임방법</h3>
          <h4 class="tit-h4 mt20">일반게임</h4>
          <div class="mt20 ml20">
            <div class="dot-item">69개의 화이트볼 중에서 5개의 번호를 선택합니다.</div>
            <div class="dot-item">26개의 파워볼 중에서 1개를 선택합니다. 이렇게 총 6개의 볼을 선택하면 됩니다.</div>
          </div>
          <h4 class="tit-h4 mt50">파워플레이 옵션게임</h4>
          <div class="mt20 ml20">
            <div class="dot-item">일반볼을 선택후 장바구니에서 파워플레이 옵션을 체크만 하면 주문이 됩니다.</div>
            <div class="dot-item">파워플레이 옵션배수 ( 2 ~ 10 까지)는 추첨시 별도로 발표하며, 옵션적용 당첨된 경우는 그 발표한 배수대로 당첨금을 지급합니다.</div>
            <div class="dot-item">1등은 옵션적용대상에서 제외하며, 10배수는 당첨금 $150million 이하의 경우에 적용합니다.</div>
            <div class="dot-item">2021년 8월부터는 더블플레이가 가능합니다. 추가추첨을 통해 추가당첨금을 지불하는 옵션인데 현재 일부 주에서만 가능합니다.</div>
          </div>
          <div class="mt50 t-b">Prizes for Pawerplay Winners (1등은 제외)</div>
          <div class="m-overflow mt10">
            <table class="table-comm w100p" cellpadding="0" cellspacing="0">
              <colgroup>
                <col style="width:10%">
                <col style="width:18%">
                <col style="width:18%">
                <col style="width:18%">
                <col style="width:18%">
                <col style="width:18%">
              </colgroup>
              <thead>
                <tr>
                  <th>Match</th>
                  <th>X 2</th>
                  <th>X 3</th>
                  <th>X 4</th>
                  <th>X 5</th>
                  <th>X 6</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>5 * 0</td>
                  <td class="t-r">$ 2,000,000</td>
                  <td class="t-r">$ 2,000,000</td>
                  <td class="t-r">$ 2,000,000</td>
                  <td class="t-r">$ 2,000,000</td>
                  <td class="t-r">$ 2,000,000</td>
                </tr>
                <tr>
                  <td>4 * 1</td>
                  <td class="t-r">$ 100,000</td>
                  <td class="t-r">$ 150,000</td>
                  <td class="t-r">$ 200,000</td>
                  <td class="t-r">$ 250,000</td>
                  <td class="t-r">$ 500,000</td>
                </tr>
                <tr>
                  <td>4 * 0</td>
                  <td class="t-r">$ 200</td>
                  <td class="t-r">$ 300</td>
                  <td class="t-r">$ 400</td>
                  <td class="t-r">$ 500</td>
                  <td class="t-r">$ 1,000</td>
                </tr>
                <tr>
                  <td>3 * 1</td>
                  <td class="t-r">$ 200</td>
                  <td class="t-r">$ 300</td>
                  <td class="t-r">$ 400</td>
                  <td class="t-r">$ 500</td>
                  <td class="t-r">$ 1,000</td>
                </tr>
                <tr>
                  <td>3 * 0</td>
                  <td class="t-r">$ 14</td>
                  <td class="t-r">$ 21</td>
                  <td class="t-r">$ 28</td>
                  <td class="t-r">$ 35</td>
                  <td class="t-r">$ 70</td>
                </tr>
                <tr>
                  <td>2 * 1</td>
                  <td class="t-r">$ 14</td>
                  <td class="t-r">$ 21</td>
                  <td class="t-r">$ 28</td>
                  <td class="t-r">$ 35</td>
                  <td class="t-r">$ 70</td>
                </tr>
                <tr>
                  <td>1 * 1</td>
                  <td class="t-r">$ 8</td>
                  <td class="t-r">$ 12</td>
                  <td class="t-r">$ 16</td>
                  <td class="t-r">$ 20</td>
                  <td class="t-r">$ 40</td>
                </tr>
                <tr>
                  <td>0 * 1</td>
                  <td class="t-r">$ 8</td>
                  <td class="t-r">$ 12</td>
                  <td class="t-r">$ 16</td>
                  <td class="t-r">$ 20</td>
                  <td class="t-r">$ 40</td>
                </tr>
              </tbody>
            </table>
          </div>
          <h3 class="tit-h3 mt50">등수별 당첨금액</h3>
          <div class="m-overflow mt10">
            <table class="table-comm w100p" cellpadding="0" cellspacing="0">
              <colgroup>
                <col style="width:20%">
                <col style="width:20%">
                <col style="width:30%">
                <col style="width:30%">
              </colgroup>
              <thead>
                <tr>
                  <th>등수</th>
                  <th>당첨조건</th>
                  <th>당첨금(뉴욕주기준)</th>
                  <th>확율</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius-plus"></span>
                  </td>
                  <td class="t-r">Jackpot 당첨금</td>
                  <td class="t-r">1 : 292,201,338</td>
                </tr>
                <tr>
                  <td>2등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                  </td>
                  <td class="t-r">$ 1,000,000</td>
                  <td class="t-r"> 1 : 11,688,054</td>
                </tr>
                <tr>
                  <td>3등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius-plus"></span>
                  </td>
                  <td class="t-r">$ 50,000</td>
                  <td class="t-r">1 : 913,130</td>
                </tr>
                <tr>
                  <td>4등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                  </td>
                  <td class="t-r">$ 100 </td>
                  <td class="t-r">1 : 36,526</td>
                </tr>
                <tr>
                  <td>5등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius-plus"></span>
                  </td>
                  <td class="t-r">$ 100 </td>
                  <td class="t-r"> 1 : 14,495</td>
                </tr>
                <tr>
                  <td>6등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                  </td>
                  <td class="t-r">$ 7 </td>
                  <td class="t-r">1 : 580</td>
                </tr>
                <tr>
                  <td>7등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius"></span>
                    <span class="ico-radius-plus"></span>
                  </td>
                  <td class="t-r">$ 7 </td>
                  <td class="t-r">1 : 702</td>
                </tr>
                <tr>
                  <td>8등</td>
                  <td class="t-r">
                    <span class="ico-radius"></span>
                    <span class="ico-radius-plus"></span>
                  </td>
                  <td class="t-r">$ 4</td>
                  <td class="t-r">1 : 92</td>
                </tr>
                <tr>
                  <td>9등</td>
                  <td class="t-r">
                    <span class="ico-radius-plus"></span>
                  </td>
                  <td class="t-r">$ 4</td>
                  <td class="t-r">1 : 39</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="message-box-gy mt40">
            <h4 class="tit-h4 mb10">기타 안내</h4>
            <div class="mt10 ml20">
              <div class="dot-item">게임을 주문하실 때에는 직접 원하시는 번호를 선택하는 방법도 있고 자동선택, 일괄자동선택, 반자동, QP선택도 가능합니다.</div>
              <div class="dot-item">선택한 번호를 번호보관함에 담아 저장하고 다음 이용시 다시 선택할 수 있습니다.</div>
              <div class="dot-item">파워볼은 1 게임당 $2 이며 싸이트 이용료가 추가되어 결제됩니다. 5게임부터 할인가로 주문이 가능합니다. </div>
              <div class="dot-item">파워플레이옵션은 게임당 $1 이며 싸이트 이용료가 추가되어 결제됩니다. 옵션선택주문은 뉴욕주 구매시 장바구니 화면에서 가능합니다.</div>
              <div class="dot-item">파워볼은 주문시 1등 당첨금 지급 방식(연금식이나 일시불)을 미리 결정하지 않으셔도 됩니다.</div>
              <div class="dot-item">기본당첨금액은 2020년3월 코로나이후 $20,000,000에서 시작합니다. 이월은 무제한 이월입니다.</div>
              <div class="dot-item">1등당첨의 경우 연금식분할수령을 선택하시면 기간은 29년 분할(30회)로 지급받으며 매년 지급시기는 년4회 분기별로 분할 지급됩니다. 당첨후 선택이 가능합니다.</div>
              <div class="dot-item">주문마감시간은 한국시간 기준 매주 월/수/토요일 오후 11시50분이며 마감시간이 지난 주문은 다음회차로 응모됩니다.현지 지사 상황과 임시휴무에 따라 마감일과 시간은 조정될 수 있으니 공지사항을 꼭 참고하시기 바랍니다.</div>
              <div class="dot-item">추첨시간은 한국시간 기준 매주 화/목/일요일 오후 1시입니다. 주3회 추첨입니다. (여름시즌 썸머타임 적용시는 1시간 당겨집니다.)</div>
            </div>
          </div>
        </div>
@endsection