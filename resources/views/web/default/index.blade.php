<html lang="ko">
	@extends('web.layouts.app')

	@section('title', '리버스 로또')

 	@section('content')
		<style>
			.quick-prod-top{display:none}
			.container{padding-top:106px}
			@media screen and (max-width:768px){.container{padding-top:55px}}
		</style>
		<div class="container">
			<div class="main-inner-bn">
				<div class="main-bn">
				<div class="swiper-container swiper-container-horizontal swiper-container-autoheight">
					<div class="swiper-wrapper" style="height: 395px; transform: translate3d(-4200px, 0px, 0px); transition-duration: 0ms;">
					<div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="4" style="width: 840px;">
						<a href="/play/lotto_etc?part_idx=5">
						<img src="{{asset('/images/web/main_bn_05.jpg')}}">
						</a>
					</div>
					<div class="swiper-slide swiper-slide-duplicate-next" data-swiper-slide-index="0" style="width: 840px;">
						<a href="/play/lotto_etc?part_idx=1">
						<img src="{{asset('/images/web/main_bn_01.jpg')}}">
						</a>
					</div>
				
					<div class="swiper-slide" data-swiper-slide-index="2" style="width: 840px;">
						<a href="/play/lotto_etc?part_idx=2">
						<img src="{{asset('/images/web/main_bn_02.jpg')}}">
						</a>
					</div>
					<div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="3" style="width: 840px;">
						<a href="/play/lotto_etc?part_idx=3">
						<img src="{{asset('/images/web/main_bn_03.jpg')}}">
						</a>
					</div>
					<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="4" style="width: 840px;">
						<a href="/play/lotto_etc?part_idx=5">
						<img src="{{asset('/images/web/main_bn_05.jpg')}}">
						</a>
					</div>
					<div class="swiper-slide swiper-slide-duplicate swiper-slide-next" data-swiper-slide-index="0" style="width: 840px;">
						<a href="/play/lotto_etc?part_idx=1">
						<img src="{{asset('/images/web/main_bn_01.jpg')}}">
						</a>
					</div>
					</div>
					<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
						<span class="swiper-pagination-bullet"></span>
						<span class="swiper-pagination-bullet"></span>
						<span class="swiper-pagination-bullet"></span>
						<span class="swiper-pagination-bullet"></span>
						<span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
					</div>
				</div>
				</div>
				<div class="main-hot-notice">
				<h3>HOT! 최근 소식</h3>
				<a href="/customer/notice" class="btn-more-w"></a>
				@foreach($news as $new)
				<a href="/customer/{{$new->type}}_view?id={{$new->id}}" class="linked">
					<span class="content">
					<span class="tit">{{$new->title}}</span>
					<span class="ico-new">NEW</span>
					</span>
					<span class="date">{{ \Carbon\Carbon::parse($new->created_at)->format('Y-m-d') }}</span>
				</a>
				@endforeach				
				</div>
			</div>
			<div class="main-lotto-buy-w" id="lottoBuy">
				<div class="main-lotto-inner">
				<h3>로또 구매</h3>
				<div class="main-lotto-buy">
					<div id="swiperBox" class="swiper-container swiper-container-horizontal swiper-container-autoheight">
						<div class="swiper-wrapper" style="height: 309px;">
							@foreach($games as $index => $game)
								@php									
									$dt = \Carbon\Carbon::parse($game->weekday);
									$weekdays = ['일', '월', '화', '수', '목', '금', '토'];
								@endphp

								@if($game->abbr == 'live')
								<div class="swiper-slide {{$index == 1 ? 'swiper-slide-active' :''}}" style="width: 245.4px; margin-right: 20px;">
									<div class="logo">
										<img src="{{ asset('/images/web/logo/logo2_' . $game->abbr . '.png') }}">
									</div>
									<div class="pay">추첨후 표기</div>
									<div class="date">추첨 : 매일 19:30</div>
									<div class="end-date">주문마감 : 상시구매가능
										
									</div>
									<div class="num">
										<!--em class="bg-sky">이월</em-->
										<a href="javascript:sign();">
										<em class="bg-red">마감</em>
										</a> {{$game->lastresult}} <span class="t-red">{{$game->bonus}}</span>
									</div>
									<div class="btn">
										<a href="/play/lotto_{{$game->abbr}}" class="btn-comm btn-pk">구매하기</a>
									</div>
								</div>
								@else
								<script type="text/javascript">
									function getTime{{$index}}() {
										now = new Date();
										k_year{{$index}} = Number("{{ $dt->format('Y') }}");     // 2025
										k_month{{$index}} = Number("{{ $dt->format('m') }}") - 1; // 5 (JavaScript는 0부터 시작)
										k_day{{$index}} = Number("{{ $dt->format('d') }}");       // 26
										k_hour{{$index}} = Number("{{ $dt->format('H') }}");      // 00
										k_min{{$index}} = Number("{{ $dt->format('i') }}");  
										//alert(k_year);
										dday{{$index}} = new Date(k_year{{$index}}, k_month{{$index}}, k_day{{$index}}, k_hour{{$index}}, k_min{{$index}}, '59');
										//alert(dday);
										days{{$index}} = (dday{{$index}} - now) / 1000 / 60 / 60 / 24;
										//alert (days);
										daysRound{{$index}} = Math.floor(days{{$index}});
										hours{{$index}} = (dday{{$index}} - now) / 1000 / 60 / 60 - (24 * daysRound{{$index}});
										hoursRound{{$index}} = Math.floor(hours{{$index}});
										minutes{{$index}} = (dday{{$index}} - now) / 1000 / 60 - (24 * 60 * daysRound{{$index}}) - (60 * hoursRound{{$index}});
										minutesRound{{$index}} = Math.floor(minutes{{$index}});
										seconds{{$index}} = (dday{{$index}} - now) / 1000 - (24 * 60 * 60 * daysRound{{$index}}) - (60 * 60 * hoursRound{{$index}}) - (60 * minutesRound{{$index}});
										secondsRound{{$index}}= Math.round(seconds{{$index}});
										//alert (getTime);
										//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
										if (Number(daysRound{{$index}} + "" + hoursRound{{$index}} + "" + minutesRound{{$index}} + "" + secondsRound{{$index}}) > 0) {
										if (hoursRound{{$index}} < 10) {
											hoursRound_str{{$index}} = "0" + hoursRound{{$index}};
										} else {
											hoursRound_str{{$index}} = hoursRound{{$index}};
										}
										if (minutesRound{{$index}} < 10) {
											minutesRound_str{{$index}} = "0" + minutesRound{{$index}};
										} else {
											minutesRound_str{{$index}} = minutesRound{{$index}};
										}
										if (secondsRound{{$index}} < 10) {
											secondsRound_str{{$index}} = "0" + secondsRound{{$index}};
										} else {
											secondsRound_str{{$index}} = secondsRound{{$index}};
										}
										document.getElementById("show_cate_str{{$index}}").innerHTML = daysRound{{$index}} + "일 " + hoursRound_str{{$index}} + ":" + minutesRound_str{{$index}} + ":" + secondsRound_str{{$index}} + " ";
										} else {
										document.getElementById("show_cate_str{{$index}}").innerHTML = "마감";
										}
										newtime{{$index}} = window.setTimeout("getTime{{$index}}();", 1000);
									}
								</script>
								
								<div class="swiper-slide {{$index == 1 ? 'swiper-slide-active' :''}}" style="width: 245.4px; margin-right: 20px;">
									<div class="logo">
										<img src="{{ asset('/images/web/logo/logo2_' . $game->abbr . '.png') }}">
									</div>
									<div class="pay">추첨후 표기</div>
									<div class="date">추첨 : {{ $dt->format('Y.m.d') }} ({{ $weekdays[$dt->dayOfWeek] }}) {{ $dt->format('H:i') }}</div>
									<div class="end-date">주문마감 : <span id="show_cate_str{{$index}}">1일 12:37:53 </span>
										<script>
										getTime{{$index}}();
										</script>
									</div>
									<div class="num">
										<!--em class="bg-sky">이월</em-->
										<a href="javascript:sign();">
										<em class="bg-red">마감</em>
										</a> {{$game->lastresult}} <span class="t-red">{{$game->bonus}}</span>
									</div>
									<div class="btn">
										<a href="/play/lotto_{{$game->abbr}}" class="btn-comm btn-pk">구매하기</a>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
					<button class="btn-lotto-prev swiper-button-disabled"><img src="{{asset('/images/web/btn_main_swiper_prev.png')}}" alt="이전"></button>
					<button class="btn-lotto-next"><img src="{{asset('/images/web/btn_main_swiper_next.png')}}" alt="다음"></button>
					<div class="pagination-w">
					<div class="pagination-w">
                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
                        <!-- <button type="button" class="btn-view-all btn-view-open">View All</button> -->
                    </div>
					</div>
				</div>
				</div>
			</div>
			<div class="main-bbs-w">
				<div class="main-bbs-inner">
					<div class="con">
						<div class="bbs-w">
							<ul>
								<li class="selected">공지사항</li>							
							</ul>
							
							<div class="main-bbs-list">
								<a href="/customer/notice" class="btn-more"></a>
								@foreach($notices as $notice)
								<div class="item">
									<span class="linked">
										<a href="/customer/notice_view?id={{$notice->id}}">{{$notice->title}}</a>
									</span>
									@if($notice->created_at->gt(\Carbon\Carbon::now()->subDays(1))) 
										<span class="ico-new">NEW</span>
									@endif
								</div>
								@endforeach
							</div>
							
						</div>
						<div class="bbs-w">
							<ul><li class="selected">이벤트</li></ul>
							<div class="main-bbs-list">
								<a href="/customer/event" class="btn-more"></a>
								@foreach($events as $event)
								<div class="item">
									<span class="linked">
										<a href="/customer/event_view?id={{$event->id}}">{{$event->title}}</a>
									</span>
									@if($event->created_at->gt(\Carbon\Carbon::now()->subDays(1)))
									<span class="ico-new">NEW</span>
									@endif
								</div>
								@endforeach
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				const swiperBox = document.getElementById('swiperBox');

				// 모바일이 아닐 때에만 클래스 추가
				if (window.innerWidth > 768) {
					swiperBox.classList.add('swiper-container-horizontal', 'swiper-container-autoheight');
				} else {
					swiperBox.classList.remove('swiper-container-horizontal', 'swiper-container-autoheight');
				}
			});
			var bannerSwiper = new Swiper('.main-bn .swiper-container', {
				loop: true,
				pagination: '.main-bn .swiper-pagination',
				paginationClickable: true,
				nextButton: '.btn-partner-next',
				prevButton: '.btn-partner-prev',
				slidesPerView: 1,
				autoHeight:true,
				autoplay: 5000,
			});

			var lottoSwiper = undefined;
			function initSwiper(){
				var screenWidth = $(window).width();
				if(screenWidth > 780 && lottoSwiper == undefined){
					var lottoSwiper = new Swiper('.main-lotto-buy .swiper-container', {
						pagination: '.main-lotto-buy .swiper-pagination',
						paginationClickable: true,
						nextButton: '.btn-lotto-next',
						prevButton: '.btn-lotto-prev',
						slidesPerView: 5,
						slidesPerGroup: 5,
						spaceBetween: 20,
						autoHeight:true,
						breakpoints: {
							620: {
								slidesPerView: 1,
								slidesPerGroup: 1,
								spaceBetween: 20,
							},
							920: {
								slidesPerView: 2,
								slidesPerGroup: 2,
								spaceBetween: 20,
							},
							1280: {
								slidesPerView: 3,
								slidesPerGroup: 3,
								spaceBetween: 20,
							},
							1500: {
								slidesPerView: 4,
								slidesPerGroup: 4,
								spaceBetween: 20,
							},
						},
					});
				}else if(screenWidth < 780 && lottoSwiper != undefined){
					Swiper.destroy();
					Swiper = undefined;
					$('.swiper-wrapper').removeAttr('style');
					$('.swiper-slide').removeAttr('style');
				}
			}

			initSwiper();
			$(window).on('resize', function(){
				initSwiper();
			});

			$(document).ready(function() {
				$(".btn-view-open").click(function () {
					$(".main-lotto-buy-all").show();
					$(".main-lotto-buy").hide();
				});

				$(".btn-view-close").click(function () {
					$(".main-lotto-buy-all").hide();
					$(".main-lotto-buy").show();
				});
			});

			function bbsTab(tabNum){
				$(".bbs-w ul li").removeClass("selected");
				$(".bbs-w ul li").eq(tabNum-1).addClass("selected");
				$(".main-bbs-list").hide();
				$(".main-bbs-list").eq(tabNum-1).show();
			}
			
		</script>
	
	@endsection