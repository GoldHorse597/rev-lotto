@extends('web.info.app')
@section('title', '메가밀리언(미국) 안내')
@section('infotitle', '메가밀리언')
@section('menu', 'mm')
@section('infocontent')  
<div class="inner-contents">
  <h3 class="tit-h3 mt20">메가밀리언이란?</h3>
  <div class="img-prize mt30 img-prize-logo">
    <img src="{{asset('/images/web/info/img_info_mm.jpg')}}" alt="메가밀리언">
  </div>
  <div class="mt30"> Megamillion은 미국의 파워볼, 유럽의 유로밀리언과 함께 세계 3대 로또복권중 하나로 미국인을 비롯하여 전 세계인들로부터 관심과 사랑을 받아오는 빅로또입니다. <br>
    <br> Megamillion은 Mega라는 뜻에서 기이한 단어로 '엄청나게 큰' 이름에서부터 알 수 있듯이 매우 큰 당첨금 규모를 가지고 있습니다. 천문학적인 당첨금과 1등에 당첨된 사람들의 기쁘고 또 슬픈 사연으로 로또역사에서 한 획을 기록해 나가고 있습니다. <br>
    <br> 현재까지 메가밀리언에서 최고당첨금액은 <span class="t-red">2018년 10월24일 15억달러 (한화 약 1조7천억원)</span>를 기록하여 메가밀리언 역사상 최고의 로또 당첨금기록으로 남아 있습니다. <br>
    <br> 2018년 10월 기준으로 파워볼까지 범위를 넓혀보면 로또 당첨금 최고기록은 2016년 1월 파워볼이 15억 8천6백만달러 (한화 약 1조8264억원)의 최고당첨금기록을 갖고 있으며 1인당 수령최고금액으로는 2017년 8월 약 8,549억원의 파워볼에 이어 2018년 10월 메가밀리언의 기록이 1인당 수령 최고기록을 갈아치우게 됩니다.
  </div>
  <h3 class="tit-h3 mt50">연혁</h3>
  <h4 class="tit-h4 mt20">1. 1996년 시작</h4>
  <div class="dot-item ml20">Georgia, Illinois, Maryland, Massachusetts, Michigan and Virginia 총 6개의 주가 참여하여 출발을 하였습니다.</div>
  <h4 class="tit-h4 mt30">2. 1998년</h4>
  <div class="dot-item ml20">화요일, 금요일 한 주에 두 번의 추첨이 이뤄지도록 룰을 변경합니다.</div>
  <h4 class="tit-h4 mt30">3. 1999년 1월</h4>
  <div class="dot-item ml20">연금식지급이외에 현금 일시불 지불(Cash Payout) 제도를 도입합니다.</div>
  <h4 class="tit-h4 mt30">4. 1999년 5월</h4>
  <div class="dot-item ml20">New Jersey가 7번째 가입 주가 되었습니다.</div>
  <h4 class="tit-h4 mt30">5. 2002년 9월</h4>
  <div class="dot-item ml20">Washington주 참여</div>
  <h4 class="tit-h4 mt30">6. 2002년 5월</h4>
  <div class="dot-item ml20">New York and Ohio주가 참여함으로써 오늘 날의 Mega Millions라는 이름으로 변경되었으며, 보다 큰 잭팟 게임으로 흥미를 끌기 시작했습니다.</div>
  <h4 class="tit-h4 mt30">7. 2003년</h4>
  <div class="dot-item ml20">Texas주 참여</div>
  <h4 class="tit-h4 mt30">8. 2005년</h4>
  <div class="dot-item ml20">California주 참여</div>
  <h4 class="tit-h4 mt30">9. 2010년 1월</h4>
  <div class="dot-item ml20">이때부터 42개주가 참여함으로써 파워볼과 함께 미국 내셔날 연합 복권의 명성을 계속 이어가게 되었습니다.</div>
  <h4 class="tit-h4 mt30">10. 2013년 10월</h4>
  <div class="dot-item ml20">룰을 변경하여 대형잭팟의 기회와 더 높은 당첨금이 지급되는 횟수를 늘렸습니다. 이때부터 당첨금은 천문학적으로 증가를 하게되는 계기를 마련합니다.</div>
  <h4 class="tit-h4 mt30">11. 2017년 10월</h4>
  <div class="dot-item ml20">로또가격인상과 일반볼 70개, 메가볼 25로 룰을 변경하고 Just the Jackpot 옵션을 도입하여 파워볼에 새로운 경쟁을 선포합니다.</div>
  <h4 class="tit-h4 mt30">12. 2025년 4월 8일</h4>
  <div class="dot-item ml20">로또가격인상과 함께 일반볼 70개 메가볼 24개로 룰을 변경하고 시작당첨금 및 옵션과 당첨금액, 잭팟상승율등을 대대적으로 변경합니다. <br>기존의 메가져스트잭팟 옵션은 종료하게 됩니다. </div>
  <div class="img-prize mt30">
    <img src="{{asset('/images/web/info/info_mm_img_02_250402.jpg')}}" alt="메가밀리언">
  </div>
  <h3 class="tit-h3 mt50">게임방법</h3>
  <h4 class="tit-h4 mt20">일반게임</h4>
  <div class="mt20 ml20">
    <div class="dot-item">1부터 70까지의 숫자 중 일반 번호 5개를 선택합니다.</div>
    <div class="dot-item">1부터 24개의 메가볼 중 하나를 선택하여 총 6개의 번호를 선택합니다.</div>
    <div class="dot-item">Mega Ball 숫자는 앞에서 선택한 5개 번호와 중복이 가능합니다.</div>
    <div class="dot-item">메가플라이어 옵션은 자동 전부적용이며 기본당첨금 5불에 대하여 2배~10배까지 받을 수 있습니다.</div>
  </div>
  <!-- <h4 class="tit-h4 mt50">메가플라이어 옵션게임</h4><div class="mt20 ml20"><div class="dot-item">일반볼을 선택한 후 옵션을 원하면 메가플라이어옵션을 체크만 하면 자동응모가 됩니다.</div><div class="dot-item">메가플라이어 옵션배수 ( 2 ~ 5 까지)는 추첨시 별도로 한 개를 발표하며, 옵션을 적용하여 당첨된 경우는 그 발표한 배수대로 당첨금을 배수로 지급합니다.</div><div class="dot-item">1등의 경우는 옵션적용대상에서 제외합니다.</div></div><div class="mt50 t-b">Prizes for Megaplier Winners (1등은 제외)</div><div class="m-overflow mt10"><table class="table-comm w100p" cellpadding="0" cellspacing="0"><colgroup><col style="width:12%"><col style="width:22%"><col style="width:22%"><col style="width:22%"><col style="width:22%"></colgroup><thead><tr><th>Match</th><th>X 2</th><th>X 3</th><th>X 4</th><th>X 5</th></tr></thead><tbody><tr><td>5 + 0</td><td class="t-r">$ 2,000,000</td><td class="t-r">$3,000,000</td><td class="t-r">$4,000,000</td><td class="t-r">$5,000,000</td></tr><tr><td>4 + 1</td><td class="t-r">$20,000</td><td class="t-r">$30,000</td><td class="t-r">$40,000</td><td class="t-r">$50,000</td></tr><tr><td>4 + 0</td><td class="t-r">$1,000</td><td class="t-r">$1,500</td><td class="t-r">$2,000</td><td class="t-r">$2,500</td></tr><tr><td>3 + 1</td><td class="t-r">$400</td><td class="t-r">$600</td><td class="t-r">$800</td><td class="t-r">$1,000</td></tr><tr><td>3 + 0</td><td class="t-r">$20</td><td class="t-r">$30</td><td class="t-r">$40</td><td class="t-r">$50</td></tr><tr><td>2 + 1</td><td class="t-r">$20</td><td class="t-r">$30</td><td class="t-r">$40</td><td class="t-r">$50</td></tr><tr><td>1 + 1</td><td class="t-r">$8</td><td class="t-r">$12</td><td class="t-r">$ 16</td><td class="t-r">$20</td></tr><tr><td>0 + 1</td><td class="t-r">$4</td><td class="t-r">$6</td><td class="t-r">$8</td><td class="t-r">$10</td></tr></tbody></tbody></table></div><h4 class="tit-h4 mt50">Just the jackpot 옵션게임</h4><div class="mt20 ml20"><div class="dot-item">져스트잭팟은 2QP단위로 주문가능한 특별한 옵션게임으로 오직 1등잭팟에만 응모를 합니다.</div><div class="dot-item">2등이하 등수와 메가플라이어는 해당이 없는 게임옵션입니다.</div><div class="dot-item">수동선택은 주문이 불가한 반면에 일반 게임보다는 저렴한 것이 특징입니다.</div></div>
				//-->
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
          <th>당첨금(뉴욕&amp;메릴랜드)</th>
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
          <td class="t-r">1등 누적 당첨금(잭팟)</td>
          <td class="t-r">1: 290,472,336</td>
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
          <td class="t-r">
            <span class="t-red">$2M</span>, $3M, $4M, $5M or $10M
          </td>
          <td class="t-r">1: 12,629,232</td>
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
          <td class="t-r">
            <span class="t-red">$20K</span>, $30K, $40K, $50K or $100K
          </td>
          <td class="t-r">1: 893,761</td>
        </tr>
        <tr>
          <td>4등</td>
          <td class="t-r">
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
          </td>
          <td class="t-r">
            <span class="t-red">$1K</span>, $1.5K, $2K, $2.5K or $5K
          </td>
          <td class="t-r">1: 38,859</td>
        </tr>
        <tr>
          <td>5등</td>
          <td class="t-r">
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
            <span class="ico-radius-plus"></span>
          </td>
          <td class="t-r">
            <span class="t-red">$400</span>, $600, $800, $1K or $2K
          </td>
          <td class="t-r">1: 13,965</td>
        </tr>
        <tr>
          <td>6등</td>
          <td class="t-r">
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
          </td>
          <td class="t-r">
            <span class="t-red">$20</span>, $30, $40, $50 or $100
          </td>
          <td class="t-r">1: 607</td>
        </tr>
        <tr>
          <td>7등</td>
          <td class="t-r">
            <span class="ico-radius"></span>
            <span class="ico-radius"></span>
            <span class="ico-radius-plus"></span>
          </td>
          <td class="t-r">
            <span class="t-red">$20</span>, $30, $40, $50 or $100
          </td>
          <td class="t-r">1: 665</td>
        </tr>
        <tr>
          <td>8등</td>
          <td class="t-r">
            <span class="ico-radius"></span>
            <span class="ico-radius-plus"></span>
          </td>
          <td class="t-r">
            <span class="t-red">$14</span>, $21, $28, $35 or $70
          </td>
          <td class="t-r">1: 86</td>
        </tr>
        <tr>
          <td>9등</td>
          <td class="t-r">
            <span class="ico-radius-plus"></span>
          </td>
          <td class="t-r">
            <span class="t-red">$10</span>, $15, $20, $25 or $50
          </td>
          <td class="t-r">1: 35</td>
        </tr>
        <tr>
          <td>전체평균 <br> 당첨확률 </td>
          <td class="t-r">Overall Odds</td>
          <td class="t-r">
            <span class="t-red">기본당첨금</span> ( <span class="t-red">2X</span>,3X,4X,5X,10X 적용)
          </td>
          <td class="t-r">1: 23</td>
        </tr>
      </tbody>
    </table>
  </div>
  <h3 class="tit-h3 mt50">멀티플라이어(multiplier) 옵션확률</h3>
  <div class="m-overflow mt10">
    <table class="table-comm w100p" cellpadding="0" cellspacing="0">
      <colgroup>
        <col style="width:50%">
        <col style="width:50%">
      </colgroup>
      <thead>
        <tr>
          <th>멀티플라이어 옵션 배수</th>
          <th>확률</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2X</td>
          <td>1: 2.13</td>
        </tr>
        <tr>
          <td>3X</td>
          <td>1: 3.2</td>
        </tr>
        <tr>
          <td>4X</td>
          <td>1: 8</td>
        </tr>
        <tr>
          <td>5X</td>
          <td>1: 16</td>
        </tr>
        <tr>
          <td>10X</td>
          <td>1: 32</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="message-box-gy mt40">
    <h4 class="tit-h4 mb10">기타 안내</h4>
    <div class="mt10 ml20">
      <div class="dot-item">게임을 구매하실 때에는 직접 원하시는 번호를 선택하는 방법도 있고, 자동선택과, 일괄자동선택, 반자동, QP선택도 가능합니다.</div>
      <div class="dot-item">선택한번호를 번호보관함에 담아 저장하고 다음 이용시 다시 선택할 수 있습니다.</div>
      <div class="dot-item">메가밀리언 현지가격은 1게임당 $5이며 주문시 싸이트이용료 가 추가되어 결제됩니다. 장바구니에서는 5게임 또는 10게임부터 할인가로 주문이 가능합니다.</div>
      <div class="dot-item">1티켓당 5게임까지 플레이가능합니다. 일괄자동은 100게임 동시주문이 가능합니다.</div>
      <div class="dot-item">Megaplier옵션은 자동적용입니다.</div>
      <div class="dot-item">특별상품과 기타 상품주문은 기타&amp;특별복권 메뉴를 이용하세요.</div>
      <div class="dot-item">캘리포니아주 티켓구매의 경우는 하위등수의 당첨금은 로또판매액대비 균등당첨금으로 변경이 있습니다.</div>
      <div class="dot-item">당첨금지급은 다른 미국로또와 마찬가지로 당첨후 결정을 하시면 됩니다. 일시불 지급과 30년 분할 지급 중 선택할 수 있습니다.</div>
      <div class="dot-item">기본당첨금액은 2025년4월부터 코로나이전의 $50,000,000에서 시작합니다. 이월은 무제한 이월입니다.</div>
      <div class="dot-item">주문마감시간은 한국시간기준 매주 화/금요일 오후 11시50분이며 마감시간이 지난 주문은 다음회차로 응모됩니다.</div>
      <div class="dot-item">추첨시간은 한국시간기준 매주 수/토요일 오후 1시입니다.(썸머타임 적용시에는 1시간 당겨집니다.)</div>
    </div>
  </div>
</div>
@endsection