<header>
  <div class="my-info"> &nbsp;
    @auth
    <a href="/ver_02/w_mypage/modify.php" class="name">{{ Auth::user()->name }}</a>님! 반갑습니다. 
      <button class="grade grade-normal pointer" onclick="javascript:openIdpass2();">Normal</button>
      <span class="ml10">로또현황: 
        <a href="/mypage/buy_list">0종</a> 
        | 포인트: 
        <a href="/mypage/point_list">{{number_format(floor(Auth::user()->amount),0)}}</a>
        <a href="/mypage/deposit" class="btn-point" title="금액충전">금액충전</a>
      </span>
    <a href="/play/cart" title="장바구니" class="btn-cart">장바구니</a>
    @endauth
  </div>
  <div class="max-wrapper">
    <div class="gnb-logo">
      <a href="/" title="로또캠프">
        <img src="{{ asset('images/web/logo_lottocamp.png')}}" alt="로또캠프">
      </a>
    </div>
    <a href="javascript:void(0)" class="btn-nav btn-nav-open mo-menu">
      <img src="{{ asset('images/web/btn_menu_open.png')}}" alt="메뉴 열기">
    </a>
    <nav class="gnb">
      <div class="sub-menu">
        @auth
        
        <a href="/member/logout" title="로그아웃">로그아웃</a>
        <a href="/mypage/deposit" title="포인트충전">금액충전</a>
        @else
        <a href="/member/login" title="로그인">로그인</a>
        <a href="/member/join" title="회원가입">회원가입</a>
        @endauth
        <a href="javascript:void(0)" class="btn-nav  btn-nav-close2">
          <img src="{{ asset('images/web/btn_menu_close.png')}}" alt="메뉴 닫기">
        </a>
      </div>
      <ul class="gnb-menu">
        <li class="menu-item">
          <span class="gnb-btn" style="cursor:pointer">로또구매대행</span>
          <ul class="depth2">
            <li>
              <a href="/play/lotto_live" title="실시간로또">실시간로또</a>
            </li>
            <li>
              <a href="/play/lotto_KR" title="로또6/45(한국)">로또6/45(한국)</a>
            </li>
            <li>
              <a href="/play/lotto_em_qp" title="연금720(한국)">연금720(한국)</a>
            </li>
            <li>
              <a href="/play/lotto_pb" title="파워볼(미국)">파워볼(미국)</a>
            </li>
            <li>
              <a href="/play/lotto_mm" title="메가밀리언(미국)">메가밀리언(미국)</a>
            </li>           
            <li>
              <a href="/play/lotto_eg" title="쌍색구(중국)">쌍색구(중국)</a>
            </li>
            <li>
              <a href="/play/lotto_lp" title="따루토(중국)">따루토(중국)</a>
            </li>
            <li>
              <a href="/play/lotto_ej" title="로또6(일본)">로또6(일본)</a>
            </li>
            <li>
              <a href="/play/lotto_ed" title="로또7(일본)">로또7(일본)</a>
            </li>
            <li>
              <a href="/play/lotto_ed" title="미니(일본)">미니(일본)</a>
            </li>             
          </ul>
        </li>
        <li class="menu-item">
          <span class="gnb-btn" style="cursor:pointer">리버스 로또</span>
          <ul class="depth2">
              <li>
              <a href="/jplay/lotto_live" title="실시간로또">실시간로또</a>
            </li>
            <li>
              <a href="/jplay/lotto_KR" title="로또6/45(한국)">로또6/45(한국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_em_qp" title="연금720(한국)">연금720(한국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_pb" title="파워볼(미국)">파워볼(미국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_mm" title="메가밀리언(미국)">메가밀리언(미국)</a>
            </li>           
            <li>
              <a href="/jplay/lotto_eg" title="쌍색구(중국)">쌍색구(중국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_lp" title="따루토(중국)">따루토(중국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_ej" title="로또6(일본)">로또6(일본)</a>
            </li>
            <li>
              <a href="/jplay/lotto_ed" title="로또7(일본)">로또7(일본)</a>
            </li>
            <li>
              <a href="/jplay/lotto_ed" title="미니(일본)">미니(일본)</a>
            </li>
          </ul>
        </li>
        

        <li class="menu-item">
          <span class="gnb-btn" style="cursor:pointer">입금/출금</span>
          <ul class="depth2">            
            <li>
              <a href="/mypage/deposit" title="입금">입금</a>
            </li>  
            <li>
              <a href="/mypage/withdrawal" title="출금">출금</a>
            </li>
            <li>
              <a href="/mypage/depo_with" title="입/출금내역">입/출금내역</a>
            </li>
          </ul>
        </li>
      
        <li class="menu-item">
          <span class="gnb-btn" style="cursor:pointer">마이페이지</span>
          <ul class="depth2">
            <li>
              <a href="/mypage/message" title="받은쪽지함">받은쪽지함</a>
            </li>
            <li>
              <a href="/mypage/buy_list" title="거래(구매내역)">거래(구매내역)</a>
            </li>
            <li>
              <a href="/mypage/modify" title="개인정보">개인정보</a>
            </li>    
          </ul>
        </li>

        <li class="menu-item">
          <span class="gnb-btn" style="cursor:pointer">고객센터</span>
          <ul class="depth2">
            <li>
              <a href="/customer/faq" title="1:1문의">1:1문의</a>
            </li>
            <li>
              <a href="/customer/notice" title="공지사항">공지사항</a>
            </li>           
            <!-- <li>
              <a href="/info/lotto_pb" title="로또안내">로또안내</a>
            </li>   -->
            <li>
              <a href="/customer/event" title="이벤트">이벤트</a>
            </li>
                      
          </ul>
        </li>
        
      </ul>
      <a href="javascript:void(0)" class="btn-nav btn-nav-open pc-menu">
        <img src="{{ asset('images/web/btn_menu_open.png')}}" alt="메뉴 열기">
      </a>
      <a href="javascript:void(0)" class="btn-nav  btn-nav-close1">
        <img src="{{ asset('images/web/btn_menu_close.png')}}" alt="메뉴 닫기">
      </a>
      <div class="quick-menu-w" style="right: -58px;">
        <div class="con">
          <div class="btn-quick-close">
            <img src="{{ asset('images/web/btn_quick_close2.jpg')}}" class="quick-close" style="display: none;">
            <img src="{{ asset('images/web/btn_quick_open2.jpg')}}" class="quick-open" style="">
          </div>
          <div class="quick-menu-link">
            <div class="quick-menu">
              <a href="/customer/prize_info" class="item">
                <img src="{{ asset('images/web/ico_quick2_01.png')}}" alt="당첨금 수령안내">
                <span>당첨금 <br>수령 </span>
              </a>
              <a href="/customer/prize_info5" class="item">
                <img src="{{ asset('images/web/ico_quick2_02.png')}}" alt="당첨금 세금안내">
                <span>당첨 <br>세금 </span>
              </a>
              <a href="/number/mn_analysis" class="item">
                <img src="{{ asset('images/web/ico_quick2_03.png')}}" alt="내번호 분석">
                <span>내번호 <br>분석 </span>
              </a>
              <a href="/customer/lotto_news" class="item">
                <img src="{{ asset('images/web/ico_quick2_04.png')}}" alt="당청스토리">
                <span>당첨 <br>스토리 </span>
              </a>
              <a href="/mypage/auto_reserv" class="item">
                <img src="{{ asset('images/web/ico_quick2_05.png')}}" alt="자동예약">
                <span>자동 <br>예약 </span>
              </a>
              <a href="/customer/qa" class="item">
                <img src="{{ asset('images/web/ico_quick2_06.png')}}" alt="Q&amp;A문의">
                <span>Q&amp;A <br>문의 </span>
              </a>
              
            </div>
            <div class="quick-prod">
              <a href="/jplay/lotto_kr" title="로또6/45">
                <img src="{{ asset('images/web/logo_kr.png')}}">
                <span>3,975억</span>
              </a>
              <a href="/jplay/lotto_kr1" title="연금720">
                <img src="{{ asset('images/web/logo_kr1.png')}}">
                <span>1,000불/매일</span>
              </a>
              <a href="/jplay/lotto_pb" title="파워볼">
                <img src="{{ asset('images/web/logo_pb.png')}}">
                <span>1,120억</span>
              </a>
              <a href="/jplay/lotto_mm" title="메가밀리언즈">
                <img src="{{ asset('images/web/logo_mm.png')}}">
                <span>3,696억</span>
              </a>
               <a href="/jplay/lotto_ssq" title="쌍색구">
                <img src="{{ asset('images/web/logo_ssq.png')}}">
                <span>184억</span>
              </a>
              <a href="/jplay/lotto_dlt" title="따루토">
                <img src="{{ asset('images/web/logo_dlt.png')}}">
                <span>0억</span>
              </a>
             
              <a href="/jplay/lotto_6" title="로또6">
                <img src="{{ asset('images/web/logo_6.png')}}">
                <span>151억</span>
              </a>
              <a href="/jplay/lotto_7" title="로또7">
                <img src="{{ asset('images/web/logo_7.png')}}">
                <span>81억</span>
              </a>
              <a href="/jplay/lotto_mini" title="미니로또">
                <img src="{{ asset('images/web/logo_mini.png')}}">
                <span>492억</span>
              </a>
             
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>

<div class="quick-prod-top">
  <div class="con">
    
    <a href="/jplay/lotto_kr" title="로또6/45" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_kr.png')}}">
      <span>3,975억</span>
    </a>
    <a href="/jplay/lotto_kr1" title="연금720" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_kr1.png')}}">
      <span>1,000불/매일</span>
    </a>
    <a href="/jplay/lotto_pb" title="파워볼" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_pb.png')}}">
      <span>1,120억</span>
    </a>
    <a href="/jplay/lotto_mm" title="메가밀리언즈" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_mm.png')}}">
      <span>3,696억</span>
    </a>
      <a href="/jplay/lotto_ssq" title="쌍색구" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_ssq.png')}}">
      <span>184억</span>
    </a>
    <a href="/jplay/lotto_dlt" title="따루토" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_dlt.png')}}">
      <span>0억</span>
    </a>
    
    <a href="/jplay/lotto_6" title="로또6" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_6.png')}}">
      <span>151억</span>
    </a>
    <a href="/jplay/lotto_7" title="로또7" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_7.png')}}">
      <span>81억</span>
    </a>
    <a href="/jplay/lotto_mini" title="미니로또" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_mini.png')}}">
      <span>492억</span>
    </a>
  </div>
</div>