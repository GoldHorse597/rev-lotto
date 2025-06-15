let visualPos = 0;
function setScreenMode(){
    var screen = $(window).width();
    if(screen > 1080) screenMode = "pc";
    else if(screen < 1080)  screenMode = "mobile";
}

function gnbEvent(str){
    var mode = $.parseJSON(str);
    //var open = false;
    if(mode){
        $("body").on('click','.gnb-menu',function(){
            $(this).addClass("open");
            $('body').addClass("menu-open");
        }).on('click',".gnb-menu > .menu-item > .gnb-btn", function(){
            $(this).removeClass("open");
            $('body').removeClass("menu-open");
        })
           //.off('click',".gnb-menu > .menu-item > .gnb-btn")
            .on('click',".gnb-menu > .menu-item > .gnb-btn",function(e){
            $(this).unbind();
         });
        return false;
    }else{
        $("body").on('mouseover mouseout hover','.gnb-menu')
            .on('click',".gnb-menu > .menu-item > .gnb-btn",function(e){
                e.preventDefault();
                var li = $(this).parent();
                if(li.hasClass('open')){
                    $('.gnb-menu  > li').removeClass('open');
                }else{
                    $('.gnb-menu  > li').removeClass('open');
                    li.addClass("open");
                    open = true;
                }
            });
        return false;
    }
}
$(function() { // load init
    setScreenMode();
    var isHoverEvent = (screenMode == 'pc');
    gnbEvent(isHoverEvent);
    var savedWidth = $(window).width();

    $(window).resize(function(){
        var newWidth = $(window).width();
        if(savedWidth == newWidth) return ;
        savedWidth = newWidth;
        $("body").removeClass('menu-open');
        $(".gnb-menu > li").removeClass('on open');
        $(".gnb-menu .current").addClass('on');
        setScreenMode();
        var isHoverEvent = screenMode == 'mobile';
		

        gnbEvent(isHoverEvent);
    });
    $(window).scroll(function(){
        if(visualPos !=0){
            if(window.pageYOffset >= visualPos) $('header').addClass('gnb-fixed')
            else $('header').removeClass('gnb-fixed')
        }
    });
	$(".gnb-btn").on("click",function(){
        $("body").addClass('menu-open');
    });
    $(".btn-nav-open").on("click",function(){
        $("body").addClass('menu-open');
    });
    $(".btn-nav-close").on("click",function(){
        $("body").removeClass('menu-open');
    });
    $(".btn-nav-close1").on("click",function(){
        $("body").removeClass('menu-open');
    });
    $(".btn-nav-close2").on("click",function(){
        $("body").removeClass('menu-open');
    });
});
 

$(document).ready(function(){
    $(".quick-close").click(function(){
		setCookieQuick('lottoquickbar', 'close', '100');
        $(".quick-menu-w").animate({"right":"-58px"}, 300, function(){});
        $(".quick-open").show();
        $(".quick-close").hide();
    });
    $(".quick-open").click(function(){
		setCookieQuick('lottoquickbar', 'open', '100');
        $(".quick-menu-w").animate({"right":"0"}, 300, function(){});
        $(".quick-open").hide();
        $(".quick-close").show();
    });

	
    if ($(window).width() > 1600) {
		var lottoquickbar = getCookieQuick('lottoquickbar');
		if(lottoquickbar =="close"){
			$(".quick-menu-w").animate({"right":"-58px"}, 300, function(){});
			$(".quick-open").show();
			$(".quick-close").hide();
		}else{
			$(".quick-menu_w").animate({"right":"0"}, 300, function(){});
			$(".quick-open").hide();
			$(".quick-close").show();
		}

    }else if( $(window).width() < 1600){
        $(".quick-open").show();
        $(".quick-close").hide();
        $(".quick-menu-w").animate({"right":"-58px"}, 300, function(){});
    }

    $(".tab-view").on("mouseover",function(){
        $(".tab-view-layer").show();
    });
    $(".tab-view").on("mouseout",function(){
        $(".tab-view-layer").hide();
    });  
});



$(function(){
    $("iframe.lotto-buy-frame").load(function(){ //iframe 컨텐츠가 로드 된 후에 호출됩니다.
        var frame = $(this).get(0);
        var doc = (frame.contentDocument) ? frame.contentDocument : frame.contentWindow.document;
        $(this).height(doc.body.scrollHeight);
        //$(this).width(doc.body.scrollWidth);
    });
});

function closeWindow(){
    alert('1');
   self.opener = self;
   window.close(); 
}

function setCookieQuick(cookie_name, value, days) {
  var exdate = new Date();
  exdate.setDate(exdate.getDate() + days);
  // 설정 일수만큼 현재시간에 만료값으로 지정

  var cookie_value = escape(value) + ((days == null) ? '' : '; expires=' + exdate.toUTCString());
  document.cookie = cookie_name + '=' + cookie_value;
}

function getCookieQuick(cookie_name) {
  var x, y;
  var val = document.cookie.split(';');

  for (var i = 0; i < val.length; i++) {
    x = val[i].substr(0, val[i].indexOf('='));
    y = val[i].substr(val[i].indexOf('=') + 1);
    x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
    if (x == cookie_name) {
      return unescape(y); // unescape로 디코딩 후 값 리턴
    }
  }
}



