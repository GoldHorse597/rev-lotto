@extends('web.layouts.app')
@section('content')
<section class="container">
  <h1 class="content-tit visual06">
    <span>회원가입</span>
  </h1>
  <div class="header">
    <h2>가입정보 입력</h2>
    <div class="navi">
      <a href="/index.php">홈으로</a>
      <span>회원가입</span>
      <span>가입정보 입력</span>
    </div>
  </div>
  <form action="/member/join" method="post" name="join_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="mailing" id="mailing" value="1">
    <input type="hidden" name="idchk" id="idchk" value="">
    <input type="hidden" name="codechk" id="codechk" value="">
    <div class="contents">
      <div class="inner-contents">
        <h3 class="tit-h3 tit-h3-sub mt50 mo-mt0"> 기본정보 <span>
            <em>*</em> 표시는 필수입력사항 입니다 </span>
        </h3>
        <table cellpadding="0" cellspacing="0" class="table-col">
          <colgroup>
            <col style="width:200px" class="mw80">
            <col style="width:auto">
          </colgroup>
          <tbody>
            <tr>
              <th>
                <em>*</em> 아이디
              </th>
              <td class="m-flex">
                <input type="text" name="userid1" id="userid1" class="w250 mw30p">
                <a href="javascript:idWinOpen(1);" class="btn-comm btn-k mw70 ml5">중복확인</a>
                <div id="id_check_result" class="mw100p"></div>
              </td>
            </tr>
            <tr>
              <th>
                <em>*</em> 이름
              </th>
              <td>
                <input type="text" name="name" class="w250 mw100p">
              </td>
            </tr>    
            <tr>
              <th>
                <em>*</em> 비밀번호
              </th>
              <td>
                <input type="password" name="passwd" id="passwd" class="w250 mw100p">
                <span class="form-sub-desc-r ml10">※ 8~20자리 알파벳+숫자+키보드상단특수문자( ! @ # $ % ^ &amp; * - + _ =)가능, 띄워쓰기 및 기타특수기호금지</span>
              </td>
            </tr>
            <tr>
              <th>
                <em>*</em> 비밀번호 확인
              </th>
              <td>
                <input type="password" name="passwd_check" id="passwd_check" class="w250 mw100p">
              </td>
            </tr>
            <tr>
              <th>
                <em>*</em> 은행권선택
              </th>
              <td>
                <select name="bankName" id="bankName" class="w250 mw100p" style="text-align:center">
                  @foreach ($banks as $bank)
                  <option value="{{ $bank->name }}"> {{ $bank->name }} </option>
                  @endforeach                  
                </select>
              </td>
            </tr>
            <tr>
              <th>
                <em>*</em> 계좌번호
              </th>
              <td>
                <input type="text" name="bank" id="bank" class="w250 mw100p">
               
              </td>
            </tr>
            <tr>
              <th>
                <em>*</em> 예금주
              </th>
              <td>
                <input type="text" name="bankOwner" id="bankOwner" class="w250 mw100p">
              </td>
            </tr>            
            <tr>
              <th>
                <em>*</em> 휴대전화
              </th>
              <td class="m-flex m-justify-space">
                <input type="text" name="phone" id="phone" class="w250 mw100p">             
              </td>
            </tr>
            <tr>
              <th>
                <em>*</em> 추천코드
              </th>
              <td class="m-flex">
                <input type="text" name="code" id="code" class="w250 mw30p">
                <a href="javascript:codeWinOpen(2);" class="btn-comm btn-k mw70 ml5">확인</a>
                <div id="code_check_result" class="mw100p"></div>
              </td>
            </tr>
          </tbody>
        </table>
   
        <div class="mt50 al-center mo-mt20">
          <a type="button" onclick="javascript:sendit();" class="btn-comm btn-bl w100p max-w-5">회 원 가 입</a>
        </div>
      </div>
    </div>
  </form>
</section>

<script language="javascript">
<!--
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// 아이디중복검색	 && 추천인 아이디 검색
function idWinOpen(data) {

	frm = document.join_form;


	userid1_chk = checkSpace(frm.userid1.value);


	if(userid1_chk === true){
		data =  "<span style='color:red;'>아이디 공백을 확인하세요.</span>";
		frm.idchk.value = "";
		$("#id_check_result").html(data);
		return;
	}

	var userid = frm.userid1.value;
	
	if(frm.userid1.value =="") {
        alert("회원 아이디를 입력해 주세요.");
        frm.userid1.focus();
    } 
    else {
        $.ajax({
            type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=euc-kr",
            url: "/member/id_check",
            data: {"id": userid}, 
            dataType: "html",
            cache: false,
            success: function(data, textStatus, jqXHR)
            {
                if(textStatus =="success")
                {
                    if(data == "N")
                    {
                        data =  "<span style='color:red;'>이미 사용하고 있는 아이디 입니다.</span>";
                        frm.idchk.value = "";
                    }	
                    else if(data == "Y")
                    {
                        data =  "<span style='color:blue;'>사용이 가능한 아이디 입니다.</span>";
                        frm.idchk.value = "Y";
                    }                   
                    $("#id_check_result").html(data);						
                }
                else
                {
                    alert(data);
                }
            },
            error: function(data, textStatus, jqXHR)
            {
                alert("실패했습니다. 다시시도해주세요");
            }
        });			
    }
}

function codeWinOpen(data) {

	frm = document.join_form;
	code_chk = checkSpace(frm.code.value);

	if(code_chk === true){
		data =  "<span style='color:red;'>아이디 공백을 확인하세요.</span>";
		frm.codechk.value = "";
		$("#code_check_result").html(data);
		return;
	}

	var code = frm.code.value;
	
	if(frm.code.value =="") {
        alert("추천코드를 입력해 주세요.");
        frm.code.focus();
    } 
    else {
        $.ajax({
            type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=euc-kr",
            url: "/member/code_check",
            
            data: {"code": code}, 
            dataType: "html",
            cache: false,
            success: function(data, textStatus, jqXHR)
            {
                if(textStatus =="success")
                {
                    if(data == "N")
                    {
                        data =  "<span style='color:red;'>추천코드가 정확하지 않습니다.</span>";
                        frm.codechk.value = "";
                    }	
                    else if(data == "Y")
                    {
                        data =  "<span style='color:blue;'>사용이 가능한 추천코드 입니다.</span>";
                        frm.codechk.value = "Y";
                    }                   
                    $("#code_check_result").html(data);						
                }
                else
                {
                    alert(data);
                }
            },
            error: function(data, textStatus, jqXHR)
            {
                alert("실패했습니다. 다시시도해주세요");
            }
        });			
    }
}

function checkSpace(str) {
	if(str.search(/\s/) != -1) {
		return true;
	} else {
		return false;
	}
}

function isValidPass(pw) {
	var check = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,20}$/;
	if (!check.test(pw))     {
		return false;
	}
		
	return true;
}


function sendit() {
	var form=document.join_form;

	var jfm = document.join_form; // 폼 이름이 길어서 변수로 replace함

	Now = new Date();    //현재 연도를 구함
	NowYear = Now.getFullYear(); //나이를 구하는 함수 시작
	
	pass_chk = checkSpace(form.passwd.value);
	

	if(form.idchk.value=="") {
		alert("아이디 중복체크를 해주세요.");
		//form.userid1.focus();
	}
  if(form.codechk.value=="") {
		alert("추천코드를 확인 해주세요.");
		//form.userid1.focus();
	}
	else if(form.userid1.value=="") {
		alert("회원아이디를 입력해 주세요.");
		form.userid1.focus();
	} else if(form.passwd.value=="") {
		alert("패스워드를 입력해 주세요.");
		form.passwd.focus();
	}else if(pass_chk === true){
		alert("패스워드에 공백을 제거해 주세요.");
		form.passwd.focus();
	} else if(form.passwd.value.length < 8 || form.passwd.value.length > 20) {
		alert("패스워드는 8~20자로 입력 주세요.");
		form.passwd.focus();
	} else if(isValidPass(form.passwd.value) == false) {
		alert("패스워드는 8자리 이상 영문+숫자+특수문자 조합으로 해주세요.");
		form.passwd.focus();
	} else if(form.passwd_check.value=="") {
		alert("패스워드확인를 입력해 주세요.");
		form.passwd_check.focus();
	} else if(form.passwd.value != form.passwd_check.value) {
		alert("패스워드가 정확하지 않습니다. 정확히 입력해 주세요.");
		form.passwd_check.focus();
	} else if(form.name.value=="" || form.name.value.trim() =="") {
		alert("회원님의 이름을 입력해 주세요.");
		form.name.focus();
	}
    else if(form.bankOwner.value=="" || form.bankOwner.value.trim() =="") {
		alert("회원님의 예금주를 입력해 주세요.");
		form.bankOwner.focus();
	} else if(form.bank.value=="") {
		alert("회원님의 계좌번호를 입력해 주세요.");
		form.bank.focus();
	}else if(form.phone.value=="") {
		alert("회원님의 이동전화를 입력해 주세요.");
		form.phone.focus();
	} else if(form.code.value=="") {
		alert("추천코드를 입력해 주세요.");
		form.code.focus();
	} else {
		form.submit();
	}
}

$('#bank').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
$('#phone').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
$('#bankOwner').on('input', function() {
    this.value = this.value.replace(/[^ㄱ-ㅎ가-힣a-zA-Z\s]/g, '');
});
//-->
</script>

@endsection