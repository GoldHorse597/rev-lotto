<header>
  <div class="my-info"> &nbsp;
    @auth
    <a href="/mypage/modify" class="name">{{ Auth::user()->name }}</a>님! 반갑습니다. 
          @if (Auth::user()->level == 0)
              <button class="grade grade-normal pointer" onclick="javascript:openIdpass2();">Normal</button>
          @elseif (Auth::user()->level == 1)
              <button class="grade grade-vip pointer" onclick="javascript:openIdpass2();">VIP</button>
          @elseif (Auth::user()->level == 2)
              <button class="grade grade-vvip pointer" onclick="javascript:openIdpass2();">VVIP</button>
          @endif
      <span class="ml10">로또현황: 
        <a href="{{ url('/mypage/buy_list') }}?status=0">{{$cnt}}종</a> 
        | 보유금액: 
        <a href="/mypage/depo_with">{{number_format(floor(Auth::user()->amount),0)}}</a>
        <a href="/mypage/deposit" class="btn-point" title="금액충전">금액충전</a>
      </span>
    
    @endauth
  </div>
  <div class="max-wrapper">
    <div class="gnb-logo">
      <a href="/" title="리버스로또">
        <img src="{{ asset('images/web/logo_lottocamp.png')}}" alt="리버스로또">
      </a>
    </div>
    <a href="javascript:void(0)" class="btn-nav btn-nav-open mo-menu">
      <img src="{{ asset('images/web/btn_menu_open.png')}}" alt="메뉴 열기">
    </a>
    <nav class="gnb">
       @auth
      <div class="my-info-mo">
        <div>
          <a href="/mypage/modify" class="name">{{ Auth::user()->name }}</a>님! 반갑습니다.
          @if (Auth::user()->level == 0)
              <button class="grade grade-normal pointer" onclick="javascript:openIdpass2();">Normal</button>
          @elseif (Auth::user()->level == 1)
              <button class="grade grade-vip pointer" onclick="javascript:openIdpass2();">VIP</button>
          @elseif (Auth::user()->level == 2)
              <button class="grade grade-vvip pointer" onclick="javascript:openIdpass2();">VVIP</button>
          @endif
        </div>
        <div>
          <span class="ml10">로또현황: <a href="{{ url('/mypage/buy_list') }}?status=0">{{$cnt}}종</a></span>
          <span class="ml10">포인트:<a href="/mypage/point_list">{{number_format(floor(Auth::user()->amount),0)}}</a>
            <a href="/mypage/deposit" class="btn-point" title="금액충전">금액충전</a>
           
          </span>
        </div>
      </div>
       @endauth
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
            @if(Auth::user()->primium == 1)
            <li>
              <a href="/play/lotto_pri" title="프리미엄 로또">프리미엄 로또</a>
            </li> 
            @endif
            <li>
              <a href="/play/lotto_live" title="실시간로또">실시간로또</a>
            </li>
            
            <li>
              <a href="/play/lotto_kr" title="로또6/45(한국)">로또6/45(한국)</a>
            </li>
            
            <li>
              <a href="/play/lotto_pb" title="파워볼(미국)">파워볼(미국)</a>
            </li>
            <li>
              <a href="/play/lotto_mm" title="메가밀리언(미국)">메가밀리언(미국)</a>
            </li>           
            <!-- <li>
              <a href="/play/lotto_ssq" title="쌍색구(중국)">쌍색구(중국)</a>
            </li>
            <li>
              <a href="/play/lotto_dlt" title="따루토(중국)">따루토(중국)</a>
            </li> -->
            <li>
              <a href="/play/lotto_6" title="로또6(일본)">로또6(일본)</a>
            </li>
            <li>
              <a href="/play/lotto_7" title="로또7(일본)">로또7(일본)</a>
            </li>
            <li>
              <a href="/play/lotto_mini" title="미니(일본)">미니(일본)</a>
            </li>             
          </ul>
        </li>
        <li class="menu-item">
          <span class="gnb-btn" style="cursor:pointer">리버스 로또</span>
          <ul class="depth2">
            @if(Auth::user()->primium == 1)
            <li>
              <a href="/jplay/lotto_pri" title="프리미엄 로또">프리미엄 로또</a>
            </li> 
            @endif
            <li>
              <a href="/jplay/lotto_live" title="실시간로또">실시간로또</a>
            </li>
            <li>
              <a href="/jplay/lotto_kr" title="로또6/45(한국)">로또6/45(한국)</a>
            </li>
           
            <li>
              <a href="/jplay/lotto_pb" title="파워볼(미국)">파워볼(미국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_mm" title="메가밀리언(미국)">메가밀리언(미국)</a>
            </li>           
            <!-- <li>
              <a href="/jplay/lotto_ssq" title="쌍색구(중국)">쌍색구(중국)</a>
            </li>
            <li>
              <a href="/jplay/lotto_dlt" title="따루토(중국)">따루토(중국)</a>
            </li> -->
            <li>
              <a href="/jplay/lotto_6" title="로또6(일본)">로또6(일본)</a>
            </li>
            <li>
              <a href="/jplay/lotto_7" title="로또7(일본)">로또7(일본)</a>
            </li>
            <li>
              <a href="/jplay/lotto_mini" title="미니(일본)">미니(일본)</a>
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
      <!-- <div class="quick-menu-w" style="right: -58px;">
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
              <a href="/customer/faq" class="item">
                <img src="{{ asset('images/web/ico_quick2_06.png')}}" alt="1:1 문의">
                <span>1:1 <br>문의 </span>
              </a>
              
            </div>
            <div class="quick-prod">
              <a href="/jplay/lotto_kr" title="로또6/45">
                <img src="{{ asset('images/web/logo_kr.png')}}">
                <span>407억</span>
              </a>             
              <a href="/jplay/lotto_pb" title="파워볼">
                <img src="{{ asset('images/web/logo_pb.png')}}">
                <span>27,000억</span>
              </a>
              <a href="/jplay/lotto_mm" title="메가밀리언즈">
                <img src="{{ asset('images/web/logo_mm.png')}}">
                <span>21,000억</span>
              </a>
               <a href="/jplay/lotto_ssq" title="쌍색구">
                <img src="{{ asset('images/web/logo_ssq.png')}}">
                <span>1,100억</span>
              </a>
              <a href="/jplay/lotto_dlt" title="따루토">
                <img src="{{ asset('images/web/logo_dlt.png')}}">
                <span>500억</span>
              </a>
             
              <a href="/jplay/lotto_6" title="로또6">
                <img src="{{ asset('images/web/logo_6.png')}}">
                <span>53억</span>
              </a>
              <a href="/jplay/lotto_7" title="로또7">
                <img src="{{ asset('images/web/logo_7.png')}}">
                <span>87억</span>
              </a>
              <a href="/jplay/lotto_mini" title="미니로또">
                <img src="{{ asset('images/web/logo_mini.png')}}">
                <span>4억</span>
              </a>
             
            </div>
          </div>
        </div>
      </div> -->
    </nav>
  </div>
</header>

<div class="quick-prod-top">
  <div class="con">
    
    <a href="/jplay/lotto_kr" title="로또6/45" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_kr.png')}}">
      <span>407억</span>
    </a>   
    <a href="/jplay/lotto_pb" title="파워볼" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_pb.png')}}">
      <span>27,000억</span>
    </a>
    <a href="/jplay/lotto_mm" title="메가밀리언즈" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_mm.png')}}">
      <span>21,000억</span>
    </a>
    <!-- <a href="/jplay/lotto_ssq" title="쌍색구" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_ssq.png')}}">
      <span>1,100억</span>
    </a>
    <a href="/jplay/lotto_dlt" title="따루토" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_dlt.png')}}">
      <span>500억</span>
    </a> -->
    
    <a href="/jplay/lotto_6" title="로또6" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_6.png')}}">
      <span>52억</span>
    </a>
    <a href="/jplay/lotto_7" title="로또7" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_7.png')}}">
      <span>87억</span>
    </a>
    <a href="/jplay/lotto_mini" title="미니로또" class="quick-prod-em">
      <img src="{{ asset('images/web/logo_mini.png')}}">
      <span>4억</span>
    </a>
  </div>
</div>