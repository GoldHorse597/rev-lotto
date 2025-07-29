@extends('web.layouts.app')
@section('content')
<section class="container">
		<h1 class="content-tit visual06"><span>회원</span></h1>
        <div class="header">
            <h2>아이디찾기</h2> 
            <div class="navi">
				<a href="/index.php">홈으로</a>
                <span>회원</span> 
				<span>아이디찾기</span> 
            </div>
        </div>
        <div class="contents"> 

			<div class="desc-main">비밀번호를 잊으셨나요?</div>
			<div class="desc-sub">리버스로또 웹사이트에 오신 것을 환영합니다.<br>회원가입시 입력하신 아이디, 이름 및 휴대전화번호를 입력하여 주세요.</div>

			<form method="post" action="/member/password_find" name="idpass_form">
				<fieldset class="login-form">
					<div>
						<input type="text" name="email1" id="login_name" placeholder="아이디">
						<input type="text" name="name" id="login_name" placeholder="이름">
					</div> 
					
					<button type="button" class="btn-comm btn-bl" onclick="javascript:pass_sendit();">찾기</button>
				</fieldset>
			</form>

			<div class="txt-login mt50">※ 수신용 이메일로 비밀번호가 전송 됩니다.<br>비밀번호/아이디 찾기가 불가능한 분께서는 고객센터로 문의 또는 우측 하단의 메모를 남겨주세요.</div>

        </div>
    </section>
    <script language="JavaScript">
<!--
function pass_sendit() {
	var form=document.idpass_form;
	
	if(form.name.value=="") {
		alert("회원님의 이름을 입력해 주세요.");
		form.name.focus();
	} else if(form.email1.value=="") {
		alert("회원님의 아이디를 입력해 주세요.");
		form.email1.focus();
	} else {
		form.submit();
	}
}
//-->
</script>
@endsection