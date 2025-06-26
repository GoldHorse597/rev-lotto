<div class="footer-play-info">
  <div class="footer-play-inner">
    <div class="swiper-container swiper-container-horizontal swiper-container-autoheight">
      <div class="swiper-wrapper" style="height: 82px; transform: translate3d(-3045px, 0px, 0px); transition-duration: 0ms;">
        <div class="swiper-slide " data-swiper-slide-index="4" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_live" title="실시간로또">
            <img src="{{ asset('images/web/logo_live.png')}}" alt="실시간로또">
          </a>
        </div>
        <div class="swiper-slide " data-swiper-slide-index="5" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_kr" title="로또6/45(한국)">
            <img src="{{ asset('images/web/logo_kr.png')}}" alt="로또6/45(한국)">
          </a>
        </div>
        
        <div class="swiper-slide " data-swiper-slide-index="7" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_pb" title="파워볼(미국)">
            <img src="{{ asset('images/web/logo_pb.png')}}" alt="파워볼(미국)">
          </a>
        </div>
        <div class="swiper-slide " data-swiper-slide-index="8" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_mm.php" title="메가밀리언(미국)">
            <img src="{{ asset('images/web/logo_mm.png')}}" alt="메가밀리언(미국)">
          </a>
        </div>
        <div class="swiper-slide " data-swiper-slide-index="9" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_ssq" title="쌍색구(중국)">
            <img src="{{ asset('images/web/logo_ssq.png')}}" alt="쌍색구(중국)">
          </a>
        </div>
        <div class="swiper-slide " data-swiper-slide-index="0" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_dlt" title="따루토(중국)">
            <img src="{{ asset('images/web/logo_dlt.png')}}" alt="따루토(중국)">
          </a>
        </div>
        <div class="swiper-slide " data-swiper-slide-index="1" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_6" title="로또6(일본)">
            <img src="{{ asset('images/web/logo_6.png')}}" alt="로또6(일본)">
          </a>
        </div>
        <div class="swiper-slide " data-swiper-slide-index="2" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_7" title="로또7(일본)">
            <img src="{{ asset('images/web/logo_7.png')}}" alt="로또7(일본)">
          </a>
        </div>

        <div class="swiper-slide " data-swiper-slide-index="3" style="width: 207.5px; margin-right: 10px;">
          <a href="/jplay/lotto_mini" title="미니로또(일본)">
            <img src="{{ asset('images/web/logo_mini.png')}}" alt="미니로또(일본)">
          </a>
        </div>
        
       
      </div>
    </div>
    <div class="f-btn">
      <button class="btn-f-prev">
        <img src="{{ asset('images/web/btn_f_bn_prev.gif')}}" alt="이전">
      </button>
      <button class="btn-f-stop">
        <img src="{{ asset('images/web/btn_f_bn_stop.gif')}}" alt="정지">
      </button>
      <button class="btn-f-play" style="display:none">
        <img src="{{ asset('images/web/btn_f_bn_start.gif')}}" alt="시작">
      </button>
      <button class="btn-f-next">
        <img src="{{ asset('images/web/btn_f_bn_next.gif')}}" alt="다음">
      </button>
    </div>
  </div>
</div>
<footer>
  <div class="warning">
    <img src="{{ asset('images/web/img_19.png')}}">
    <span>You must be 19 or over to play or claim a prize <br> 국가별로 미성년자는 주문과 상금을 수령할 수 없으며, 주문지역에서 법적으로 허용되지 않는 주문은 취소될 수 있습니다. </span>
  </div>
</footer>

<script>
    var fPlaySwiper = new Swiper('.footer-play-inner .swiper-container', {
        loop: true,
        pagination: '.footer-play-inner .swiper-pagination',
        paginationClickable: true,
        nextButton: '.btn-f-next',
        prevButton: '.btn-f-prev',
        slidesPerView: 6,
        spaceBetween: 10,
        autoHeight:true,   
        autoplay: 3000,  
        breakpoints: {
            480: {
                slidesPerView: 2,
                slidesPerGroup: 2,
                spaceBetween: 10,
            },
            680: {
                slidesPerView: 3,
                slidesPerGroup: 3,
                spaceBetween: 10,
            },
            980: {
                slidesPerView: 4,
                slidesPerGroup: 4,
                spaceBetween: 10,
            },
            1280: {
                slidesPerView: 5,
                slidesPerGroup: 5,
                spaceBetween: 10,
            }, 
        }, 
    });

    $(document).ready(function(){
        $(".btn-f-stop").on("click",function(){
            fPlaySwiper.stopAutoplay();
            $(".btn-f-stop").hide();
            $(".btn-f-play").show();
        });
        $(".btn-f-play").on("click",function(){
            fPlaySwiper.startAutoplay();
            $(".btn-f-stop").show();
            $(".btn-f-play").hide();
        });        
    });
</script>