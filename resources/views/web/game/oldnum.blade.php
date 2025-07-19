<html lang="ko">
    <head>
        <script type="text/javascript">
            function searchit() {
                frm = document.items;
                frm.submit();
            }
            // 영수증창오픈 설정창 오픈
            function pointWinOpen(data) {
                window.open("./receipt.php?idx=" + data, "", "scrollbars=yes, width=650, height=800");
            }
        </script>
        <title>리버스로또</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, width=device-width">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/common.css') }}?v=1.3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
        <link rel="shortcut icon" href="../asset/images/ico.ico" type="image/x-icon">
        <script src="{{ asset('js/web/jquery.min.js') }}"></script>
        <script src="{{ asset('js/web/common.js') }}"></script>
    </head>
    <body>
        <!--리스트 시작 -->
        <div class="pop-wrap">
            <h1 class="tit-pop">이전 구매한 번호 보기</h1>
            <button class="btn-pop-close" onclick="javascript:window.open('','_self').close(); ">
            <img src="{{asset('/images/web/btn_close_w.png')}}" alt="닫기">
        </button>
            <div class="pop-inner">
                <div class="table-lisw-w garde-table ">
                    <div class="item th-head">
                        <div class="w20p">구매일</div>
                        <div class="w20p">복권종류</div>
                        <div class="pwauto">번호</div>
                        <div class="w15p">당첨여부</div>
                    </div>
                    <div class="tbody">
                        @foreach($lists as $list)
                        <div class="item">
                            <div class="w20p">{{ \Carbon\Carbon::parse($list->created_at)->format('Y-m-d H:i:s') }}</div>
                            <div class="w20p">{{$list->game}}{{$list->reverse == 1?' - 리버스로또':''}}</div>
                            <div class="pwauto">{{$list->list}},<span style="color:red">{{$list->bonus}}</span></div>
                            <div class="w15p">
                                @if ($list->status == 0)
                                    결과대기중
                                @elseif ($list->result == 0)
                                    미당첨
                                @else
                                    {{ $list->result }}등
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!--pagination-->
                    <div class="paging mt20">
                        {{ $lists->appends(request()->except('page'))->links() }}                      
                    </div>                    
                </div>
            </div>
        </div>
    </body>
</html>