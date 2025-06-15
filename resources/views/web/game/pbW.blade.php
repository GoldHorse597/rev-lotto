<html lang="ko">
	@extends('web.layouts.app')

	@section('title', '파워볼 구매하기')

 	@section('content')
		
		
		<div class="quick-prod-top">
			<div class="con">
			<a href="/ver_02/w_play/lotto_em.php" title="유로밀리언즈" class="quick-prod-em">
				<img src="{{ asset('images/web/logo_em.png')}}">
				<span>3,975억</span>
			</a>
			<a href="/ver_02/w_play/lotto_cfl.php" title="캐시4라이프" class="quick-prod-cfl">
				<img src="{{ asset('images/web/logo_cfl.png')}}">
				<span>1,000불/매일</span>
			</a>
			<a href="/ver_02/w_play/lotto_pb.php" title="파워볼" class="quick-prod-pb">
				<img src="{{ asset('images/web/logo_pb.png')}}">
				<span>1,120억</span>
			</a>
			<a href="/ver_02/w_play/lotto_mm.php" title="메가밀리언즈" class="quick-prod-mm">
				<img src="{{ asset('images/web/logo_mm.png')}}">
				<span>3,696억</span>
			</a>
			<a href="/ver_02/w_play/lotto_nl.php" title="뉴욕로또" class="quick-prod-nl">
				<img src="{{ asset('images/web/logo_nl.png')}}">
				<span>184억</span>
			</a>
			<a href="/ver_02/w_play/lotto_lp.php" title="라 프리미티바" class="quick-prod-lp">
				<img src="{{ asset('images/web/logo_lp.png')}}">
				<span>151억</span>
			</a>
			<a href="/ver_02/w_play/lotto_eg.php" title="엘 고르도" class="quick-prod-eg">
				<img src="{{ asset('images/web/logo_eg.png')}}">
				<span>81억</span>
			</a>
			<a href="/ver_02/w_play/lotto_ej.php" title="유로 잭팟" class="quick-prod-ej">
				<img src="{{ asset('images/web/logo_ej.png')}}">
				<span>492억</span>
			</a>
			<!-- 유로밀리언 추가 210112//-->
			<a href="/ver_02/w_play/lotto_ed.php" title="유로드림스" class="quick-prod-ed">
				<img src="{{ asset('images/web/logo_ed.png')}}">
				<span>2만유로/매월</span>
			</a>
			<!-- 유로밀리언 추가 210112//-->
			</div>
		</div>
		<script type="text/javascript">
			// 마이크로소프트 익스플로러인지 확인
			if (navigator.appName.indexOf("Microsoft") > -1) {
			// 익스플로러이면 버전 6인지 확인
			if (navigator.appVersion.indexOf("MSIE 6") > -1) {
				// 익스 플로러이면 버전 7인지 확인   
			} else if (navigator.appVersion.indexOf("MSIE 7") > -1) {}
			NVM = "TRIDENT";
			} else {
			// 익스플로러가 아닐 경우
			NVM = "OTHer";
			}
			var no_max_k_num = 69;
			var no_max_powerball = 26;

			function click_num(num) {
			var no_select = 0;
			var num_id = 'k_num' + num;
			if (document.form1.s_num1.value == "QP") { // QPick 을 선택하면  초기화시긴타.
				document.form1.s_num1.value = '';
				document.form1.s_num2.value = '';
				document.form1.s_num3.value = '';
				document.form1.s_num4.value = '';
				document.form1.s_num5.value = '';
				document.form1.s_num6.value = '';
				document.all["powerballqp"].className = ''; //QPick 있으면 없앤다.
				powerball_view.innerHTML = "";
			}
			document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
			if (document.all[num_id].className == '') { // 번호를 선택하면
				// 번호가 몇개 선택되었는지 확인 한다
				for (i = 1; i <= no_max_k_num; i++) {
				k_num_id = 'k_num' + i;
				if (document.all[k_num_id].className == 'on') {
					no_select = no_select + 1;
				}
				}
				if (no_select < 5) {
				if (document.form1.s_num1.value == '') {
					document.form1.s_num1.value = num;
				} else if (document.form1.s_num2.value == '') {
					document.form1.s_num2.value = num;
				} else if (document.form1.s_num3.value == '') {
					document.form1.s_num3.value = num;
				} else if (document.form1.s_num4.value == '') {
					document.form1.s_num4.value = num;
				} else if (document.form1.s_num5.value == '') {
					document.form1.s_num5.value = num;
				}
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				} else {
				alert('일반번호는 5개까지 선택하실 수 있습니다.');
				}
			} else { // 번호 선택을 헤제하면
				document.all[num_id].className = '';
				for (z = 1; z <= 5; z++) {
				s_num_del = 's_num' + z;
				if (document.all[s_num_del].value == num) {
					document.all[s_num_del].value = '';
				}
				}
			}
			var k_num_list = "";
			for (i = 1; i <= no_max_k_num; i++) {
				num_id = 'k_num' + i;
				if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';
				}
			}
			k_num_list = "" + k_num_list + "";
			k_num_view.innerHTML = k_num_list;
			document.form1.cho_method.value = "1"; //1.수동 2.자동선택, 3 반자동, 그외 없음
			}

			function Powerball_click_num(num) {
			var num_id = 'powerball' + num;
			if (document.form1.s_num1.value == "QP") { // QPick 을 선택하면  초기화시긴타.
				document.form1.s_num1.value = '';
				document.form1.s_num2.value = '';
				document.form1.s_num3.value = '';
				document.form1.s_num4.value = '';
				document.form1.s_num5.value = '';
				document.form1.s_num6.value = '';
				k_num_view.innerHTML = '';
				document.all["k_numqp"].className = '';
			}
			document.all["powerballqp"].className = '';
			if (document.all[num_id].className == '') // 번호를 선택하면
			{
				for (i = 1; i <= no_max_powerball; i++) {
				powerball_id = 'powerball' + i;
				document.all[powerball_id].className = ''
				}
				if (NVM == "TRIDENT") {
				document.all[num_id].className = 'on';
				} else {
				document.all[num_id].className = 'on';
				}
				document.form1.s_num6.value = num;
				powerball_view.innerHTML = "" + num + "";
			} else // 번호 선택을 헤제하면
			{
				document.all[num_id].className = '';
				document.form1.s_num6.value = '';
				document.form1.sel_k_num1 = '';
				powerball_view.innerHTML = "";
			}
			document.form1.cho_method.value = "1"; //1.수동 2.자동선택, 3 반자동, 그외 없음
			}

			function click_clear() {
			document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
			document.all["powerballqp"].className = '';
			for (i = 1; i <= no_max_k_num; i++) {
				num_id = 'k_num' + i;
				document.all[num_id].className = '';
			}
			for (i = 1; i <= no_max_powerball; i++) {
				powerball_id = 'powerball' + i;
				document.all[powerball_id].className = '';
			}
			document.form1.s_num1.value = '';
			document.form1.s_num2.value = '';
			document.form1.s_num3.value = '';
			document.form1.s_num4.value = '';
			document.form1.s_num5.value = '';
			document.form1.s_num6.value = '';
			k_num_view.innerHTML = '';
			powerball_view.innerHTML = '';
			}
			// 자동선택 함수
			function click_random() {
			var k_num = random_powerball(5, no_max_k_num)
			var powerball_num = random_powerball(1, no_max_powerball)
			var k_num_list = "";
			document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
			document.all["powerballqp"].className = '';
			for (i = 1; i <= no_max_k_num; i++) {
				compare_num = i - 1;
				num_id = 'k_num' + i;
				if (compare_num == k_num[0] || compare_num == k_num[1] || compare_num == k_num[2] || compare_num == k_num[3] || compare_num == k_num[4]) // 선택된 볼이면
				{
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';;
				if (compare_num == k_num[0]) {
					document.form1.s_num1.value = k_num[0];
				}
				if (compare_num == k_num[1]) {
					document.form1.s_num2.value = k_num[1];
				}
				if (compare_num == k_num[2]) {
					document.form1.s_num3.value = k_num[2];
				}
				if (compare_num == k_num[3]) {
					document.form1.s_num4.value = k_num[3];
				}
				if (compare_num == k_num[4]) {
					document.form1.s_num5.value = k_num[4];
				}
				} else // 선택되지 않은 볼이면
				{
				document.all[num_id].className = '';
				}
			}
			k_num_view.innerHTML = "" + k_num_list + "";
			for (i = 1; i <= no_max_powerball; i++) {
				compare_num = i - 1;
				powerball_id = 'powerball' + i;
				if (compare_num == powerball_num) {
				if (NVM == "TRIDENT") {
					document.all[powerball_id].className = 'on';
				} else {
					document.all[powerball_id].className = 'on';
				}
				document.form1.s_num6.value = powerball_num;
				powerball_view.innerHTML = " " + i + " ";
				} else {
				document.all[powerball_id].className = '';
				}
			}
			document.form1.cho_method.value = "2"; //2.자동선택, 3 반자동, 그외 없음
			}
			//반자동 함수
			function click_half_random() {
			var no_select = 0;
			var powerball_count = 0;
			// 번호가 몇개 선택되었는지 확인 한다
			var no_min_k_num = 0;
			var r_num_1 = "";
			var r_num_2 = "";
			var r_num_3 = "";
			var r_num_4 = "";
			var r_num_5 = "";
			for (i = 1; i <= no_max_k_num; i++) {
				k_num_id = 'k_num' + i;
				if (document.all[k_num_id].className == 'on' || document.all[k_num_id].className == 'on') {
				no_select = no_select + 1;
				if (no_select == 1) {
					r_num_1 = i;
				}
				if (no_select == 2) {
					r_num_2 = i;
				}
				if (no_select == 3) {
					r_num_3 = i;
				}
				if (no_select == 4) {
					r_num_4 = i;
				}
				if (no_select == 5) {
					r_num_5 = i;
				}
				}
			}
			var no_powerball = 0;
			for (i = 1; i <= no_max_powerball; i++) {
				powerball_id = 'powerball' + i;
				if (document.all[powerball_id].className == 'on' || document.all[powerball_id].className == 'on') {
				no_powerball = i;
				powerball_count++;
				}
			}
			var select_num1 = 5 - no_select; //반자동 선택할 숫자갯수
			var select_num = 6; //무조건 5번
			var k_num = random_powerball_half(6, no_max_k_num);
			var q = 0;
			for (k = no_select + 1; k <= 5; k++) {
				if (k == 1) {
				if (r_num_1 == k_num['' + q]) {
					q++;
				}
				r_num_1 = k_num['' + q];
				}
				if (k == 2) {
				if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q])) {
					q++;
				}
				r_num_2 = k_num['' + q];
				}
				if (k == 3) {
				if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q]) || (r_num_3 == k_num['' + q])) {
					q++;
				}
				r_num_3 = k_num['' + q];
				}
				if (k == 4) {
				if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q]) || (r_num_3 == k_num['' + q]) || (r_num_4 == k_num['' + q])) {
					q++;
				}
				r_num_4 = k_num['' + q];
				}
				if (k == 5) {
				if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q]) || (r_num_3 == k_num['' + q]) || (r_num_4 == k_num['' + q]) || (r_num_5 == k_num['' + q])) {
					q++;
				}
				r_num_5 = k_num['' + q];
				}
				q++;
			}
			if (powerball_count == "1") {
				var powerball_num = no_powerball;
			} else {
				var powerball_num = random_powerball(1, no_max_powerball);
				if (powerball_num == 0) { //값이 0으로 넘어오면 한번더
				powerball_num = random_powerball(1, no_max_powerball);
				}
			}
			var k_num_list = "";
			document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
			document.all["powerballqp"].className = '';
			for (i = 1; i <= no_max_k_num; i++) {
				compare_num = i;
				num_id = "k_num" + i;
				if (compare_num == r_num_1) {
				document.form1.s_num1.value = r_num_1;
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';;
				}
				if (compare_num == r_num_2) {
				document.form1.s_num2.value = r_num_2;
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';;
				}
				if (compare_num == r_num_3) {
				document.form1.s_num3.value = r_num_3;
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';
				}
				if (compare_num == r_num_4) {
				document.form1.s_num4.value = r_num_4;
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';
				}
				if (compare_num == r_num_5) {
				document.form1.s_num5.value = r_num_5;
				if (NVM == "TRIDENT") {
					document.all[num_id].className = 'on';
				} else {
					document.all[num_id].className = 'on';
				}
				k_num_list = k_num_list + ' < span > ' + i + ' < /span>';
				}
			}
			k_num_view.innerHTML = " " + k_num_list + " ";
			for (i = 1; i <= no_max_powerball; i++) {
				compare_num = i;
				powerball_id = 'powerball' + i;
				if (compare_num == powerball_num) {
				if (NVM == "TRIDENT") {
					document.all[powerball_id].className = 'on';
				} else {
					document.all[powerball_id].className = 'on';
				}
				document.form1.s_num6.value = powerball_num;
				powerball_view.innerHTML = " " + i + " ";
				} else {
				document.all[powerball_id].className = '';
				}
			}
			document.form1.cho_method.value = "3"; //1.수동 2.자동선택, 3 반자동, 그외 없음
			}

			function random_powerball(num, max_num) {
			var no_random = new Array(num);
			for (var i = 0, y = 0; i < num; i++) {
				no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
				for (y = 0; y < i; y++) {
				while (no_random[y] == no_random[i]) {
					no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
					y = 0;
				}
				}
			}
			return no_random;
			}

			function random_powerball_half(num, max_num) {
			var no_random = new Array(num);
			for (var i = 0, y = 0; i < num; i++) {
				no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
				for (y = 0; y < i; y++) {
				while (no_random[y] == no_random[i]) {
					no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
					y = 0;
				}
				}
			}
			return no_random;
			}

			function num_save() {
			// 일반
			var no_num = '';
			var num_count = 0;
			form = document.form1;
			if (document.form1.s_num1.value == "QP") { // 일반번호가 QPick 일때
				form.s_num1.value = "QP";
				form.s_num2.value = "QP";
				form.s_num3.value = "QP";
				form.s_num4.value = "QP";
				form.s_num5.value = "QP";
			} else {
				for (i = 1; i <= no_max_k_num; i++) {
				num_id = 'k_num' + i;
				if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
					if (no_num == '') no_num = i;
					else no_num = no_num + '-' + i;
					num_count++;
				}
				}
				if (num_count < 5) {
				alert('일반번호 5개를 선택하세요.');
				return;
				}
				var kkk = no_num.split('-');
				form.s_num1.value = kkk[0];
				form.s_num2.value = kkk[1];
				form.s_num3.value = kkk[2];
				form.s_num4.value = kkk[3];
				form.s_num5.value = kkk[4];
			}
			// 보너스
			var no_powerball = '';
			var powerball_count = 0;
			if (document.form1.s_num6.value == "QP") { // 파워볼이 QPick 일때
				form.s_num6.value = "QP";
			} else {
				for (i = 1; i <= no_max_powerball; i++) {
				powerball_id = 'powerball' + i;
				if (document.all[powerball_id].className == 'on' || document.all[powerball_id].className == 'on') {
					no_powerball = i;
					powerball_count++;
				}
				}
				if (powerball_count < 1) {
				alert('파워볼을 선택하세요.');
				return;
				}
				form.s_num6.value = no_powerball;
			}
			if (document.form1.s_num1.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form1.s_num2.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form1.s_num3.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form1.s_num4.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form1.s_num5.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form1.s_num6.value == "") {
				alert("파워볼을 선택해주세요");
				return;
			} else {
				document.form1.mode.value = "insert";
				//EXIT;
				form.submit();
				click_clear();
			}
			}

			function num_many_save() {
			form = document.form1;
			document.form1.mode.value = "manyinsert";
			form.submit();
			}
			// QPick 관련함수
			function click_num_qp(num) {
			if (num == "QP") {
				for (i = 1; i <= no_max_k_num; i++) { //일반번호 모두삭제
				num_id = 'k_num' + i;
				document.all[num_id].className = '';
				}
				if (NVM == "TRIDENT") {
				document.all["k_numqp"].className = 'on';
				} else {
				document.all["k_numqp"].className = 'on';
				}
				document.form1.s_num1.value = 'QP';
				document.form1.s_num2.value = 'QP';
				document.form1.s_num3.value = 'QP';
				document.form1.s_num4.value = 'QP';
				document.form1.s_num5.value = 'QP';
				k_num_view.innerHTML = " < span > QP < /span>";
				// QP면 모두가 QP 로 선택된다.
				for (i = 1; i <= no_max_powerball; i++) { // 파워볼 번호삭제
				powerball_id = 'powerball' + i;
				document.all[powerball_id].className = '';
				}
				if (NVM == "TRIDENT") {
				document.all["powerballqp"].className = 'on';
				} else {
				document.all["powerballqp"].className = 'on';
				}
				document.form1.s_num6.value = 'QP';
				powerball_view.innerHTML = " < b > QP < /b>";
			}
			}

			function Powerball_click_num_qp(num) {
			if (num == "QP") {
				for (i = 1; i <= no_max_powerball; i++) { // 파워볼 번호삭제
				powerball_id = 'powerball' + i;
				document.all[powerball_id].className = '';
				}
				if (NVM == "TRIDENT") {
				document.all["powerballqp"].className = 'on';
				} else {
				document.all["powerballqp"].className = 'on';
				}
				document.form1.s_num6.value = 'QP';
				powerball_view.innerHTML = " < b > QP < /b>";
				//// QP면 모두가 QP 로 선택된다.
				for (i = 1; i <= no_max_k_num; i++) { //일반번호 모두삭제
				num_id = 'k_num' + i;
				document.all[num_id].className = '';
				}
				if (NVM == "TRIDENT") {
				document.all["k_numqp"].className = 'on';
				} else {
				document.all["k_numqp"].className = 'on';
				}
				document.form1.s_num1.value = 'QP';
				document.form1.s_num2.value = 'QP';
				document.form1.s_num3.value = 'QP';
				document.form1.s_num4.value = 'QP';
				document.form1.s_num5.value = 'QP';
				k_num_view.innerHTML = " < span > QP < /span>";
			}
			}

			function num_many_save_qp() {
			form = document.form1;
			document.form1.mode.value = "manyinsert_qp";
			form.submit();
			}

			function MM_openBrWindow(theURL, winName, features) { //v2.0
			window.open(theURL, winName, features);
			}

			function click_mynumber() {
			// 일반
			var no_num = '';
			var num_count = 0;
			form = document.form2;
			if (document.form2.s_num1.value == "QP") { // 일반번호가 QPick 일때
				form.s_num1.value = "QP";
				form.s_num2.value = "QP";
				form.s_num3.value = "QP";
				form.s_num4.value = "QP";
				form.s_num5.value = "QP";
			} else {
				for (i = 1; i <= no_max_k_num; i++) {
				num_id = 'k_num' + i;
				if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
					if (no_num == '') no_num = i;
					else no_num = no_num + '-' + i;
					num_count++;
				}
				}
				if (num_count < 5) {
				alert('일반번호 5개를 선택하세요.');
				return;
				}
				var kkk = no_num.split('-');
				form.s_num1.value = kkk[0];
				form.s_num2.value = kkk[1];
				form.s_num3.value = kkk[2];
				form.s_num4.value = kkk[3];
				form.s_num5.value = kkk[4];
			}
			// 보너스
			var no_powerball = '';
			var powerball_count = 0;
			if (document.form2.s_num6.value == "QP") { // 파워볼이 QPick 일때
				form.s_num6.value = "QP";
			} else {
				for (i = 1; i <= no_max_powerball; i++) {
				powerball_id = 'powerball' + i;
				if (document.all[powerball_id].className == 'on' || document.all[powerball_id].className == 'on') {
					no_powerball = i;
					powerball_count++;
				}
				}
				if (powerball_count < 1) {
				alert('파워볼을 선택하세요.');
				return;
				}
				form.s_num6.value = no_powerball;
			}
			if (document.form2.s_num1.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form2.s_num2.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form2.s_num3.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form2.s_num4.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form2.s_num5.value == "") {
				alert("일반번호를 선택해주세요");
				return;
			} else if (document.form2.s_num6.value == "") {
				alert("파워볼을 선택해주세요");
				return;
			} else {
				form.submit();
			}
			}
		</script>
		<section class="container">
			<h1 class="content-tit visual01">
			<span>로또구매</span>
			</h1>
			<div class="header">
			<h2>파워볼</h2>
			<div class="btn-w">
				<a href="javascript:void(0);" class="tab-view">파워볼이란? <div class="tab-view-layer">
					<h3>파워볼(Powerball)</h3>
					<div> 파워볼(POWERBALL)은 2010년 1월 31일부터 미국의 대부분의 주에서 판매하는 최대 복권이 되었습니다. 이번 파워볼의 확장은 기존 메가밀리언의 34개 판매주 대부분과 겹치는 상황이 되었습니다. 현재 파워볼 판매에 참여하지 않은 주는 네바다,유타,와이오밍, 알래스카,엘러바마, 미시시피,하와이등 일부 주뿐이며 대부분의 주에서 파워볼을 판매한다고 볼 수 있습니다. 2012년11월 파워볼 최대 잭팟 금액은 $587,500,000 였습니다. </div>
				</div>
				</a>
				<a href="../w_info/lotto_pb.php">이용안내 보기</a>
			</div>
			<div class="navi">
				<a href="/index.php">홈으로</a>
				<span>로또구매</span>
				<span>파워볼</span>
			</div>
			</div>
			<div class="contents">
			<ul class="depth2-menu">
				<li class="item select">
				<a href="../w_play/lotto_pb.php">파워볼</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_mm.php">메가밀리언</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_nl.php">뉴욕로또</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_cfl.php">캐쉬포라이프</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_etc.php">기타&amp;특별복권</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_em.php">유로밀리언</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_em_qp.php">유로밀리언(QP)</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_eg.php">엘 고르도</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_lp.php">라 프리미티바</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_ej.php">유로잭팟(QP)</a>
				</li>
				<li class="item ">
				<a href="../w_mypage/auto_reserv.php">로또 자동예약구매</a>
				</li>
				<li class="item ">
				<a href="../w_play/cart.php">장바구니</a>
				</li>
				<li class="item ">
				<a href="../w_play/number_box.php">번호보관함</a>
				</li>
				<li class="item ">
				<a href="../w_play/lotto_ed.php">유로드림스</a>
				</li>
			</ul>
			<div class="inner-contents">
				<div class="prize-num-w">
				<div class="prize-tit"> 최근추첨번호 <span class="ico-state bg-bl">이월</span>
					<div>2025.06.11 (수) 23:00 (뉴욕시각기준)</div>
				</div>
				<div class="prize-num">
					<span>13</span>
					<span>25</span>
					<span>29</span>
					<span>37</span>
					<span>53</span>
					<span class="bg-pk">3</span>
				</div>
				</div>
				<div class="table-lisw-w table-line-type lotto-buy-head">
				<div class="item th-head">
					<div class="w33p">추첨일</div>
					<div class="pwauto play-prize-th">당첨금</div>
					<div class="w33p">주문마감일</div>
				</div>
				<script type="text/javascript">
					function getTime() {
					now = new Date();
					k_year = Number("2025");
					k_month = Number("06") - 1;
					k_day = Number("14");
					k_hour = Number("23");
					k_min = Number("50");
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
						document.getElementById("show_cate_str").innerHTML = daysRound + "일 " + hoursRound + "시간 " + minutesRound + "분 " + secondsRound + "초";
					} else {
						document.getElementById("show_cate_str").innerHTML = "마감";
					}
					newtime = window.setTimeout("getTime();", 1000);
					}
				</script>
				<div class="tbody">
					<div class="item">
					<div class="w33p f-wrap">
						<div class="w100p t-bl">25.06.15 <br class="mo-view">12:00 (한국시간) </div>
						<div class="w100p t-pk">25.06.14 <br class="mo-view">23:00 (미국시간) </div>
					</div>
					<div class="pwauto f-wrap play-prize-td">
						<div class="w100p t-w">₩ 1,120억원</div>
						<div class="w100p t-pk">US $ 80,000,000</div>
					</div>
					<div class="w33p f-wrap">
						<div class="w100p t-bl">25.06.14 <br class="mo-view">23:50 (한국시간) </div>
						<div class="w100p t-pk">
						<span id="show_cate_str">1일 6시간 4분 50초</span>
						<script>
							getTime();
						</script>
						</div>
					</div>
					</div>
				</div>
				</div>
				<h3 class="tit-lotto-buy">
				<img src="{{ asset('images/web/img_info_pb.jpg')}}" alt="파워볼">
				</h3>
				<form name="form2" method="post" target="ifr1" action="../w_play/mynumber_ok.php">
				<input type="hidden" name="mode" value="num_insert">
				<input type="hidden" name="part_idx" value="34">
				<input type="hidden" name="code" value="1749654162">
				<input type="hidden" name="lottery_closing_date" value="202506142350">
				<input type="hidden" name="s_num1" value="">
				<input type="hidden" name="s_num2" value="">
				<input type="hidden" name="s_num3" value="">
				<input type="hidden" name="s_num4" value="">
				<input type="hidden" name="s_num5" value="">
				<input type="hidden" name="s_num6" value="">
				</form>
				<!--로또번호 선택 시작 -->
				<form name="form1" method="post" target="ifr" action="../w_play/number_list_ok.php">
				<input type="hidden" name="mode" value="insert">
				<input type="hidden" name="part_idx" value="34">
				<input type="hidden" name="cho_method" value="">
				<input type="hidden" name="code" value="1749654162">
				<input type="hidden" name="lottery_closing_date" value="202506142350">
				<input type="hidden" name="s_num1" value="">
				<input type="hidden" name="s_num2" value="">
				<input type="hidden" name="s_num3" value="">
				<input type="hidden" name="s_num4" value="">
				<input type="hidden" name="s_num5" value="">
				<input type="hidden" name="s_num6" value="">
				<div class="lotto-buy-w">
					<div class="number-select-w">
					<h3 class="tit-h3">5개의 번호를 선택하세요.</h3>
					<div class="number-select">
						<button type="button" id="k_num1" onclick="click_num('1')">1</button>
						<button type="button" id="k_num2" onclick="click_num('2')">2</button>
						<button type="button" id="k_num3" onclick="click_num('3')">3</button>
						<button type="button" id="k_num4" onclick="click_num('4')">4</button>
						<button type="button" id="k_num5" onclick="click_num('5')">5</button>
						<button type="button" id="k_num6" onclick="click_num('6')">6</button>
						<button type="button" id="k_num7" onclick="click_num('7')">7</button>
						<button type="button" id="k_num8" onclick="click_num('8')">8</button>
						<button type="button" id="k_num9" onclick="click_num('9')">9</button>
						<button type="button" id="k_num10" onclick="click_num('10')">10</button>
						<button type="button" id="k_num11" onclick="click_num('11')">11</button>
						<button type="button" id="k_num12" onclick="click_num('12')">12</button>
						<button type="button" id="k_num13" onclick="click_num('13')">13</button>
						<button type="button" id="k_num14" onclick="click_num('14')">14</button>
						<button type="button" id="k_num15" onclick="click_num('15')">15</button>
						<button type="button" id="k_num16" onclick="click_num('16')">16</button>
						<button type="button" id="k_num17" onclick="click_num('17')">17</button>
						<button type="button" id="k_num18" onclick="click_num('18')">18</button>
						<button type="button" id="k_num19" onclick="click_num('19')">19</button>
						<button type="button" id="k_num20" onclick="click_num('20')">20</button>
						<button type="button" id="k_num21" onclick="click_num('21')">21</button>
						<button type="button" id="k_num22" onclick="click_num('22')">22</button>
						<button type="button" id="k_num23" onclick="click_num('23')">23</button>
						<button type="button" id="k_num24" onclick="click_num('24')">24</button>
						<button type="button" id="k_num25" onclick="click_num('25')">25</button>
						<button type="button" id="k_num26" onclick="click_num('26')">26</button>
						<button type="button" id="k_num27" onclick="click_num('27')">27</button>
						<button type="button" id="k_num28" onclick="click_num('28')">28</button>
						<button type="button" id="k_num29" onclick="click_num('29')">29</button>
						<button type="button" id="k_num30" onclick="click_num('30')">30</button>
						<button type="button" id="k_num31" onclick="click_num('31')">31</button>
						<button type="button" id="k_num32" onclick="click_num('32')">32</button>
						<button type="button" id="k_num33" onclick="click_num('33')">33</button>
						<button type="button" id="k_num34" onclick="click_num('34')">34</button>
						<button type="button" id="k_num35" onclick="click_num('35')">35</button>
						<button type="button" id="k_num36" onclick="click_num('36')">36</button>
						<button type="button" id="k_num37" onclick="click_num('37')">37</button>
						<button type="button" id="k_num38" onclick="click_num('38')">38</button>
						<button type="button" id="k_num39" onclick="click_num('39')">39</button>
						<button type="button" id="k_num40" onclick="click_num('40')">40</button>
						<button type="button" id="k_num41" onclick="click_num('41')">41</button>
						<button type="button" id="k_num42" onclick="click_num('42')">42</button>
						<button type="button" id="k_num43" onclick="click_num('43')">43</button>
						<button type="button" id="k_num44" onclick="click_num('44')">44</button>
						<button type="button" id="k_num45" onclick="click_num('45')">45</button>
						<button type="button" id="k_num46" onclick="click_num('46')">46</button>
						<button type="button" id="k_num47" onclick="click_num('47')">47</button>
						<button type="button" id="k_num48" onclick="click_num('48')">48</button>
						<button type="button" id="k_num49" onclick="click_num('49')">49</button>
						<button type="button" id="k_num50" onclick="click_num('50')">50</button>
						<button type="button" id="k_num51" onclick="click_num('51')">51</button>
						<button type="button" id="k_num52" onclick="click_num('52')">52</button>
						<button type="button" id="k_num53" onclick="click_num('53')">53</button>
						<button type="button" id="k_num54" onclick="click_num('54')">54</button>
						<button type="button" id="k_num55" onclick="click_num('55')">55</button>
						<button type="button" id="k_num56" onclick="click_num('56')">56</button>
						<button type="button" id="k_num57" onclick="click_num('57')">57</button>
						<button type="button" id="k_num58" onclick="click_num('58')">58</button>
						<button type="button" id="k_num59" onclick="click_num('59')">59</button>
						<button type="button" id="k_num60" onclick="click_num('60')">60</button>
						<button type="button" id="k_num61" onclick="click_num('61')">61</button>
						<button type="button" id="k_num62" onclick="click_num('62')">62</button>
						<button type="button" id="k_num63" onclick="click_num('63')">63</button>
						<button type="button" id="k_num64" onclick="click_num('64')">64</button>
						<button type="button" id="k_num65" onclick="click_num('65')">65</button>
						<button type="button" id="k_num66" onclick="click_num('66')">66</button>
						<button type="button" id="k_num67" onclick="click_num('67')">67</button>
						<button type="button" id="k_num68" onclick="click_num('68')">68</button>
						<button type="button" id="k_num69" onclick="click_num('69')">69</button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" id="k_numqp" onclick="click_num_qp('QP')">QP</button>
					</div>
					<h3 class="tit-h3 mt30">1개의 파워볼을 선택하세요.</h3>
					<div class="number-select num-power">
						<button type="button" id="powerball1" onclick="Powerball_click_num('1')">1</button>
						<button type="button" id="powerball2" onclick="Powerball_click_num('2')">2</button>
						<button type="button" id="powerball3" onclick="Powerball_click_num('3')">3</button>
						<button type="button" id="powerball4" onclick="Powerball_click_num('4')">4</button>
						<button type="button" id="powerball5" onclick="Powerball_click_num('5')">5</button>
						<button type="button" id="powerball6" onclick="Powerball_click_num('6')">6</button>
						<button type="button" id="powerball7" onclick="Powerball_click_num('7')">7</button>
						<button type="button" id="powerball8" onclick="Powerball_click_num('8')">8</button>
						<button type="button" id="powerball9" onclick="Powerball_click_num('9')">9</button>
						<button type="button" id="powerball10" onclick="Powerball_click_num('10')">10</button>
						<button type="button" id="powerball11" onclick="Powerball_click_num('11')">11</button>
						<button type="button" id="powerball12" onclick="Powerball_click_num('12')">12</button>
						<button type="button" id="powerball13" onclick="Powerball_click_num('13')">13</button>
						<button type="button" id="powerball14" onclick="Powerball_click_num('14')">14</button>
						<button type="button" id="powerball15" onclick="Powerball_click_num('15')">15</button>
						<button type="button" id="powerball16" onclick="Powerball_click_num('16')">16</button>
						<button type="button" id="powerball17" onclick="Powerball_click_num('17')">17</button>
						<button type="button" id="powerball18" onclick="Powerball_click_num('18')">18</button>
						<button type="button" id="powerball19" onclick="Powerball_click_num('19')">19</button>
						<button type="button" id="powerball20" onclick="Powerball_click_num('20')">20</button>
						<button type="button" id="powerball21" onclick="Powerball_click_num('21')">21</button>
						<button type="button" id="powerball22" onclick="Powerball_click_num('22')">22</button>
						<button type="button" id="powerball23" onclick="Powerball_click_num('23')">23</button>
						<button type="button" id="powerball24" onclick="Powerball_click_num('24')">24</button>
						<button type="button" id="powerball25" onclick="Powerball_click_num('25')">25</button>
						<button type="button" id="powerball26" onclick="Powerball_click_num('26')">26</button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" class="mo-num-hide"></button>
						<button type="button" id="powerballqp" onclick="Powerball_click_num_qp('QP')">QP</button>
					</div>
					</div>
					<div class="number-selected-w">
					<h3 class="tit-h3 p-l">선택한 번호 <a href="javascript:void(0);" class="bt_basic_play2" onclick="MM_openBrWindow('old_number.php','oldNumber','scrollbars=yes,width=520,height=600');">
						<button type="button" class="btn-prev-num btn-comm-mid">
							<img src="{{asset('/images/web/ico_prev_num.png')}}" alt="icon"> 이전구매한번호 </button>
						</a>
					</h3>
					<div class="message-box-gy">
						<div class="general-num" id="k_num_view">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</div>
						<span id="powerball_view" class="bg-pk"></span>
					</div>
					<div class="btn-number">
						<a href="#none" onclick="click_clear();" class="btn-comm-mid btn-gy">삭제</a>
						<a href="#none" onclick="click_random();" class="btn-comm-mid btn-gy">자동선택</a>
						<a href="#none" onclick="click_half_random();" class="btn-comm-mid btn-gy">반자동선택</a>
						<a href="#none" onclick="click_mynumber();" class="btn-comm-mid btn-gy">번호보관</a>
					</div>
					<div class="btn-cart">
						<a href="#none" onclick="num_save();">
						<img src="{{asset('/images/web/ico_in_cart.png')}}" alt="icon" class="mr5"> 선택된 번호 구매리스트에 담기 </a>
					</div>
					<div class="btn-select">
						<select name="game_su" id="game_su">
						<option value="1">- 1게임</option>
						<option value="2">- 2게임</option>
						<option value="3">- 3게임</option>
						<option value="4">- 4게임</option>
						<option value="5">- 5게임</option>
						<option value="6">- 6게임</option>
						<option value="7">- 7게임</option>
						<option value="8">- 8게임</option>
						<option value="9">- 9게임</option>
						<option value="10">- 10게임</option>
						<option value="20">- 20게임</option>
						<option value="30">- 30게임</option>
						<option value="50">- 50게임</option>
						<option value="70">- 70게임</option>
						<option value="100">- 100게임</option>
						</select>
						<a href="javascript:num_many_save();" class="btn-comm-mid btn-gy" title="일괄자동선택">일괄자동선택</a>
						<a href="javascript:num_many_save_qp();" class="btn-comm-mid btn-gy" title="QP선택">QP선택</a>
					</div>
					</div>
				</div>
				</form>
				<h3 class="tit-h3 mt50">구매선택된 번호</h3>
				<iframe src="./number_list.php?v=2025-06-13 12:45:30&amp;part_idx=34" name="ifr" scrolling="auto" frameborder="0" class="lotto-buy-frame" style="width: 100%; height: 557px;"></iframe>
				<h3 class="tit-h3 mt50">로또 구매관련 안내</h3>
				<div class="message-box-gy ">
				<div class="dot-item">Powerplay옵션은 뉴욕주에서 티켓을 구매할시에 장바구니에서 선택가능하며, 옵션1게임당 1불 및 수수료가 추가됩니다. (* 구매는 뉴욕주.캘리포니아주, 메릴렌드주에서 번갈아 구매되고 있습니다. 캘리포니아주는 옵션플레이가 없습니다)</div>
				<div class="dot-item">번호는 수동번호를 직접 선택하거나 빠른 "자동선택" 또는 "반자동(일부번호 선택 후 나머지번호자동선택)" "일괄자동선택" QP등을 이용할 수 있습니다.</div>
				<div class="dot-item">선택번호는 번호보관함에 저장해두고 필요시마다 꺼내어 같은번호로 다시 주문할 수 있습니다. 선택한번호의 당첨확률은 선택번호 우측 Smart Analysis (%)에서 확인가능합니다.</div>
				<div class="dot-item">선택번호의 당첨등수 히스토리는 당첨번호 페이지 내번호분석페이지에서 가능합니다.</div>
				<div class="dot-item">QP구매는 공식판매소 컴퓨터에서 발행하는 랜덤한 번호를 받는 주문방식입니다. QP번호확인은 티켓이 업로드된 구매완료 후 가능합니다.</div>
				<div class="dot-item">Powerplay옵션은 장바구니에서 선택 가능합니다.</div>
				<div class="dot-item">멀티 &amp; 낙첨복권등 기타상품은 기타특별복권구매하기 미국탭코너를 이용하세요.</div>
				<div class="dot-item">주문시 반드시 상단당첨금박스의 추첨날짜와 시간을 확인하세요, 마감중 주문은 다음회차로 접수가 되며, 정산후 당첨금액이 변동될 수 있습니다.</div>
				<div class="dot-item">같은 로또를 한장바구니에서 결제하지 않고 시간을 달리해 여러건으로 나누어 주문하는 경우는 구매완료 이메일은 1건만 발송될 수 있습니다.</div>
				<div class="dot-item">일정수량게임이상의 할인은 장바구니화면에서 처리됩니다.</div>
				<div class="dot-item">룰과 당첨의 자세한 사항은 로또안내 페이지를 참고하세요.</div>
				</div>
			</div>
			</div>
		</section>
		
		</div>
		<script>
		var fPlaySwiper = new Swiper('.footer-play-inner .swiper-container', {
			loop: true,
			pagination: '.footer-play-inner .swiper-pagination',
			paginationClickable: true,
			nextButton: '.btn-f-next',
			prevButton: '.btn-f-prev',
			slidesPerView: 6,
			spaceBetween: 10,
			autoHeight: true,
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
		$(document).ready(function() {
			$(".btn-f-stop").on("click", function() {
			fPlaySwiper.stopAutoplay();
			$(".btn-f-stop").hide();
			$(".btn-f-play").show();
			});
			$(".btn-f-play").on("click", function() {
			fPlaySwiper.startAutoplay();
			$(".btn-f-stop").show();
			$(".btn-f-play").hide();
			});
		});
		</script>
	@endsection