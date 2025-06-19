@extends('web.layouts.app')

@section('content')
	
    <section class="container">
		<h1 class="content-tit visual06"><span>회원</span></h1>
        <div class="header">
            <h2>로그인</h2> 
            <div class="navi">
				<a href="/index.php">홈으로</a>
				<span>회원</span> 
                <span>로그인</span> 
            </div>
        </div>
        <div class="contents"> 

			<div class="desc-main">리버스로또 웹사이트에 오신 것을 환영합니다.</div>
			<div class="desc-sub">로그인 하시면 다양한 서비스를 이용하실 수 있습니다.</div>
			
			<form name="login_form" method="post" action="/member/login" onsubmit="loginInputSendit();event.returnValue = false;">
				@csrf
                <input type="hidden" name="login" value="1">
				<fieldset class="login-form">
					<div>
						<input type="text" name="identity" id="identity" placeholder="아이디">
						<input type="password" name="password" id="password" placeholder="비밀번호" autocomplete="off">
					</div>
								
					<button type="button" class="btn-comm btn-r mb10" onclick="javascript:loginSend();">로그인</button>
					<a href="/member/join"><button type="button" class="btn-comm btn-bl">회원가입</button></a>
				</fieldset>
			</form>
			@if ($errors->any())
			<div class="alert alert-danger" style="text-align:center; margin-top:5px; color:red">
				<ul class="m-0 d-inline-block">
					@foreach ($errors->all() as $error)
					<li>※ {{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="txt-login mt50">※ 아이디/비밀번호 분실 시 파트너를 통해 문의 바랍니다. </div>
        </div>
    </section>
	<script language="javascript">
<!--
	// 메인 로그인
	function loginSend() {
		var form=document.login_form;
		if(form.identity.value=="") {
			alert("아이디를 입력해 주십시오.");
			form.identity.focus();
		} else if(form.password.value=="") {
			alert("패스워드를 입력해 주십시오.");
			form.password.focus();
		} else if(form.password.value.length < 4 || form.password.value.length > 21) {
			alert("패스워드는 4~20자로 입력 주세요.");
			form.password.focus();
		} else {
			form.submit();
		}
	}

	function loginInputSendit() {
		if(event.keyCode==13) { 
			loginSend();
		}
	}

	function disable_text()
	{
		frm = document.login_form;
		if (frm.kkk.value =="")
		{
			frm.identity.value = "";
			frm.kkk.value = "1";
		}
	}
//-->
</script>
@endsection