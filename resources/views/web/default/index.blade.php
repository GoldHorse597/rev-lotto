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
				<a href="w_customer/lotto_news.php" class="btn-more-w"></a>
				<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPSZjb2RlPSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||" class="linked">
					<span class="content">
					<span class="tit">[중요] 접속주소변경 및 서버 업데이트작업 안내</span>
					<span class="ico-new">NEW</span>
					</span>
					<span class="date">2025-06-11</span>
				</a>
				<a href="./w_customer/win_story_view?bbs_data=aWR4PTcwMjcmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPSZjb2RlPSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||" class="linked">
					<span class="content">
					<span class="tit">2025년 Contra el Cancer 항암 특별복권 추첨소식</span>
					<span class="ico-new">NEW</span>
					</span>
					<span class="date">2025-06-08</span>
				</a>
				<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjYmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPSZjb2RlPSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||" class="linked">
					<span class="content">
					<span class="tit">[중요] 금일(6일) 유로밀리언 조기마감</span>
					<span class="ico-new">NEW</span>
					</span>
					<span class="date">2025-06-06</span>
				</a>
				</div>
			</div>
			<div class="main-lotto-buy-w" id="lottoBuy">
				<div class="main-lotto-inner">
				<h3>로또 구매</h3>
				<div class="main-lotto-buy">
					<div class="swiper-container swiper-container-horizontal swiper-container-autoheight">
					<div class="swiper-wrapper" style="height: 309px;">
						<script type="text/javascript">
						function getTime() {
							now = new Date();
							k_year = Number("2025");
							k_month = Number("06") - 1;
							k_day = Number("16");
							k_hour = Number("23");
							k_min = Number("50");
							//alert(k_year);
							dday = new Date(k_year, k_month, k_day, k_hour, k_min, '59');
							//alert(dday);
							days = (dday - now) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound = Math.floor(days);
							hours = (dday - now) / 1000 / 60 / 60 - (24 * daysRound);
							hoursRound = Math.floor(hours);
							minutes = (dday - now) / 1000 / 60 - (24 * 60 * daysRound) - (60 * hoursRound);
							minutesRound = Math.floor(minutes);
							seconds = (dday - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
							secondsRound = Math.round(seconds);
							//alert (getTime);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound + "" + hoursRound + "" + minutesRound + "" + secondsRound) > 0) {
							if (hoursRound < 10) {
								hoursRound_str = "0" + hoursRound;
							} else {
								hoursRound_str = hoursRound;
							}
							if (minutesRound < 10) {
								minutesRound_str = "0" + minutesRound;
							} else {
								minutesRound_str = minutesRound;
							}
							if (secondsRound < 10) {
								secondsRound_str = "0" + secondsRound;
							} else {
								secondsRound_str = secondsRound;
							}
							document.getElementById("show_cate_str").innerHTML = daysRound + "일 " + hoursRound_str + ":" + minutesRound_str + ":" + secondsRound_str + " ";
							} else {
							document.getElementById("show_cate_str").innerHTML = "마감";
							}
							newtime = window.setTimeout("getTime();", 1000);
						}
						</script>
						<div class="swiper-slide swiper-slide-active" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_pb.jpg')}}">
						</div>
						<div class="pay">1,120억 <span class="money">$80,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.17 (화) 12:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str">1일 12:37:53 </span>
							<script>
							getTime();
							</script>
						</div>
						<div class="num">
							<!--em class="bg-sky">이월</em-->
							<a href="javascript:sign();">
							<em class="bg-red">마감</em>
							</a> 13,25,29,37,53, <span class="t-red">3</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_pb.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime2() {
							now2 = new Date();
							k_year2 = Number("2025");
							k_month2 = Number("06") - 1;
							k_day2 = Number("17");
							k_hour2 = Number("23");
							k_min2 = Number("50");
							dday2 = new Date(k_year2, k_month2, k_day2, k_hour2, k_min2, '59');
							//alert(dday);
							days2 = (dday2 - now2) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound2 = Math.floor(days2);
							hours2 = (dday2 - now2) / 1000 / 60 / 60 - (24 * daysRound2);
							hoursRound2 = Math.floor(hours2);
							minutes2 = (dday2 - now2) / 1000 / 60 - (24 * 60 * daysRound2) - (60 * hoursRound2);
							minutesRound2 = Math.floor(minutes2);
							seconds2 = (dday2 - now2) / 1000 - (24 * 60 * 60 * daysRound2) - (60 * 60 * hoursRound2) - (60 * minutesRound2);
							secondsRound2 = Math.round(seconds2);
							//alert (getTime);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound2 + "" + hoursRound2 + "" + minutesRound2 + "" + secondsRound2) > 0) {
							if (hoursRound2 < 10) {
								hoursRound_str2 = "0" + hoursRound2;
							} else {
								hoursRound_str2 = hoursRound2;
							}
							if (minutesRound2 < 10) {
								minutesRound_str2 = "0" + minutesRound2;
							} else {
								minutesRound_str2 = minutesRound2;
							}
							if (secondsRound2 < 10) {
								secondsRound_str2 = "0" + secondsRound2;
							} else {
								secondsRound_str2 = secondsRound2;
							}
							document.getElementById("show_cate_str2").innerHTML = daysRound2 + "일 " + hoursRound_str2 + ":" + minutesRound_str2 + ":" + secondsRound_str2 + " ";
							} else {
							document.getElementById("show_cate_str2").innerHTML = "마감";
							}
							newtime2 = window.setTimeout("getTime2();", 1000);
						}
						</script>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_mm.jpg')}}">
						</div>
						<div class="pay">3,920억 <span class="money">$280,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.18 (수) 12:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str2">2일 12:37:53 </span>
							<script>
							getTime2();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 8,10,22,40,47, <span class="t-red">1</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_mm.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime3() {
							now3 = new Date();
							k_year3 = Number("2025");
							k_month3 = Number("06") - 1;
							k_day3 = Number("17");
							k_hour3 = Number("23");
							k_min3 = Number("50");
							dday3 = new Date(k_year3, k_month3, k_day3, k_hour3, k_min3, '59');
							//alert(dday);
							days3 = (dday3 - now3) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound3 = Math.floor(days3);
							hours3 = (dday3 - now3) / 1000 / 60 / 60 - (24 * daysRound3);
							hoursRound3 = Math.floor(hours3);
							minutes3 = (dday3 - now3) / 1000 / 60 - (24 * 60 * daysRound3) - (60 * hoursRound3);
							minutesRound3 = Math.floor(minutes3);
							seconds3 = (dday3 - now3) / 1000 - (24 * 60 * 60 * daysRound3) - (60 * 60 * hoursRound3) - (60 * minutesRound3);
							secondsRound3 = Math.round(seconds3);
							if (Number(daysRound3 + "" + hoursRound3 + "" + minutesRound3 + "" + secondsRound3) > 0) {
							if (hoursRound3 < 10) {
								hoursRound_str3 = "0" + hoursRound3;
							} else {
								hoursRound_str3 = hoursRound3;
							}
							if (minutesRound3 < 10) {
								minutesRound_str3 = "0" + minutesRound3;
							} else {
								minutesRound_str3 = minutesRound3;
							}
							if (secondsRound3 < 10) {
								secondsRound_str3 = "0" + secondsRound3;
							} else {
								secondsRound_str3 = secondsRound3;
							}
							document.getElementById("show_cate_str3").innerHTML = daysRound3 + "일 " + hoursRound_str3 + ":" + minutesRound_str3 + ":" + secondsRound_str3 + " ";
							} else {
							document.getElementById("show_cate_str3").innerHTML = "마감";
							}
							newtime3 = window.setTimeout("getTime3();", 1000);
						}
						</script>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_nl.jpg')}}">
						</div>
						<div class="pay">189억 <span class="money">$13,500,000</span>
						</div>
						<div class="date">추첨 : 2025.06.19 (목) 09:15</div>
						<div class="end-date">주문마감 : <span id="show_cate_str3">2일 12:37:53 </span>
							<script>
							getTime3();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 2,9,24,27,34,43, <span class="t-red">58 </span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_nl.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime8() {
							now8 = new Date();
							k_year8 = Number("2025");
							k_month8 = Number("06") - 1;
							k_day8 = Number("17");
							k_hour8 = Number("23");
							k_min8 = Number("50");
							dday8 = new Date(k_year8, k_month8, k_day8, k_hour8, k_min8, '59');
							//alert(dday);
							days8 = (dday8 - now8) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound8 = Math.floor(days8);
							hours8 = (dday8 - now8) / 1000 / 60 / 60 - (24 * daysRound8);
							hoursRound8 = Math.floor(hours8);
							minutes8 = (dday8 - now8) / 1000 / 60 - (24 * 60 * daysRound8) - (60 * hoursRound8);
							minutesRound8 = Math.floor(minutes8);
							seconds8 = (dday8 - now8) / 1000 - (24 * 60 * 60 * daysRound8) - (60 * 60 * hoursRound8) - (60 * minutesRound8);
							secondsRound8 = Math.round(seconds8);
							if (Number(daysRound8 + "" + hoursRound8 + "" + minutesRound8 + "" + secondsRound8) > 0) {
							if (hoursRound8 < 10) {
								hoursRound_str8 = "0" + hoursRound8;
							} else {
								hoursRound_str8 = hoursRound8;
							}
							if (minutesRound8 < 10) {
								minutesRound_str8 = "0" + minutesRound8;
							} else {
								minutesRound_str8 = minutesRound8;
							}
							if (secondsRound8 < 10) {
								secondsRound_str8 = "0" + secondsRound8;
							} else {
								secondsRound_str8 = secondsRound8;
							}
							document.getElementById("show_cate_str8").innerHTML = daysRound8 + "일 " + hoursRound_str8 + ":" + minutesRound_str8 + ":" + secondsRound_str8 + " ";
							} else {
							document.getElementById("show_cate_str8").innerHTML = "마감";
							}
							newtime8 = window.setTimeout("getTime8();", 1000);
						}
						</script>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_cfl.jpg')}}">
						</div>
						<div class="pay">1,000불 <span>/ 매일</span>
						</div>
						<div class="date">추첨 : 2025.06.18 (수) 10:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str8">2일 12:37:53 </span>
							<script>
							getTime8();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 13,34,38,40,55, <span class="t-red">3</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_cfl.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime5() {
							now5 = new Date();
							k_year5 = Number("2025");
							k_month5 = Number("06") - 1;
							k_day5 = Number("20");
							k_hour5 = Number("17");
							k_min5 = Number("50");
							dday5 = new Date(k_year5, k_month5, k_day5, k_hour5, k_min5, '59');
							//alert(dday);
							days5 = (dday5 - now5) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound5 = Math.floor(days5);
							hours5 = (dday5 - now5) / 1000 / 60 / 60 - (24 * daysRound5);
							hoursRound5 = Math.floor(hours5);
							minutes5 = (dday5 - now5) / 1000 / 60 - (24 * 60 * daysRound5) - (60 * hoursRound5);
							minutesRound5 = Math.floor(minutes5);
							seconds5 = (dday5 - now5) / 1000 - (24 * 60 * 60 * daysRound5) - (60 * 60 * hoursRound5) - (60 * minutesRound5);
							secondsRound5 = Math.round(seconds5);
							if (Number(daysRound5 + "" + hoursRound5 + "" + minutesRound5 + "" + secondsRound5) > 0) {
							if (hoursRound5 < 10) {
								hoursRound_str5 = "0" + hoursRound5;
							} else {
								hoursRound_str5 = hoursRound5;
							}
							if (minutesRound5 < 10) {
								minutesRound_str5 = "0" + minutesRound5;
							} else {
								minutesRound_str5 = minutesRound5;
							}
							if (secondsRound5 < 10) {
								secondsRound_str5 = "0" + secondsRound5;
							} else {
								secondsRound_str5 = secondsRound5;
							}
							document.getElementById("show_cate_str5").innerHTML = daysRound5 + "일 " + hoursRound_str5 + ":" + minutesRound_str5 + ":" + secondsRound_str5 + " ";
							} else {
							document.getElementById("show_cate_str5").innerHTML = "마감";
							}
							newtime5 = window.setTimeout("getTime5();", 1000);
						}
						</script>
						<!--div id="lotto_01_blk"><a href="javascript:alert('서비스준비중입니다.')"></a></div-->
						<!--div class="label_none"></div-->
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_em.jpg')}}">
						</div>
						<div class="pay">3,975억 <span class="money">€250,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.21 (토) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str5">5일 06:37:53 </span>
							<script>
							getTime5();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 2,28,40,43,45, <span class="t-red">3,7</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_em.php" class="btn-comm btn-pk">구매하기</a>
							<a href="/jplay/lotto_em_qp.php" class="btn-comm btn-gb">QP구매</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime4() {
							now4 = new Date();
							k_year4 = Number("2025");
							k_month4 = Number("06") - 1;
							k_day4 = Number("20");
							k_hour4 = Number("17");
							k_min4 = Number("50");
							//alert(k_year);
							dday4 = new Date(k_year4, k_month4, k_day4, k_hour4, k_min4, '59');
							//alert(dday);
							days4 = (dday4 - now4) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound4 = Math.floor(days4);
							hours4 = (dday4 - now4) / 1000 / 60 / 60 - (24 * daysRound4);
							hoursRound4 = Math.floor(hours4);
							minutes4 = (dday4 - now4) / 1000 / 60 - (24 * 60 * daysRound4) - (60 * hoursRound4);
							minutesRound4 = Math.floor(minutes4);
							seconds4 = (dday4 - now4) / 1000 - (24 * 60 * 60 * daysRound4) - (60 * 60 * hoursRound4) - (60 * minutesRound4);
							secondsRound4 = Math.round(seconds4);
							//alert (getTime);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound4 + "" + hoursRound4 + "" + minutesRound4 + "" + secondsRound4) > 0) {
							if (hoursRound4 < 10) {
								hoursRound_str4 = "0" + hoursRound4;
							} else {
								hoursRound_str4 = hoursRound4;
							}
							if (minutesRound4 < 10) {
								minutesRound_str4 = "0" + minutesRound4;
							} else {
								minutesRound_str4 = minutesRound4;
							}
							if (secondsRound4 < 10) {
								secondsRound_str4 = "0" + secondsRound4;
							} else {
								secondsRound_str4 = secondsRound4;
							}
							document.getElementById("show_cate_str4").innerHTML = daysRound4 + "일 " + hoursRound_str4 + ":" + minutesRound_str4 + ":" + secondsRound_str4 + " ";
							} else {
							document.getElementById("show_cate_str4").innerHTML = "마감";
							}
							newtime4 = window.setTimeout("getTime4();", 1000);
						}
						</script>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_lp.jpg')}}">
						</div>
						<div class="pay">166억 <span class="money">€10,500,000</span>
						</div>
						<div class="date">추첨 : 2025.06.22 (일) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str4">5일 06:37:53 </span>
							<script>
							getTime4();
							</script>
						</div>
						<div class="num">
							<em class="bg-bl">이월</em> 4,6,8,18,28,42, <span class="t-red">1</span>, <span class="t-gr">10</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_lp.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime6() {
							now6 = new Date();
							k_year6 = Number("2025");
							k_month6 = Number("06") - 1;
							k_day6 = Number("20");
							k_hour6 = Number("17");
							k_min6 = Number("50");
							//alert(k_year);
							dday6 = new Date(k_year6, k_month6, k_day6, k_hour6, k_min6, '59');
							//alert(dday);
							days6 = (dday6 - now6) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound6 = Math.floor(days6);
							hours6 = (dday6 - now6) / 1000 / 60 / 60 - (24 * daysRound6);
							hoursRound6 = Math.floor(hours6);
							minutes6 = (dday6 - now6) / 1000 / 60 - (24 * 60 * daysRound6) - (60 * hoursRound6);
							minutesRound6 = Math.floor(minutes6);
							seconds6 = (dday6 - now6) / 1000 - (24 * 60 * 60 * daysRound6) - (60 * 60 * hoursRound6) - (60 * minutesRound6);
							secondsRound6 = Math.round(seconds6);
							//alert (getTime);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound6 + "" + hoursRound6 + "" + minutesRound6 + "" + secondsRound6) > 0) {
							if (hoursRound6 < 10) {
								hoursRound_str6 = "0" + hoursRound6;
							} else {
								hoursRound_str6 = hoursRound6;
							}
							if (minutesRound6 < 10) {
								minutesRound_str6 = "0" + minutesRound6;
							} else {
								minutesRound_str6 = minutesRound6;
							}
							if (secondsRound6 < 10) {
								secondsRound_str6 = "0" + secondsRound6;
							} else {
								secondsRound_str6 = secondsRound6;
							}
							document.getElementById("show_cate_str6").innerHTML = daysRound6 + "일 " + hoursRound_str6 + ":" + minutesRound_str6 + ":" + secondsRound_str6 + " ";
							} else {
							document.getElementById("show_cate_str6").innerHTML = "마감";
							}
							newtime6 = window.setTimeout("getTime6();", 1000);
						}
						</script>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_eg.jpg')}}">
						</div>
						<div class="pay">81억 <span class="money">€5,100,000</span>
						</div>
						<div class="date">추첨 : 2025.06.23 (월) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str6">5일 06:37:53 </span>
							<script>
							getTime6();
							</script>
						</div>
						<div class="num">
							<em class="bg-red">마감</em> 11,34,46,48,50, <span class="t-red">1</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_eg.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime9() {
							now9 = new Date();
							k_year9 = Number("2025");
							k_month9 = Number("06") - 1;
							k_day9 = Number("17");
							k_hour9 = Number("17");
							k_min9 = Number("50");
							dday9 = new Date(k_year9, k_month9, k_day9, k_hour9, k_min9, '59');
							//alert(dday);
							days9 = (dday9 - now9) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound9 = Math.floor(days9);
							hours9 = (dday9 - now9) / 1000 / 60 / 60 - (24 * daysRound9);
							hoursRound9 = Math.floor(hours9);
							minutes9 = (dday9 - now9) / 1000 / 60 - (24 * 60 * daysRound9) - (60 * hoursRound9);
							minutesRound9 = Math.floor(minutes9);
							seconds9 = (dday9 - now9) / 1000 - (24 * 60 * 60 * daysRound9) - (60 * 60 * hoursRound9) - (60 * minutesRound9);
							secondsRound9 = Math.round(seconds9);
							if (Number(daysRound9 + "" + hoursRound9 + "" + minutesRound9 + "" + secondsRound9) > 0) {
							if (hoursRound9 < 10) {
								hoursRound_str9 = "0" + hoursRound9;
							} else {
								hoursRound_str9 = hoursRound9;
							}
							if (minutesRound9 < 10) {
								minutesRound_str9 = "0" + minutesRound9;
							} else {
								minutesRound_str9 = minutesRound9;
							}
							if (secondsRound9 < 10) {
								secondsRound_str9 = "0" + secondsRound9;
							} else {
								secondsRound_str9 = secondsRound9;
							}
							document.getElementById("show_cate_str9").innerHTML = daysRound9 + "일 " + hoursRound_str9 + ":" + minutesRound_str9 + ":" + secondsRound_str9 + " ";
							} else {
							document.getElementById("show_cate_str9").innerHTML = "마감";
							}
							newtime9 = window.setTimeout("getTime9();", 1000);
						}
						</script>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_ej.jpg')}}">
						</div>
						<div class="pay">620억 <span class="money">€39,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.18 (수) 04:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str9">2일 06:37:53 </span>
							<script>
							getTime9();
							</script>
						</div>
						<div class="num">
							<em class="bg-bl">이월</em> 1,15,18,27,46, <span class="t-red">5,9</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_ej.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime52() {
							now52 = new Date();
							k_year52 = Number("2025");
							k_month52 = Number("06") - 1;
							k_day52 = Number("20");
							k_hour52 = Number("17");
							k_min52 = Number("50");
							dday52 = new Date(k_year52, k_month52, k_day52, k_hour52, k_min52, '59');
							//alert(dday);
							days52 = (dday52 - now52) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound52 = Math.floor(days52);
							hours52 = (dday52 - now52) / 1000 / 60 / 60 - (24 * daysRound52);
							hoursRound52 = Math.floor(hours52);
							minutes52 = (dday52 - now52) / 1000 / 60 - (24 * 60 * daysRound52) - (60 * hoursRound52);
							minutesRound52 = Math.floor(minutes52);
							seconds52 = (dday52 - now52) / 1000 - (24 * 60 * 60 * daysRound52) - (60 * 60 * hoursRound52) - (60 * minutesRound52);
							secondsRound52 = Math.round(seconds52);
							if (Number(daysRound52 + "" + hoursRound52 + "" + minutesRound52 + "" + secondsRound52) > 0) {
							if (hoursRound52 < 10) {
								hoursRound_str52 = "0" + hoursRound52;
							} else {
								hoursRound_str52 = hoursRound52;
							}
							if (minutesRound52 < 10) {
								minutesRound_str52 = "0" + minutesRound52;
							} else {
								minutesRound_str52 = minutesRound52;
							}
							if (secondsRound52 < 10) {
								secondsRound_str52 = "0" + secondsRound52;
							} else {
								secondsRound_str52 = secondsRound52;
							}
							document.getElementById("show_cate_str52").innerHTML = daysRound52 + "일 " + hoursRound_str52 + ":" + minutesRound_str52 + ":" + secondsRound_str52 + " ";
							} else {
							document.getElementById("show_cate_str52").innerHTML = "마감";
							}
							newtime52 = window.setTimeout("getTime52();", 1000);
						}
						</script>
						<!--231204 유로드림스 추가//-->
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_ed.jpg')}}">
						</div>
						<div class="pay">2,800만원/매월</div>
						<div class="date">추첨 : 2025.06.24 (화) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str52">5일 06:37:53 </span>
							<script>
							getTime52();
							</script>
						</div>
						<div class="num">
							<em class="bg-red">마감</em> 2,3,6,8,23,28, <span class="t-red">2</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_ed.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<!--231204 유로드림스 추가//-->
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_group.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc"> 공동구매 <font color="peru"> 유로밀리언 5 QP</font>-10 <font color="red">D</font> (250618) </div>
							<div class="etc"> 공동구매 <font color="peru"> 유로밀리언 5 QP</font>-10 <font color="red">A</font> (250618) </div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=1" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_usa.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc">
							<font color="deeppink">NY PowerBall 15 draws</font>
							<font color="green"> 5 Game </font>
							</div>
							<div class="etc">
							<font color="mediumblue">NY NEW Megamillions 10 draws</font>
							<font color="green"> 5 Game</font>
							</div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=2" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_euro.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc">
							<font color="orange">2멀티 유로잭팟</font> 3 game (선택번호 or QP) (싸인)
							</div>
							<div class="etc">
							<font color="violet">Euromillions 5 Game or QP (싸인)</font>
							</div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=3" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_event.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc"> [6월이벤트-1] FREE공구 <font color="orangered">2025 썸머 엘고르도</font> Verano 특별복권 (브론즈이상) </div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=4" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide" style="width: 245.4px; margin-right: 20px;">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_special.jpg')}}">
						</div>
						<div class="etc-w"></div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=5" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
					</div>
					</div>
					<button class="btn-lotto-prev swiper-button-disabled">
					<img src="{{asset('/images/web/btn_main_swiper_prev.png')}}" alt="이전">
					</button>
					<button class="btn-lotto-next">
					<img src="{{asset('/images/web/btn_main_swiper_next.png')}}" alt="다음">
					</button>
					<div class="pagination-w">
					<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
						<span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
						<span class="swiper-pagination-bullet"></span>
						<span class="swiper-pagination-bullet"></span>
					</div>
					<button type="button" class="btn-view-all btn-view-open">View All</button>
					</div>
				</div>
				<div class="main-lotto-buy-all" style="display:none">
					<div class="swiper-container">
					<div class="swiper-wrapper">
						<script type="text/javascript">
						function getTime_Prod() {
							now = new Date();
							k_year = Number("2025");
							k_month = Number("06") - 1;
							k_day = Number("16");
							k_hour = Number("23");
							k_min = Number("50");
							//alert(k_year);
							dday = new Date(k_year, k_month, k_day, k_hour, k_min, '59');
							//alert(dday);
							days = (dday - now) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound = Math.floor(days);
							hours = (dday - now) / 1000 / 60 / 60 - (24 * daysRound);
							hoursRound = Math.floor(hours);
							minutes = (dday - now) / 1000 / 60 - (24 * 60 * daysRound) - (60 * hoursRound);
							minutesRound = Math.floor(minutes);
							seconds = (dday - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
							secondsRound = Math.round(seconds);
							//alert (getTime_Prod);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound + "" + hoursRound + "" + minutesRound + "" + secondsRound) > 0) {
							if (hoursRound < 10) {
								hoursRound_str = "0" + hoursRound;
							} else {
								hoursRound_str = hoursRound;
							}
							if (minutesRound < 10) {
								minutesRound_str = "0" + minutesRound;
							} else {
								minutesRound_str = minutesRound;
							}
							if (secondsRound < 10) {
								secondsRound_str = "0" + secondsRound;
							} else {
								secondsRound_str = secondsRound;
							}
							document.getElementById("show_cate_str_Prod").innerHTML = daysRound + "일 " + hoursRound_str + ":" + minutesRound_str + ":" + secondsRound_str + " ";
							} else {
							document.getElementById("show_cate_str_Prod").innerHTML = "마감";
							}
							newtime_Prod = window.setTimeout("getTime_Prod();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_pb.jpg')}}">
						</div>
						<div class="pay">1,120억 <span class="money">$80,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.17 (화) 12:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod">1일 12:37:53 </span>
							<script>
							getTime_Prod();
							</script>
						</div>
						<div class="num">
							<!--em class="bg-sky">이월</em-->
							<a href="javascript:sign();">
							<em class="bg-red">마감</em>
							</a> 13,25,29,37,53, <span class="t-red">3</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_pb" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod2() {
							now2 = new Date();
							k_year2 = Number("2025");
							k_month2 = Number("06") - 1;
							k_day2 = Number("17");
							k_hour2 = Number("23");
							k_min2 = Number("50");
							dday2 = new Date(k_year2, k_month2, k_day2, k_hour2, k_min2, '59');
							//alert(dday);
							days2 = (dday2 - now2) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound2 = Math.floor(days2);
							hours2 = (dday2 - now2) / 1000 / 60 / 60 - (24 * daysRound2);
							hoursRound2 = Math.floor(hours2);
							minutes2 = (dday2 - now2) / 1000 / 60 - (24 * 60 * daysRound2) - (60 * hoursRound2);
							minutesRound2 = Math.floor(minutes2);
							seconds2 = (dday2 - now2) / 1000 - (24 * 60 * 60 * daysRound2) - (60 * 60 * hoursRound2) - (60 * minutesRound2);
							secondsRound2 = Math.round(seconds2);
							//alert (getTime_Prod);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound2 + "" + hoursRound2 + "" + minutesRound2 + "" + secondsRound2) > 0) {
							if (hoursRound2 < 10) {
								hoursRound_str2 = "0" + hoursRound2;
							} else {
								hoursRound_str2 = hoursRound2;
							}
							if (minutesRound2 < 10) {
								minutesRound_str2 = "0" + minutesRound2;
							} else {
								minutesRound_str2 = minutesRound2;
							}
							if (secondsRound2 < 10) {
								secondsRound_str2 = "0" + secondsRound2;
							} else {
								secondsRound_str2 = secondsRound2;
							}
							document.getElementById("show_cate_str_Prod2").innerHTML = daysRound2 + "일 " + hoursRound_str2 + ":" + minutesRound_str2 + ":" + secondsRound_str2 + " ";
							} else {
							document.getElementById("show_cate_str_Prod2").innerHTML = "마감";
							}
							newtime_Prod2 = window.setTimeout("getTime_Prod2();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_mm.jpg')}}">
						</div>
						<div class="pay">3,920억 <span class="money">$280,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.18 (수) 12:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod2">2일 12:37:53 </span>
							<script>
							getTime_Prod2();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 8,10,22,40,47, <span class="t-red">1</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_mm.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod3() {
							now3 = new Date();
							k_year3 = Number("2025");
							k_month3 = Number("06") - 1;
							k_day3 = Number("17");
							k_hour3 = Number("23");
							k_min3 = Number("50");
							dday3 = new Date(k_year3, k_month3, k_day3, k_hour3, k_min3, '59');
							//alert(dday);
							days3 = (dday3 - now3) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound3 = Math.floor(days3);
							hours3 = (dday3 - now3) / 1000 / 60 / 60 - (24 * daysRound3);
							hoursRound3 = Math.floor(hours3);
							minutes3 = (dday3 - now3) / 1000 / 60 - (24 * 60 * daysRound3) - (60 * hoursRound3);
							minutesRound3 = Math.floor(minutes3);
							seconds3 = (dday3 - now3) / 1000 - (24 * 60 * 60 * daysRound3) - (60 * 60 * hoursRound3) - (60 * minutesRound3);
							secondsRound3 = Math.round(seconds3);
							if (Number(daysRound3 + "" + hoursRound3 + "" + minutesRound3 + "" + secondsRound3) > 0) {
							if (hoursRound3 < 10) {
								hoursRound_str3 = "0" + hoursRound3;
							} else {
								hoursRound_str3 = hoursRound3;
							}
							if (minutesRound3 < 10) {
								minutesRound_str3 = "0" + minutesRound3;
							} else {
								minutesRound_str3 = minutesRound3;
							}
							if (secondsRound3 < 10) {
								secondsRound_str3 = "0" + secondsRound3;
							} else {
								secondsRound_str3 = secondsRound3;
							}
							document.getElementById("show_cate_str_Prod3").innerHTML = daysRound3 + "일 " + hoursRound_str3 + ":" + minutesRound_str3 + ":" + secondsRound_str3 + " ";
							} else {
							document.getElementById("show_cate_str_Prod3").innerHTML = "마감";
							}
							newtime_Prod3 = window.setTimeout("getTime_Prod3();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_nl.jpg')}}">
						</div>
						<div class="pay">189억 <span class="money">$13,500,000</span>
						</div>
						<div class="date">추첨 : 2025.06.19 (목) 09:15</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod3">2일 12:37:53 </span>
							<script>
							getTime_Prod3();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 2,9,24,27,34,43, <span class="t-red">58 </span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_nl.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod8() {
							now8 = new Date();
							k_year8 = Number("2025");
							k_month8 = Number("06") - 1;
							k_day8 = Number("17");
							k_hour8 = Number("23");
							k_min8 = Number("50");
							dday8 = new Date(k_year8, k_month8, k_day8, k_hour8, k_min8, '59');
							//alert(dday);
							days8 = (dday8 - now8) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound8 = Math.floor(days8);
							hours8 = (dday8 - now8) / 1000 / 60 / 60 - (24 * daysRound8);
							hoursRound8 = Math.floor(hours8);
							minutes8 = (dday8 - now8) / 1000 / 60 - (24 * 60 * daysRound8) - (60 * hoursRound8);
							minutesRound8 = Math.floor(minutes8);
							seconds8 = (dday8 - now8) / 1000 - (24 * 60 * 60 * daysRound8) - (60 * 60 * hoursRound8) - (60 * minutesRound8);
							secondsRound8 = Math.round(seconds8);
							if (Number(daysRound8 + "" + hoursRound8 + "" + minutesRound8 + "" + secondsRound8) > 0) {
							if (hoursRound8 < 10) {
								hoursRound_str8 = "0" + hoursRound8;
							} else {
								hoursRound_str8 = hoursRound8;
							}
							if (minutesRound8 < 10) {
								minutesRound_str8 = "0" + minutesRound8;
							} else {
								minutesRound_str8 = minutesRound8;
							}
							if (secondsRound8 < 10) {
								secondsRound_str8 = "0" + secondsRound8;
							} else {
								secondsRound_str8 = secondsRound8;
							}
							document.getElementById("show_cate_str_Prod8").innerHTML = daysRound8 + "일 " + hoursRound_str8 + ":" + minutesRound_str8 + ":" + secondsRound_str8 + " ";
							} else {
							document.getElementById("show_cate_str_Prod8").innerHTML = "마감";
							}
							newtime_Prod8 = window.setTimeout("getTime_Prod8();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_cfl.jpg')}}">
						</div>
						<div class="pay">1,000불 <span>/ 매일</span>
						</div>
						<div class="date">추첨 : 2025.06.18 (수) 10:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod8">2일 12:37:53 </span>
							<script>
							getTime_Prod8();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 13,34,38,40,55, <span class="t-red">3</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_cfl.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod5() {
							now5 = new Date();
							k_year5 = Number("2025");
							k_month5 = Number("06") - 1;
							k_day5 = Number("20");
							k_hour5 = Number("17");
							k_min5 = Number("50");
							dday5 = new Date(k_year5, k_month5, k_day5, k_hour5, k_min5, '59');
							//alert(dday);
							days5 = (dday5 - now5) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound5 = Math.floor(days5);
							hours5 = (dday5 - now5) / 1000 / 60 / 60 - (24 * daysRound5);
							hoursRound5 = Math.floor(hours5);
							minutes5 = (dday5 - now5) / 1000 / 60 - (24 * 60 * daysRound5) - (60 * hoursRound5);
							minutesRound5 = Math.floor(minutes5);
							seconds5 = (dday5 - now5) / 1000 - (24 * 60 * 60 * daysRound5) - (60 * 60 * hoursRound5) - (60 * minutesRound5);
							secondsRound5 = Math.round(seconds5);
							if (Number(daysRound5 + "" + hoursRound5 + "" + minutesRound5 + "" + secondsRound5) > 0) {
							if (hoursRound5 < 10) {
								hoursRound_str5 = "0" + hoursRound5;
							} else {
								hoursRound_str5 = hoursRound5;
							}
							if (minutesRound5 < 10) {
								minutesRound_str5 = "0" + minutesRound5;
							} else {
								minutesRound_str5 = minutesRound5;
							}
							if (secondsRound5 < 10) {
								secondsRound_str5 = "0" + secondsRound5;
							} else {
								secondsRound_str5 = secondsRound5;
							}
							document.getElementById("show_cate_str_Prod5").innerHTML = daysRound5 + "일 " + hoursRound_str5 + ":" + minutesRound_str5 + ":" + secondsRound_str5 + " ";
							} else {
							document.getElementById("show_cate_str_Prod5").innerHTML = "마감";
							}
							newtime_Prod5 = window.setTimeout("getTime_Prod5();", 1000);
						}
						</script>
						<!--div id="lotto_01_blk"><a href="javascript:alert('서비스준비중입니다.')"></a></div-->
						<!--div class="label_none"></div-->
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_em.jpg')}}">
						</div>
						<div class="pay">3,975억 <span class="money">€250,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.21 (토) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod5">5일 06:37:53 </span>
							<script>
							getTime_Prod5();
							</script>
						</div>
						<div class="num">
							<a href="javascript:sign();">
							<em class="bg-bl">이월</em>
							</a> 2,28,40,43,45, <span class="t-red">3,7</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_em.php" class="btn-comm btn-pk">구매하기</a>
							<a href="/jplay/lotto_em_qp.php" class="btn-comm btn-gb">QP구매</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod4() {
							now4 = new Date();
							k_year4 = Number("2025");
							k_month4 = Number("06") - 1;
							k_day4 = Number("20");
							k_hour4 = Number("17");
							k_min4 = Number("50");
							//alert(k_year);
							dday4 = new Date(k_year4, k_month4, k_day4, k_hour4, k_min4, '59');
							//alert(dday);
							days4 = (dday4 - now4) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound4 = Math.floor(days4);
							hours4 = (dday4 - now4) / 1000 / 60 / 60 - (24 * daysRound4);
							hoursRound4 = Math.floor(hours4);
							minutes4 = (dday4 - now4) / 1000 / 60 - (24 * 60 * daysRound4) - (60 * hoursRound4);
							minutesRound4 = Math.floor(minutes4);
							seconds4 = (dday4 - now4) / 1000 - (24 * 60 * 60 * daysRound4) - (60 * 60 * hoursRound4) - (60 * minutesRound4);
							secondsRound4 = Math.round(seconds4);
							//alert (getTime_Prod);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound4 + "" + hoursRound4 + "" + minutesRound4 + "" + secondsRound4) > 0) {
							if (hoursRound4 < 10) {
								hoursRound_str4 = "0" + hoursRound4;
							} else {
								hoursRound_str4 = hoursRound4;
							}
							if (minutesRound4 < 10) {
								minutesRound_str4 = "0" + minutesRound4;
							} else {
								minutesRound_str4 = minutesRound4;
							}
							if (secondsRound4 < 10) {
								secondsRound_str4 = "0" + secondsRound4;
							} else {
								secondsRound_str4 = secondsRound4;
							}
							document.getElementById("show_cate_str_Prod4").innerHTML = daysRound4 + "일 " + hoursRound_str4 + ":" + minutesRound_str4 + ":" + secondsRound_str4 + " ";
							} else {
							document.getElementById("show_cate_str_Prod4").innerHTML = "마감";
							}
							newtime_Prod4 = window.setTimeout("getTime_Prod4();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_lp.jpg')}}">
						</div>
						<div class="pay">166억 <span class="money">€10,500,000</span>
						</div>
						<div class="date">추첨 : 2025.06.22 (일) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod4">5일 06:37:53 </span>
							<script>
							getTime_Prod4();
							</script>
						</div>
						<div class="num">
							<em class="bg-bl">이월</em> 4,6,8,18,28,42, <span class="t-red">1</span>, <span class="t-gr">10</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_lp.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod6() {
							now6 = new Date();
							k_year6 = Number("2025");
							k_month6 = Number("06") - 1;
							k_day6 = Number("20");
							k_hour6 = Number("17");
							k_min6 = Number("50");
							//alert(k_year);
							dday6 = new Date(k_year6, k_month6, k_day6, k_hour6, k_min6, '59');
							//alert(dday);
							days6 = (dday6 - now6) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound6 = Math.floor(days6);
							hours6 = (dday6 - now6) / 1000 / 60 / 60 - (24 * daysRound6);
							hoursRound6 = Math.floor(hours6);
							minutes6 = (dday6 - now6) / 1000 / 60 - (24 * 60 * daysRound6) - (60 * hoursRound6);
							minutesRound6 = Math.floor(minutes6);
							seconds6 = (dday6 - now6) / 1000 - (24 * 60 * 60 * daysRound6) - (60 * 60 * hoursRound6) - (60 * minutesRound6);
							secondsRound6 = Math.round(seconds6);
							//alert (getTime_Prod);
							//alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
							if (Number(daysRound6 + "" + hoursRound6 + "" + minutesRound6 + "" + secondsRound6) > 0) {
							if (hoursRound6 < 10) {
								hoursRound_str6 = "0" + hoursRound6;
							} else {
								hoursRound_str6 = hoursRound6;
							}
							if (minutesRound6 < 10) {
								minutesRound_str6 = "0" + minutesRound6;
							} else {
								minutesRound_str6 = minutesRound6;
							}
							if (secondsRound6 < 10) {
								secondsRound_str6 = "0" + secondsRound6;
							} else {
								secondsRound_str6 = secondsRound6;
							}
							document.getElementById("show_cate_str_Prod6").innerHTML = daysRound6 + "일 " + hoursRound_str6 + ":" + minutesRound_str6 + ":" + secondsRound_str6 + " ";
							} else {
							document.getElementById("show_cate_str_Prod6").innerHTML = "마감";
							}
							newtime_Prod6 = window.setTimeout("getTime_Prod6();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_eg.jpg')}}">
						</div>
						<div class="pay">81억 <span class="money">€5,100,000</span>
						</div>
						<div class="date">추첨 : 2025.06.23 (월) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod6">5일 06:37:53 </span>
							<script>
							getTime_Prod6();
							</script>
						</div>
						<div class="num">
							<em class="bg-red">마감</em> 11,34,46,48,50, <span class="t-red">1</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_eg.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_Prod9() {
							now9 = new Date();
							k_year9 = Number("2025");
							k_month9 = Number("06") - 1;
							k_day9 = Number("17");
							k_hour9 = Number("17");
							k_min9 = Number("50");
							dday9 = new Date(k_year9, k_month9, k_day9, k_hour9, k_min9, '59');
							//alert(dday);
							days9 = (dday9 - now9) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound9 = Math.floor(days9);
							hours9 = (dday9 - now9) / 1000 / 60 / 60 - (24 * daysRound9);
							hoursRound9 = Math.floor(hours9);
							minutes9 = (dday9 - now9) / 1000 / 60 - (24 * 60 * daysRound9) - (60 * hoursRound9);
							minutesRound9 = Math.floor(minutes9);
							seconds9 = (dday9 - now9) / 1000 - (24 * 60 * 60 * daysRound9) - (60 * 60 * hoursRound9) - (60 * minutesRound9);
							secondsRound9 = Math.round(seconds9);
							if (Number(daysRound9 + "" + hoursRound9 + "" + minutesRound9 + "" + secondsRound9) > 0) {
							if (hoursRound9 < 10) {
								hoursRound_str9 = "0" + hoursRound9;
							} else {
								hoursRound_str9 = hoursRound9;
							}
							if (minutesRound9 < 10) {
								minutesRound_str9 = "0" + minutesRound9;
							} else {
								minutesRound_str9 = minutesRound9;
							}
							if (secondsRound9 < 10) {
								secondsRound_str9 = "0" + secondsRound9;
							} else {
								secondsRound_str9 = secondsRound9;
							}
							document.getElementById("show_cate_str_Prod9").innerHTML = daysRound9 + "일 " + hoursRound_str9 + ":" + minutesRound_str9 + ":" + secondsRound_str9 + " ";
							} else {
							document.getElementById("show_cate_str_Prod9").innerHTML = "마감";
							}
							newtime_Prod9 = window.setTimeout("getTime_Prod9();", 1000);
						}
						</script>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_ej.jpg')}}">
						</div>
						<div class="pay">620억 <span class="money">€39,000,000</span>
						</div>
						<div class="date">추첨 : 2025.06.18 (수) 04:00</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_Prod9">2일 06:37:53 </span>
							<script>
							getTime_Prod9();
							</script>
						</div>
						<div class="num">
							<em class="bg-bl">이월</em> 1,15,18,27,46, <span class="t-red">5,9</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_ej.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<script type="text/javascript">
						function getTime_prod52() {
							now52 = new Date();
							k_year52 = Number("2025");
							k_month52 = Number("06") - 1;
							k_day52 = Number("20");
							k_hour52 = Number("17");
							k_min52 = Number("50");
							dday52 = new Date(k_year52, k_month52, k_day52, k_hour52, k_min52, '59');
							//alert(dday);
							days52 = (dday52 - now52) / 1000 / 60 / 60 / 24;
							//alert (days);
							daysRound52 = Math.floor(days52);
							hours52 = (dday52 - now52) / 1000 / 60 / 60 - (24 * daysRound52);
							hoursRound52 = Math.floor(hours52);
							minutes52 = (dday52 - now52) / 1000 / 60 - (24 * 60 * daysRound52) - (60 * hoursRound52);
							minutesRound52 = Math.floor(minutes52);
							seconds52 = (dday52 - now52) / 1000 - (24 * 60 * 60 * daysRound52) - (60 * 60 * hoursRound52) - (60 * minutesRound52);
							secondsRound52 = Math.round(seconds52);
							if (Number(daysRound52 + "" + hoursRound52 + "" + minutesRound52 + "" + secondsRound52) > 0) {
							if (hoursRound52 < 10) {
								hoursRound_str52 = "0" + hoursRound52;
							} else {
								hoursRound_str52 = hoursRound52;
							}
							if (minutesRound52 < 10) {
								minutesRound_str52 = "0" + minutesRound52;
							} else {
								minutesRound_str52 = minutesRound52;
							}
							if (secondsRound52 < 10) {
								secondsRound_str52 = "0" + secondsRound52;
							} else {
								secondsRound_str52 = secondsRound52;
							}
							document.getElementById("show_cate_str_prod52").innerHTML = daysRound52 + "일 " + hoursRound_str52 + ":" + minutesRound_str52 + ":" + secondsRound_str52 + " ";
							} else {
							document.getElementById("show_cate_str_prod52").innerHTML = "마감";
							}
							newtime_Prod52 = window.setTimeout("getTime_prod52();", 1000);
						}
						</script>
						<!--231204 유로드림스 추가//-->
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_ed.jpg')}}">
						</div>
						<div class="pay">2,800만원/매월</div>
						<div class="date">추첨 : 2025.06.24 (화) 04:30</div>
						<div class="end-date">주문마감 : <span id="show_cate_str_prod52">5일 06:37:53 </span>
							<script>
							getTime_prod52();
							</script>
						</div>
						<div class="num">
							<em class="bg-red">마감</em> 2,3,6,8,23,28, <span class="t-red">2</span>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_ed.php" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<!--231204 유로드림스 추가//-->
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_group.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc"> 공동구매 <font color="peru"> 유로밀리언 5 QP</font>-10 <font color="red">D</font> (250618) </div>
							<div class="etc"> 공동구매 <font color="peru"> 유로밀리언 5 QP</font>-10 <font color="red">A</font> (250618) </div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=1" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_usa.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc">
							<font color="deeppink">NY PowerBall 15 draws</font>
							<font color="green"> 5 Game </font>
							</div>
							<div class="etc">
							<font color="mediumblue">NY NEW Megamillions 10 draws</font>
							<font color="green"> 5 Game</font>
							</div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=2" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_euro.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc">
							<font color="orange">2멀티 유로잭팟</font> 3 game (선택번호 or QP) (싸인)
							</div>
							<div class="etc">
							<font color="violet">Euromillions 5 Game or QP (싸인)</font>
							</div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=3" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_event.jpg')}}">
						</div>
						<div class="etc-w">
							<div class="etc"> [6월이벤트-1] FREE공구 <font color="orangered">2025 썸머 엘고르도</font> Verano 특별복권 (브론즈이상) </div>
						</div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=4" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
						<div class="swiper-slide">
						<div class="logo">
							<img src="{{asset('/images/web/logo2_special.jpg')}}">
						</div>
						<div class="etc-w"></div>
						<div class="btn">
							<a href="/jplay/lotto_etc?part_idx=5" class="btn-comm btn-pk">구매하기</a>
						</div>
						</div>
					</div>
					</div>
					<div class="pagination-w">
					<a href="#lottoBuy">
						<button type="button" class="btn-view-all btn-view-close">Close</button>
					</a>
					</div>
				</div>
				</div>
			</div>
			<div class="main-bbs-w">
				<div class="main-bbs-inner">
				<div class="con">
					<div class="bbs-w">
					<ul>
						<li onclick="javascript:bbsTab('1');" class="selected">당첨소식</li>
						<li onclick="javascript:bbsTab('2');">공지사항</li>
						<li onclick="javascript:bbsTab('3');">복권뉴스</li>
						<li onclick="javascript:bbsTab('4');">도움안내</li>
						<li onclick="javascript:bbsTab('5');">이벤트</li>
					</ul>
					<div class="main-bbs-list">
						<a href="w_customer/win_story.php" class="btn-more"></a>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/win_story_view?bbs_data=aWR4PTcwMjcmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2025년 Contra el Cancer 항암 특별복권 추첨소식</a>
						</span>
						<span class="ico-new">NEW</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/win_story_view?bbs_data=aWR4PTcwMTUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2025년 Dia de la Madre 어머니의날 특별복권 추첨소식 (94663)</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/win_story_view?bbs_data=aWR4PTcwMDQmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2025년 DIA DEL PADRE 아빠의날 특별복권 추첨소식(02769)</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/win_story_view?bbs_data=aWR4PTY5OTYmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2025년 San Valentin 성발렌타인 특별복권 추첨소식 (33858)</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/win_story_view?bbs_data=aWR4PTY5OTAmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2025년 EL NINO 특별복권 추첨소식(78908)</a>
						</span>
						</div>
					</div>
					<div class="main-bbs-list" style="display:none">
						<a href="w_customer/notice.php" class="btn-more"></a>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">[중요] 접속주소변경 및 서버 업데이트작업 안내</a>
						</span>
						<span class="ico-new">NEW</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjYmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">[중요] 금일(6일) 유로밀리언 조기마감</a>
						</span>
						<span class="ico-new">NEW</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjMmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">[연기됨] 2025년 2번째 슈퍼유로밀리언 공표(기한 미정)</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjImc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">일부 통신사&amp;지역 접속지연 안내</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/notice_view?bbs_data=aWR4PTcwMjEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">[중요] 유럽로또 마감임시 변경 &amp; 임시 휴무안내</a>
						</span>
						</div>
					</div>
					<div class="main-bbs-list" style="display:none">
						<a href="w_customer/lotto_news.php" class="btn-more"></a>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/lotto_news_view?bbs_data=aWR4PTY5NDEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">1조8천억원의 당첨자는 공동당첨을 선택하였습니다.</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/lotto_news_view?bbs_data=aWR4PTY5MTAmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">수상한 중국복권! 402억 당첨금을 미리 알고 구매한 듯한 정황 포착</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/lotto_news_view?bbs_data=aWR4PTY4ODgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">갈수록 가관. 막장을 치닫는 한국 복권</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/lotto_news_view?bbs_data=aWR4PTY4Nzkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">스웨덴에는 스피드 카메라 복권이 주목 받고 있습니다.</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/lotto_news_view?bbs_data=aWR4PTY4Nzcmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">전 세계 복권판매 급증..... 서민들의 꿈과 희망을 건다</a>
						</span>
						</div>
					</div>
					<div class="main-bbs-list" style="display:none">
						<a href="w_customer/help.php" class="btn-more"></a>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/help_view?bbs_data=aWR4PTY5MjAmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">한국에서 접속이 않되면 반드시 블로그를 확인하세요</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/help_view?bbs_data=aWR4PTY2NTkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">비밀번호는 6개월마다 변경 해주세요</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/help_view?bbs_data=aWR4PTY2NTEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">방화벽차단으로 접속이 불가합니다.</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/help_view?bbs_data=aWR4PTY2MjEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">존재하지 않은 아이디로 표시되는 경우</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/help_view?bbs_data=aWR4PTY1NDYmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">고객센터로 메일을 보냈는데 답변이 없습니다.</a>
						</span>
						</div>
					</div>
					<div class="main-bbs-list" style="display:none">
						<a href="w_customer/event.php" class="btn-more"></a>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/event_view?bbs_data=aWR4PTcwMjUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[6월이벤트-1] 2025 썸머 엘고르도 Verano 특별복권 (브론즈 이상응모)</a>
						</span>
						<span class="ico-new">NEW</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/event_view?bbs_data=aWR4PTcwMjAmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[상시이벤트-5] 웰컴백 포인트증정 이벤트</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/event_view?bbs_data=aWR4PTcwMTkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[5월이벤트-3] 2025 Contra el Cancer 항암 특별복권 이벤트 (실버등급이상)[종료]</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/event_view?bbs_data=aWR4PTcwMTgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[5월이벤트-2] 파워볼 옵션플레이 수수료 FREE 이벤트[종료]</a>
						</span>
						</div>
						<div class="item">
						<span class="linked">
							<a href="./w_customer/event_view?bbs_data=aWR4PTcwMTcmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[5월이벤트-1] 감사의 달 보너스 충전이벤트[종료]</a>
						</span>
						</div>
					</div>
					</div>
					<div class="faq-w">
					<h3>자주묻는 질문</h3>
					<a href="w_customer/faq.php" class="btn-more"></a>
					<div class="item">
						<span class="ico-comm bg-sky">1등당첨금</span>
						<span class="linked">
						<a href="./w_customer/faq_view?bbs_data=aWR4PTcwMjQmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">텍사스주에서 구매대행금지를 했다는데 이를 통해 당첨금 받을 수 있나요?</a>
						</span>
					</div>
					<div class="item">
						<span class="ico-comm bg-org">주문(결제)</span>
						<span class="linked">
						<a href="./w_customer/faq_view?bbs_data=aWR4PTcwMDImc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">유로밀리언과 유로밀리언QP 마감시간 비교(2025년 3월기준)</a>
						</span>
					</div>
					<div class="item">
						<span class="ico-comm bg-sky">1등당첨금</span>
						<span class="linked">
						<a href="./w_customer/faq_view?bbs_data=aWR4PTY3NjQmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">캐시포라이프 연금은 정말 평생 수령하나요?</a>
						</span>
					</div>
					<div class="item">
						<span class="ico-comm bg-yg">포인트/충전</span>
						<span class="linked">
						<a href="./w_customer/faq_view?bbs_data=aWR4PTI3Mjgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">주문가격을 할인 받고 싶어요</a>
						</span>
					</div>
					<div class="item">
						<span class="ico-comm bg-org">주문(결제)</span>
						<span class="linked">
						<a href="./w_customer/faq_view?bbs_data=aWR4PTEwMjEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">서명이나 이름을 싸인한 티켓을 주문하고 싶습니다.</a>
						</span>
					</div>
				
					</div>
				</div>
				</div>
			</div>
		</div>
		<script>
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