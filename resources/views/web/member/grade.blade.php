<html lang="ko"><head>
    <title>리버스로또</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, width=device-width"> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/common.css') }}?v=1.3">
    <link rel="shortcut icon" href="../asset/images/ico.ico" type="image/x-icon">
    <script src="{{ asset('js/web/jquery.min.js') }}"></script>
</head>
<body>
     <div class="pop-wrap">
        <h1 class="tit-pop"> 맴버쉽 등급혜택</h1>
         <button class="btn-pop-close" onclick="javascript:window.open('','_self').close(); "><img src="{{asset('/images/web/btn_close_w.png')}}" alt="닫기"></button>

         <div class="pop-inner">
            <div class="message-box-gy al-center pd15 mt0">
                고객님은 <span class="t-b">누적충전금액에 따라<br> <span class="t-red">3단계의 맴버등급</span></span>으로 분류가 되며, <br>등급조건이 달성되면 자동으로 등급이 상향 조정됩니다.
            </div>
            <div class="table-lisw-w garde-table mt20">
                <div class="item th-head">
                    <div class="w25p">등급회원등급</div>
                    <div class="pwauto">누적사용 포인트</div>
                    <div class="w20p">등급 아이콘</div>
                </div>
                <div class="tbody">                     
                    <div class="item">
                        <div class="w25p">VVIP</div>
                        <div class="pwauto">3,000만 이상</div>
                        <div class="w20p"><span class="grade grade-vvip">VVIP</span></div>
                    </div> 
                    <div class="item">
                        <div class="w25p">VIP</div>
                        <div class="pwauto">500만~2,999만</div>
                        <div class="w20p"><span class="grade grade-vip">VIP</span></div>
                    </div> 
                    <div class="item">
                        <div class="w25p">Normal</div>
                        <div class="pwauto">0~499만</div>
                        <div class="w20p"><span class="grade grade-normal">Normal</span></div>
                    </div>  
                </div>
            </div>

            <div class="dot-item mt15 mb5">회원등급에 따라 차등적으로 혜택이 주어집니다.</div>
            <div class="dot-item">탈퇴요청은 고객센터로 하세요.</div>
            <div class="dot-item">혜택: FREE 티켓 이벤트에 등급별로 응모가능하며, 등급별로 혜택이 주어집니다.
                FREE공동구매시 할인제공과 FREE응모가 가능합니다.
                이벤트는 매월 진행되며,  다양한 FREE 보너스포인트 또는 FREE 티켓증정을 증정합니다.
                모든 혜택은  상위등급부터 최우선하여 적용됩니다.
                </div> 
            </div>

        

     </div>

</body></html>