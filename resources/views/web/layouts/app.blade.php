<!DOCTYPE html>
    <head>
        <title>@yield('title', '리버스 로또')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta meta="" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
        <meta name="description" content="미국로또 파워볼주문 파워플레이옵션 QP주문 로또캠프">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="로또캠프-해외로또 구매대행">
        <meta property="og:title" content="파워볼 구매하기 "> 
        <meta name="keywords" content="파워볼, 메가밀리언, 로또6/45 , 연금복원720, 쌍색구, 따루토, 로또6, 로또7, 미니 공식복권 신뢰도1위 해외로또 구매대행">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href= "{{ asset('css/web/google.font.css')}}">
        <link rel="stylesheet" type="text/css" href= "{{ asset('css/web/Montserrat.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/common.css') }}?v=1.3">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/layout.css') }}?v=1.1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/main.css') }}?v=1.5">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/jquery-ui.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/sidemenu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/web/swiper.min.css') }}">
        <link rel="shortcut icon" href="{{ asset('images/web/favicon.png')}}" type="image/x-icon">

        <script async="" charset="utf-8" src="https://v2.zopim.com/?4iDvTLu9CVmKR7XoWuLCVpJmOksn4IME" type="text/javascript"></script>
        <script src="{{ asset('js/web/jquery.min.js') }}"></script>
        <script src="{{ asset('js/web/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/web/common.js') }}"></script>
        <script src="{{ asset('js/web/jquery.hoverIntent.js') }}"></script>
        <script src="{{ asset('js/web/swiper.min.js') }}"></script>
        <script src="{{ asset('js/web/sidemenu.js') }}"></script>
        <script src="{{ asset('js/web/jquery.stickyNavbar.min.js') }}"></script>    
    
        <script>
        function openIdpass2() {
            window.open("/ver_02/w_member/grade.php", "LottoCamp","scrollbars=no, width=500,height=650");
        }
        </script>
        <!--Start of Zendesk Chat Script-->
        <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="https://v2.zopim.com/?4iDvTLu9CVmKR7XoWuLCVpJmOksn4IME";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        </script>
        <!--End of Zendesk Chat Script-->

    </head>

    <body>
        
        <div class="wrap">
        {{-- 헤더 --}}
        @include('web.layouts.header');

        {{-- 컨텐츠 --}}
        @yield('content')

        {{-- Footer --}}
        @include('web.layouts.footer')
        </div>

        @if(!empty($unreadMessage) && !request()->is('mypage/message*'))
        <div id="messageModal" class="custom-modal">
            <div class="custom-modal-content">                
                <h2>📩 새 쪽지가 도착했어요</h2>
                <p><strong> 확인하지 않은 메세지가 있습니다.</strong></p>
                <p>쪽지함을 확인하세요.</p>
                <div style="text-align:right">
                    <a href="{{ route('mypage.message') }}" class="custom-btn">쪽지함 가기</a>
                </div>
            </div>
        </div>
        @endif
       <script>            

            document.addEventListener('DOMContentLoaded', function () {
                var modal = document.getElementById('messageModal');
                if (modal) {
                modal.style.display = 'block';
                }
            });
        </script>
        <style>
            .custom-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            }

            .custom-modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
            }
            
            .custom-modal-content p{
                margin:10px
            }
            .custom-close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 25px;
            font-weight: bold;
            cursor: pointer;
            }

            .custom-btn {
            display: inline-block;
            padding: 8px 16px;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            }
            .custom-btn:hover {
            background: #0056b3;
            }
        </style>
    </body>    
</html>