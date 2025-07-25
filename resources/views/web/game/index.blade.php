<html lang="ko">
	@extends('web.layouts.app')

	@section('title', $title.' 구매하기')

 	@section('content')
		
		<script type="text/javascript">
			
			if (navigator.appName.indexOf("Microsoft") > -1) {
				if (navigator.appVersion.indexOf("MSIE 6") > -1) {
				} else if (navigator.appVersion.indexOf("MSIE 7") > -1) {}
				NVM = "TRIDENT";
			} else {
				NVM = "OTHer";
			}
			var no_max_k_num = {{$num}};
			var no_max_bonus = {{$num1}};

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
					document.all["bonus"].className = ''; //QPick 있으면 없앤다.
					bonus_view.innerHTML = "";
				}
				// document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
				if (document.all[num_id].className == '') { // 번호를 선택하면
					// 번호가 몇개 선택되었는지 확인 한다
					for (i = 1; i <= no_max_k_num; i++) {
						k_num_id = 'k_num' + i;
						if (document.all[k_num_id].className == 'on') {
							no_select = no_select + 1;
						}
					}
					if (no_select < {{ $normal }}) {
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
						let normalCount = {{ $normal }};
						alert('일반번호는 ' + normalCount + '개까지 선택하실 수 있습니다.');
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
					k_num_list = k_num_list + ' <span> ' + i + ' </span>';
					}
				}
				// k_num_list = "" + k_num_list + "";
				k_num_view.innerHTML = k_num_list;
				document.form1.cho_method.value = "1"; //1.수동 2.자동선택, 3 반자동, 그외 없음
			}

			function bonus_click_num(num) {
				var num_id = 'bonus' + num;
				var no_select = 0;

				
				if(document.form1.s_num1.value == "QP"){// QPick 을 선택하면  초기화시긴타.

					document.form1.s_num1.value='';
					document.form1.s_num2.value='';
					document.form1.s_num3.value='';
					document.form1.s_num4.value='';
					document.form1.s_num5.value='';
					document.form1.s_num6.value='';
					k_num_view.innerHTML = '';
					
				}

				if( document.all[num_id].className == '' ) // 번호를 선택하면
				{

					// 번호가 몇개 선택되었는지 확인 한다
					for( i=1 ; i <= no_max_bonus ; i++ ){
							
						k_num_id = 'bonus' + i;
					
						if( document.all[k_num_id].className == 'on' || document.all[k_num_id].className == 'on'){
							no_select = no_select + 1;
						}


					}
			
					if( no_select < {{$bonus}} ){
							if(document.form1.s_num11.value==''){
								document.form1.s_num11.value=num;
							}else if(document.form1.s_num12.value==''){
								document.form1.s_num12.value=num;
							}

							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
					}else{ 
						let bonusCount = {{ $bonus }};
						alert('보너스는 '+bonusCount+'개까지 선택하실 수 있습니다.');
					}   

					


					var k_bonus_num_list = "";
				
					for( i=1 ; i <= no_max_bonus ; i++ )
					{
						bonus_id = 'bonus' + i;
						
						
						if( document.all[bonus_id].className == 'on' || document.all[bonus_id].className == 'on'  )
						{

							k_bonus_num_list =  k_bonus_num_list  + '<span class="bg-pk">' + i + '</span>' ;
						}
					}
					
					k_bonus_num_list = " " + k_bonus_num_list + " ";

					
					bonus_view.innerHTML = "<b>" + k_bonus_num_list + "</b>";
				}
				else // 번호 선택을 헤제하면
				{               
					document.all[num_id].className = '';       
					document.form1.s_num11.value='';
					document.form1.s_num12.value='';
					document.form1.sel_k_num1='';
					bonus_view.innerHTML = "";
				} 
				document.form1.cho_method.value="1";//1.수동 2.자동선택, 3 반자동, 그외 없음
			}

			function click_clear() {
				// document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
				// if(no_max_bonus > 0)
				// 	document.all["bonusqp"].className = '';
				for (i = 1; i <= no_max_k_num; i++) {
					num_id = 'k_num' + i;
					document.all[num_id].className = '';
				}
				for (i = 1; i <= no_max_bonus; i++) {
					bonus_id = 'bonus' + i;
					document.all[bonus_id].className = '';
				}
				document.form1.s_num1.value = '';
				document.form1.s_num2.value = '';
				document.form1.s_num3.value = '';
				document.form1.s_num4.value = '';
				document.form1.s_num5.value = '';
				document.form1.s_num6.value = '';
				k_num_view.innerHTML = '';
				bonus_view.innerHTML = '';
			}
			// 자동선택 함수
			function click_random() {
				var k_num = random_bonus({{$normal}},no_max_k_num)
				var bonus_num = random_bonus({{$bonus}},no_max_bonus)
				var k_num_list = "";
				var k_bonus_num_list = "";

				
				for( i=1 ; i <= no_max_k_num ; i++ )
				{
					compare_num = i - 1;
					num_id = 'k_num' + i;
			
					if( compare_num == k_num[0] || compare_num == k_num[1] || compare_num == k_num[2] || compare_num == k_num[3] || compare_num == k_num[4] || compare_num == k_num[5]|| compare_num == k_num[6] ) // 선택된 볼이면
					{
						if (NVM =="TRIDENT")
						{
							document.all[num_id].className = 'on';
						}
						else
						{
							document.all[num_id].className = 'on';
						}
			
						k_num_list = k_num_list + '<span>' + i + '</span>';
						
						if (compare_num == k_num[0]){
							document.form1.s_num1.value=k_num[0];
						}
						if (compare_num == k_num[1]){
							document.form1.s_num2.value=k_num[1];
						}
						if (compare_num == k_num[2]){
							document.form1.s_num3.value=k_num[2];
						}
						if (compare_num == k_num[3]){
							document.form1.s_num4.value=k_num[3];
						}
						if (compare_num == k_num[4]){
							document.form1.s_num5.value=k_num[4];
						}
						if (compare_num == k_num[5]){
							document.form1.s_num5.value=k_num[5];
						}
						if (compare_num == k_num[6]){
							document.form1.s_num5.value=k_num[6];
						}
					}
					else // 선택되지 않은 볼이면
					{
						document.all[num_id].className = '';
					} 
				}
			
				k_num_view.innerHTML = "<b>" + k_num_list + "</b>";
			
				
				for( i=1 ; i <= no_max_bonus ; i++ )
				{
					compare_num = i - 1;
					bonus_id = 'bonus' + i;
			
					if( compare_num == bonus_num[0] || compare_num == bonus_num[1]  ) 
					{
						if (NVM =="TRIDENT")
						{
							document.all[bonus_id].className = 'on';
						}
						else
						{
							document.all[bonus_id].className = 'on';
						}
						k_bonus_num_list =  k_bonus_num_list + '<span class="bg-pk">' + i + '</span>'  ;

						if (compare_num == bonus_num[0]){
							document.form1.s_num11.value=i;
						}
						if (compare_num == bonus_num[1] && {{$bonus}} == 2){
							document.form1.s_num12.value=i;
						}

						bonus_view.innerHTML = "<b>" + k_bonus_num_list + "</b>";
					}
					else
					{
						document.all[bonus_id].className = '';
					}
				}
				document.form1.cho_method.value="2";//2.자동선택, 3 반자동, 그외 없음
			}

			function random_bonus(num, max_num) {
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

			function random_bonus_half(num, max_num) {
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
					form.s_num6.value = "QP";
					form.s_num7.value = "QP";
				} else {
					for (i = 1; i <= no_max_k_num; i++) {
						num_id = 'k_num' + i;
						if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
							if (no_num == '') no_num = i;
							else no_num = no_num + '-' + i;
							num_count++;
						}
					}
					if (num_count < {{$normal}}) {
						let normalCount = {{ $normal }};
						alert("일반번호 " + normalCount + "를 선택하세요.");
						return;
					}
					var kkk = no_num.split('-');
					form.s_num1.value = kkk[0];
					form.s_num2.value = kkk[1];
					form.s_num3.value = kkk[2];
					form.s_num4.value = kkk[3];
					form.s_num5.value = kkk[4];
					form.s_num6.value = kkk[5];
					form.s_num7.value = kkk[6];
				}
				// 보너스
				var no_bonus = '';
				var bonus_count = 0;
				if (document.form1.s_num8.value == "QP") { // 파워볼이 QPick 일때
					form.s_num8.value = "QP";
				} else {
					if(no_max_bonus >0){
						for (i = 1; i <= no_max_bonus; i++) {
							bonus_id = 'bonus' + i;
							if (document.all[bonus_id].className == 'on' || document.all[bonus_id].className == 'on') {
								no_bonus = i;
								bonus_count++;
							}
						}
						if (bonus_count < 1 && no_max_bonus != 0) {
							alert('보너스를 선택하세요.');
							return;
						}
						form.s_num8.value = no_bonus;
					}
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
					alert("일반번호을 선택해주세요");
					return;
				} 
				 else if (document.form1.s_num7.value == "") {
					alert("일반번호을 선택해주세요");
					return;
				} 
				else if (document.form1.s_num8.value == "" && no_max_bonus != 0) {
					alert("파워볼을 선택해주세요");
					return;
				}
				
				else if({{$reverse}} == 1)
				{
					if(document.form1.amount.value == "" || document.form1.amount == "0" )
					{
						alert('금액을 입력해주세요.');
						return;
					}
					else {
						document.form1.mode.value = "insert";
						//EXIT;
						form.submit();
						click_clear();
					}
				}else {
					document.form1.mode.value = "insert";
					//EXIT;
					form.submit();
					click_clear();
				}
				
				
			}

			function num_many_save() {
				form = document.form1;
				if({{$reverse}} == 1){
					if(document.form1.amount.value == "" || document.form1.amount == "0" )
					{
						alert('금액을 입력해주세요.');
						return;
					}
				}				
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
					// if (NVM == "TRIDENT") {
					// 	document.all["k_numqp"].className = 'on';
					// } else {
					// 	document.all["k_numqp"].className = 'on';
					// }
					document.form1.s_num1.value = 'QP';
					document.form1.s_num2.value = 'QP';
					document.form1.s_num3.value = 'QP';
					document.form1.s_num4.value = 'QP';
					document.form1.s_num5.value = 'QP';
					k_num_view.innerHTML = " <span> QP </span>";
					// QP면 모두가 QP 로 선택된다.
					for (i = 1; i <= no_max_bonus; i++) { // 파워볼 번호삭제
					bonus_id = 'bonus' + i;
					document.all[bonus_id].className = '';
					}
					if (NVM == "TRIDENT") {
					document.all["bonus"].className = 'on';
					} else {
					document.all["bonus"].className = 'on';
					}
					document.form1.s_num6.value = 'QP';
					bonus_view.innerHTML = " <b> QP </b>";
				}
			}

			function Powerball_click_num_qp(num) {
				if (num == "QP") {
					for (i = 1; i <= no_max_bonus; i++) { // 파워볼 번호삭제
					bonus_id = 'bonus' + i;
					document.all[bonus_id].className = '';
					}
					if (NVM == "TRIDENT") {
					document.all["bonus"].className = 'on';
					} else {
					document.all["bonus"].className = 'on';
					}
					document.form1.s_num6.value = 'QP';
					bonus_view.innerHTML = " <b> QP </b>";
					//// QP면 모두가 QP 로 선택된다.
					for (i = 1; i <= no_max_k_num; i++) { //일반번호 모두삭제
					num_id = 'k_num' + i;
					document.all[num_id].className = '';
					}
					// if (NVM == "TRIDENT") {
					// document.all["k_numqp"].className = 'on';
					// } else {
					// document.all["k_numqp"].className = 'on';
					// }
					document.form1.s_num1.value = 'QP';
					document.form1.s_num2.value = 'QP';
					document.form1.s_num3.value = 'QP';
					document.form1.s_num4.value = 'QP';
					document.form1.s_num5.value = 'QP';
					k_num_view.innerHTML = " <span> QP < /span>";
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
				var no_bonus = '';
				var bonus_count = 0;
				if (document.form2.s_num6.value == "QP") { // 파워볼이 QPick 일때
					form.s_num6.value = "QP";
				} else {
					for (i = 1; i <= no_max_bonus; i++) {
					bonus_id = 'bonus' + i;
					if (document.all[bonus_id].className == 'on' || document.all[bonus_id].className == 'on') {
						no_bonus = i;
						bonus_count++;
					}
					}
					if (bonus_count < 1) {
					alert('파워볼을 선택하세요.');
					return;
					}
					form.s_num6.value = no_bonus;
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
				//반자동 함수
			function click_half_random() {

				var no_select = 0;
				var bonus_count = 0;
				// 번호가 몇개 선택되었는지 확인 한다
				var no_min_k_num =0;
				var r_num_1 ="";
				var r_num_2 ="";
				var r_num_3 ="";
				var r_num_4 ="";
				var r_num_5 ="";
				var r_num_6 ="";
				var r_num_7="";

				
				for( i=1 ; i <= no_max_k_num ; i++ ){
					k_num_id = 'k_num' + i;
				
					if( document.all[k_num_id].className == 'on' || document.all[k_num_id].className == 'on'){
						no_select = no_select + 1;

						if (no_select == 1)
						{
							r_num_1 = i;
						}
						if (no_select == 2)
						{
							r_num_2 = i;		
						}
						if (no_select == 3)
						{
							r_num_3 = i;
						}
						if (no_select == 4)
						{
							r_num_4 = i;
						}
						if (no_select == 5)
						{
							r_num_5 = i;
						}
						if (no_select == 6)
						{
							r_num_6 = i;
						}
						if (no_select == 57)
						{
							r_num_7 = i;
						}
					}
				}
				
				var no_bonus_select = 0;
				var p_num_1 ="";
				var p_num_2 ="";
				var no_bonus = 0;
				for( i=1 ; i <= no_max_bonus ; i++ )
				{
					bonus_id = 'bonus' + i;
				
					if( document.all[bonus_id].className == 'on'  || document.all[bonus_id].className == 'on' )
					{
						no_bonus_select = no_bonus_select + 1;
						if (no_bonus_select == 1)
						{
							p_num_1 = i;
						}
						if (no_select == 2)
						{
							p_num_2 = i;		
						}
					}
				}
				var select_num1 = {{$normal}} - no_select ; //반자동 선택할 숫자갯수
				var select_num = {{$normal}} + 1 ; //무조건 5번
				
				var k_num = random_bonus_half(6, no_max_k_num);
				var q = 0;
				
				for (k= no_select+1; k <= {{$normal}}; k++)
				{					
					if (k == 1)
					{
						if(r_num_1 == k_num[''+q]){
							q++;
						}
						r_num_1 = k_num[''+q];
					}
					if (k == 2)
					{
						if((r_num_1 == k_num[''+q]) || (r_num_2 == k_num[''+q])){
							q++;
						}
						r_num_2 = k_num[''+q];
					}
					if (k == 3)
					{
						if((r_num_1 == k_num[''+q]) || (r_num_2 == k_num[''+q]) || (r_num_3 == k_num[''+q])){
							q++;
						}
						r_num_3 = k_num[''+q];
					}
					if (k == 4)
					{
						if((r_num_1 == k_num[''+q]) || (r_num_2 == k_num[''+q]) || (r_num_3 == k_num[''+q]) || (r_num_4 == k_num[''+q])){
							q++;
						}
						r_num_4 = k_num[''+q];
					}
					if (k == 5)
					{
						if((r_num_1 == k_num[''+q]) || (r_num_2 == k_num[''+q]) || (r_num_3 == k_num[''+q]) || (r_num_4 == k_num[''+q]) || (r_num_5 == k_num[''+q])){
							q++;
						}
						r_num_5 = k_num[''+q];
					}
					if (k == 6)
					{
						if((r_num_1 == k_num[''+q]) || (r_num_2 == k_num[''+q]) || (r_num_3 == k_num[''+q]) || (r_num_4 == k_num[''+q]) || (r_num_5 == k_num[''+q])|| (r_num_6 == k_num[''+q])){
							q++;
						}
						r_num_6 = k_num[''+q];
					}
					if (k == 7)
					{
						if((r_num_1 == k_num[''+q]) || (r_num_2 == k_num[''+q]) || (r_num_3 == k_num[''+q]) || (r_num_4 == k_num[''+q]) || (r_num_5 == k_num[''+q])|| (r_num_6 == k_num[''+q])|| (r_num_7 == k_num[''+q])){
							q++;
						}
						r_num_7= k_num[''+q];
					}
					
					q++;
				}
				// 테스트				
				var k_num_list = "";
				
				for( i=1 ; i <= no_max_k_num ; i++ )
				{
					compare_num = i ;
					num_id = "k_num" + i;		
					
						if (compare_num == r_num_1){
							document.form1.s_num1.value=r_num_1;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";
							
						}
						if (compare_num == r_num_2){
							document.form1.s_num2.value=r_num_2;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";
							
						}
						if (compare_num == r_num_3){
							document.form1.s_num3.value=r_num_3;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";
							
						}
						if (compare_num == r_num_4){
							document.form1.s_num4.value=r_num_4;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";
							
						}
						if (compare_num == r_num_5){
							document.form1.s_num5.value=r_num_5;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";							
						}
						if (compare_num == r_num_6){
							document.form1.s_num6.value=r_num_6;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";							
						}
						if (compare_num == r_num_7){
							document.form1.s_num7.value=r_num_7;
							if (NVM =="TRIDENT")
							{
								document.all[num_id].className = 'on';
							}
							else
							{
								document.all[num_id].className = 'on';
							}
							k_num_list = k_num_list + "<span>" + i + "</span>";							
						}
					
				}
				
				k_num_view.innerHTML = "<b>" + k_num_list + "</b>";

				var select_num1 = 2 - no_bonus_select ; //반자동 선택할 숫자갯수
				var select_num = 3 ; //무조건 5번
				
				var k_p_num = random_bonus_half(3, no_max_bonus);
				var q = 0;

				for (k= no_bonus_select+1; k <= {{$bonus}}; k++)
				{					
					if (k == 1)
					{
						if(p_num_1 == k_p_num[''+q]){
							q++;
						}
						p_num_1 = k_p_num[''+q];
					}
					if (k == 2)
					{
						if((p_num_1 == k_p_num[''+q]) || (p_num_2 == k_p_num[''+q])){
							q++;
						}
						p_num_2 = k_p_num[''+q];
					}
					q++;
				}

				var k_bonus_num_list ="";

				for( i=1 ; i <= no_max_bonus ; i++ )
				{
					compare_num = i ;
					num_id = "bonus" + i;
					
					if (compare_num == p_num_1){
						document.form1.s_num11.value=p_num_1;
						if (NVM =="TRIDENT")
						{
							document.all[num_id].className = 'on';
						}
						else
						{
							document.all[num_id].className = 'on';
						}
						
						k_bonus_num_list =  '<span class="bg-pk">' + i + '</span>' + k_bonus_num_list ;
						
					}
					if (compare_num == p_num_2){
						document.form1.s_num12.value=p_num_2;
						if (NVM =="TRIDENT")
						{
							document.all[num_id].className = 'on';
						}
						else
						{
							document.all[num_id].className = 'on';
						}
						
						k_bonus_num_list =  k_bonus_num_list + '<span class="bg-pk">' + i + '</span>' ;
						//alert (r_num_2+"==r_num_2");
					}

					//alert (k_bonus_num_list);					
				}
				bonus_view.innerHTML = "<b>" + k_bonus_num_list + "</b>";

				document.form1.cho_method.value="3";//1.수동 2.자동선택, 3 반자동, 그외 없음
			}
		</script>
		<section class="container">
			<h1 class="content-tit visual01">
			<span>로또구매</span>
			</h1>
			<div class="header">
			<h2>{{$title}}</h2>
			
			
			</div>
			<div class="contents">
			
			<div class="inner-contents">
				<div class="prize-num-w">
					<div class="prize-tit"> 최근추첨번호 <span class="ico-state bg-bl">이월</span>
					@php		
						$dt = \Carbon\Carbon::parse($game->weekday);
						$weekdays = ['일', '월', '화', '수', '목', '금', '토'];
					@endphp
						<div>{{ $dt->format('Y.m.d') }} ({{ $weekdays[$dt->dayOfWeek] }}) {{ $dt->format('H:i') }}</div>
					</div>
					<div class="prize-num">
						@foreach(explode(',', $game->lastresult) as $num2)
							<span>{{ $num2 }}</span>
						@endforeach

						@foreach(explode(',', $game->bonus) as $bonus1)
							<span class="bg-pk">{{ $bonus1 }}</span>
						@endforeach
					</div>
				</div>
				
				<h3 class="tit-lotto-buy">
				<img src="{{ asset('images/web/logo/logo2_'.$game->abbr.'.png')}}" alt="{{$title}}">
				</h3>
				<form name="form2" method="post" target="ifr1" action="/play/mynumber_ok">
					@csrf
					<input type="hidden" name="mode" value="num_insert">
					<input type="hidden" name="part_idx" value="{{$game->id}}">
					<input type="hidden" name="code" value="">
					<input type="hidden" name="reverse" value="{{$reverse}}">
					<input type="hidden" name="lottery_closing_date" value="{{ $dt->format('YmdHi') }}">
					<input type="hidden" name="s_num1" value="">
					<input type="hidden" name="s_num2" value="">
					<input type="hidden" name="s_num3" value="">
					<input type="hidden" name="s_num4" value="">
					<input type="hidden" name="s_num5" value="">
					<input type="hidden" name="s_num6" value="">
					<input type="hidden" name="s_num7" value="">
					<input type="hidden" name="s_num8" value="">
				</form>
				<!--로또번호 선택 시작 -->
				<form name="form1" method="post" target="ifr" action="/play/number_list_ok">
					@csrf
					<input type="hidden" name="mode" value="insert">
					<input type="hidden" name="part_idx" value="{{$game->id}}">
					<input type="hidden" name="cho_method" value="">
					<input type="hidden" name="code" value="">
					<input type="hidden" name="reverse" value="{{$reverse}}">
					<input type="hidden" name="lottery_closing_date" value="{{ $dt->format('YmdHi') }}">
					@for ($i = 1; $i <= 15; $i++)
						<input type="hidden" name="s_num{{$i}}" value="">
					@endfor
					
					<div class="lotto-buy-w">
						<div class="number-select-w">
							<h3 class="tit-h3">{{$normal}}개의 번호를 선택하세요.</h3>
							<div class="number-select">
								@php
									$maxButton = floor(($num + 14) / 15) * 15 - 1;
								@endphp

								@for ($i = 1; $i <= $num; $i++)
									<button type="button" id="k_num{{ $i }}" onclick="click_num('{{ $i }}')">{{ $i }}</button>
								@endfor

								<!-- @for ($i = $num + 1; $i <= $maxButton; $i++)
									<button type="button" class="mo-num-hide"></button>
								@endfor

								<button type="button" id="k_numqp" onclick="click_num_qp('QP')">QP</button> -->
							</div>
							@if($bonus > 0)
							<h3 class="tit-h3 mt30">{{$bonus}}개의 번호를 선택하세요.</h3>
							<div class="number-select num-power">
								@php
									$maxBonus = floor(($num1 + 14) / 15) * 15 - 1;
								@endphp

								@for ($i = 1; $i <= $num1; $i++)
									<button type="button" id="bonus{{ $i }}" onclick="bonus_click_num('{{ $i }}')">{{ $i }}</button>
								@endfor

								<!-- @for ($i = $num1 + 1; $i <= $maxBonus; $i++)
									<button type="button" class="mo-num-hide"></button>
								@endfor
								<button type="button" id="bonusqp" onclick="bonus_click_num_qp('QP')">QP</button> -->
							</div>
							@endif
						</div>
						<div class="number-selected-w">
						<h3 class="tit-h3 p-l">선택한 번호 <a href="javascript:void(0);" class="bt_basic_play2" onclick="MM_openBrWindow('old_number?id={{$game->id}}&reverse={{$reverse}}','oldNumber','scrollbars=yes,width=520,height=600');">
							<button type="button" class="btn-prev-num btn-comm-mid">
								<img src="{{asset('/images/web/ico_prev_num.png')}}" alt="icon"> 이전구매한번호 </button>
							</a>
						</h3>
						<div class="message-box-gy">
							<div class="general-num" id="k_num_view">
								@for ($i = 1; $i <= $normal; $i++)
								<span></span>
								@endfor
							</div>
							<div class="general-num" id="bonus_view">
								@for ($i = 1; $i <= $bonus; $i++)
								<span class="bg-pk"></span>
								@endfor
							
							</div>							
						</div>
						@if($reverse == 1)
						<div>
							<h3 class="tit-h3 p-l" style="display:inline-block;margin-right:9px">금액</h3>
							<input type="text" name="amount" id="amount" value="" class="w300 ">
						</div>
						@endif
						<div class="btn-number">
							
							<a href="#none" onclick="click_clear();" class="btn-comm-mid btn-gy">삭제</a>
							<a href="#none" onclick="click_random();" class="btn-comm-mid btn-gy">자동선택</a>
							<!-- <a href="#none" onclick="click_half_random();" class="btn-comm-mid btn-gy">반자동선택</a> -->
							<!-- <a href="#none" onclick="click_mynumber();" class="btn-comm-mid btn-gy">번호보관</a> -->
						</div>
						<div class="btn-cart">
							<a href="#none" onclick="num_save();">
							<img src="{{asset('/images/web/ico_in_cart.png')}}" alt="icon" class="mr5"> 선택된 번호 구매리스트에 담기 </a>
						</div>
						@if($reverse == 0)
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
							<!-- <a href="javascript:num_many_save_qp();" class="btn-comm-mid btn-gy" title="QP선택">QP선택</a> -->
						</div>
						@endif
						</div>
					</div>
				</form>
				<h3 class="tit-h3 mt50">구매선택된 번호</h3>
				<iframe src="/play/number_list?id={{$game->id}}&reverse={{$reverse}}" name="ifr" scrolling="auto" frameborder="0" class="lotto-buy-frame" style="width: 100%; height: 557px;"></iframe>
				@if($game->id == 1)
				<iframe id="gameifr" src="http://223.130.88.50/admin/live" allowfullscreen style="width: 100%;height: 800px;pointer-events: none;"></iframe>
				<!-- <iframe src="/admin/live" style="width: 100%;height: 800px;"></iframe> -->
				@endif
				<h3 class="tit-h3 mt50">로또 구매관련 안내</h3>
				
				<div class="message-box-gy ">
				
					<div class="dot-item">실시간로또 게임당 1,100원 매일 1회 (19:30 이후)</div>
					<div class="dot-item">한국(6/45) 게임당 1,100원 매주 토 (20:35 이후)</div>
					<!-- <div class="dot-item">중국(쌍색구) 게임당 1,100원 매주 화/목/일 (21:30 이후)</div>
					<div class="dot-item">중국(따루토) 게임당 1,100원 매주 월/수/토 (22:00 이후)</div> -->
					<div class="dot-item">미국(파워볼) 게임당 3,300원 매주 화/목/일 (13:00 이후)</div>
					<div class="dot-item">미국(메가밀리언) 게임당 3,300원 매주 수/토 (13:00 이후)</div>
					<div class="dot-item">일본(로또6) 게임당 3,300원 매주 월/목 (19:00 이후)</div>
					<div class="dot-item">일본(로또7) 게임당 3,300원 매주 금 (19:00 이후)</div>
					<div class="dot-item">일본(로또미니) 게임당 3,300원 매주 화 (19:00 이후)</div></br>
					<div class="dot-item">당첨결과는 현지 추첨완료 시간으로부터 +2시간 까지 소요될 수 있습니다.</div></br>
					@if($reverse == 0)
					<div class="dot-item">- 당첨금안내</div>
					<div class="dot-item">실시간로또 고정 당첨금액 </div>
					<div class="dot-item">1등 30억 (1등당첨차 n/1)</div>
					<div class="dot-item">2등 10억 (2등당첨자 n/1)</div>
					<div class="dot-item">3등 200만원 </div>
					<div class="dot-item">4등 5만원</div>
					<div class="dot-item">5등 5천원</div></br>

					<div class="dot-item">그 외 로또 - 정식게임 해당회차 당첨금 반영</div>
					@elseif($reverse == 1)
					<div class="dot-item">- 당첨금안내</div>
					<div class="dot-item">1등 원금 100% 손실 </div>
					<div class="dot-item">2등 원금 30% 손실</div>
					<div class="dot-item">3등 배당금 0.3% </div>
					<div class="dot-item">4등 배당금 0.5% </div>
					<div class="dot-item">5등 배당금 0.7% </div>
					<div class="dot-item">그외 배당금 1.0%</div>
					@endif
				</div>
				
				
			</div>
			</div>
		</section>
		
		</div>
	<script>
		$('#amount').on('input', function() {
			let value = $(this).val();
			value = value.replace(/[^0-9]/g, ''); // 숫자만 남기기
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // 천단위 , 찍기
			$(this).val(value);
		});
	</script>	

	@endsection