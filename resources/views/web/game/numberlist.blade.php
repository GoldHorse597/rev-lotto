<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>리버스로또</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, width=device-width" />
    <meta name="description" content="리버스로또">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="리버스로또">
    <meta property="og:title" content="리버스로또">
    <meta property="og:description" content="리버스로또">
    <meta property="og:url" content="https://rev-lotto.com">
    <meta property="og:image" content="images/header/logo_header.png">
    <meta name="keywords" content="리버스로또" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
 
   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/common.css') }}?v=1.3">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/layout.css') }}?v=1.1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/main.css') }}?v=1.5">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/sidemenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/swiper.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/web/favicon.png')}}" type="image/x-icon">

    
    <script src="{{ asset('js/web/jquery.min.js') }}"></script>
    <script src="{{ asset('js/web/common.js') }}"></script>
    <script src="{{ asset('js/web/jquery.hoverIntent.js') }}"></script>
    <script src="{{ asset('js/web/swiper.min.js') }}"></script>
    <script src="{{ asset('js/web/sidemenu.js') }}"></script>
    <script src="{{ asset('js/web/jquery.stickyNavbar.min.js') }}"></script>  
  </head>
  <body>
    <script type="text/javascript">
      // 마이번호 삭제
      function numDel(idx) {
        frm = document.form_del;
        var choose = confirm('삭제 하시겠습니까?');
        if (choose) {
          frm.idx.value = idx;
          frm.submit();
        } else {
          return;
        }
      }

      function allCheck() {
        var f = document.forms['listform'];
        if (typeof(f.del_list) == 'object') {
          if (f.allchk.checked) {
            if (f.del_list.length)
              for (var i = 0; i < f.del_list.length; i++) f.del_list[i].checked = true;
            else f.del_list.checked = true
          } else {
            if (f.del_list.length)
              for (var i = 0; i < f.del_list.length; i++) f.del_list[i].checked = false;
            else f.del_list.checked = false;
          }
        } else {
          if (f.allchk.checked) {
            alert('선택한 번호리스트가 없습니다.');
            f.allchk.checked = false;
            return;
          } else return;
        }
      }

      function actSelect() {
        var f = document.forms['listform'];
        var arr_del_list = new Array();
        var i, j;
        if (typeof(f.del_list) == 'object') {
          //alert (f.del_list.length);
          if (f.del_list.length) {
            for (i = 0, j = 0; i < f.del_list.length; i++) {
              if (f.del_list[i].checked) {
                arr_del_list[i] = f.del_list[i].value;
                j++;
              }
            }
            if (!j) {
              alert('리스트를 선택하여 주세요.');
              return;
            } else f.arr_del_list.value = arr_del_list.join('@');
          } else {
            if (!f.del_list.checked) {
              alert('리스트를 선택하여 주세요.');
              return;
            }
          }
          if (j == 1) f.arr_del_list.value = '';
          //exit;
          if (confirm('삭제하시겠습니까?')) f.submit();
        } else {
          alert('선택한 번호가 리스트가 없습니다.');
          return;
        }
      }
      function actpurchage() {
        var f = document.forms['listform'];
        var arr_del_list = new Array();
        var i, j;
        if (typeof(f.del_list) == 'object') {
          //alert (f.del_list.length);
          if (f.del_list.length) {
            for (i = 0, j = 0; i < f.del_list.length; i++) {
              if (f.del_list[i].checked) {
                arr_del_list[i] = f.del_list[i].value;
                j++;
              }
            }
            if (!j) {
              alert('리스트를 선택하여 주세요.');
              return;
            } else f.arr_del_list.value = arr_del_list.join('@');
          } else {
            if (!f.del_list.checked) {
              alert('리스트를 선택하여 주세요.');
              return;
            }
          }
          
          if (j == 1) f.arr_del_list.value = '';
          //exit;
          if (confirm('구입하시겠습니까?'))
          {
            f.mode.value = "purchage";
            f.submit();
          }
        } else {
          alert('선택한 번호가 리스트가 없습니다.');
          return;
        }
      }
    </script>
    <!--리스트 시작 -->
    <form name="form_del" method="post" action="number_list_ok">
        @csrf
        <input type="hidden" name="mode" value="del">
        <input type="hidden" name="idx" value="">
        <input type="hidden" name="part_idx" value="{{$gameId}}">
    </form>
    <div class="wrap-iframe">
        <form method="post" action="number_list_ok" name="listform">
            @csrf
            <input type="hidden" id="mode" name="mode" value="alldel">
            <input type="hidden" name="arr_del_list" value="">
            <input type="hidden" name="reverse" value="{{$reverse}}">
            <input type="hidden" name="part_idx" value="{{$gameId}}">
            <div class="table-lisw-w table-line-type buy-select-num">
            <div class="item th-head">
                <div class="pw20p t-l">
                <label>
                    <input type="checkbox" name="allchk" onClick="allCheck();this.blur()">
                </label> 번호 <span class="mo-hide">(선택시 삭제)</span>
                </div>
                <div class="pwauto">금액</div>
                <div class="pwauto">선택번호</div>
                <div class="pw15p">선택 <br class="mo-view">방법 </div>
                <div class="pw15p">삭제</div>
            </div>
            <div class="tbody">
                @foreach($lists as $index=> $list)
                <div class="item">
                    <div class="pw20p t-l">
                        <label>
                        <input type="checkbox" name="del_list" value="{{$list->id}}">
                        </label> {{$index}}
                    </div>
                    <div class="pwauto">{{number_format(floor($list->amount),0)}}</span></div>
                    <div class="pwauto">{{$list->list}}&nbsp;<span style='color:red'>{{$list->bonus}}</span>
                    </div>
                    <div class="pw15p">{{ $list->type == 1 ? '수동선택' : ($list->type == 2 ? '자동선택' : '반자동선택') }}</div>
                    <div class="pw15p">
                        <button type="button" onClick="javascript:numDel('{{$list->id}}');" class="btn-delete">
                        <img src="{{asset('/images/web/ico_delete.png')}}" alt="삭제">
                        </button>
                    </div>             
                </div>
                @endforeach
            </div>
            <div class="list-result"></div>
            </div>
            <div class="btn-buy-num">
            <a href="#none" class="btn-comm btn-dpk" onClick="javascript:actpurchage()">바로구매하기</a>
            <a href="#none" class="btn-comm btn-bl" onClick="javascript:actSelect()">전체삭제</a>
            </div>
        </form>
    </div>
  </body>
</html>