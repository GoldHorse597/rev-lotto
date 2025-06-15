@extends('web.layouts.app')
@section('content')
<section class="container">
		<h1 class="content-tit visual06"><span>회원</span></h1>
        <div class="header">
            <h2>아이디찾기</h2> 
            <div class="navi">
				<a href="/">홈으로</a>
                <span>회원</span> 
				<span>아이디찾기</span> 
            </div>
        </div>
        <div class="contents"> 

			<div class="desc-main">아이디를 잊으셨나요?</div>
			<div class="desc-sub">리버스로또 웹사이트에 오신 것을 환영합니다.<br>회원가입시 입력하신 이름 및 휴대전화번호를 입력하여 주세요.<br>※ 성과 이름을 띄워 등록한경우는 띄워 입력하세요.</div>

			<form method="post" action="/member/id_find" name="id_form">
			<input type="hidden" name="mode" value="search">
				<fieldset class="login-form">
					<div>
						<input type="text" name="name" id="name" placeholder="이름">
						<input type="text" name="phone" id="phone" placeholder="휴대전화 '-' 없이 입력">
					</div> 
					
					<button type="button" class="btn-comm btn-bl" onclick="javascript:find_sendit();">찾기</button>
				</fieldset>
			</form>

			<div class="txt-login mt50">※ 비밀번호/아이디 찾기가 불가능한 분께서는 고객센터로 문의 또는 우측 하단의 '메세지 남기기'에 메세지를 남겨주세요.</div>
        </div>
    </section>
@endsection