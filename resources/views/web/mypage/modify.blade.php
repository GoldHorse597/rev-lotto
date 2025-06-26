@extends('web.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('css/web/sb-admin-2.min.css') }}?v=1.2">
@section('content')
<section class="container">
    <h1 class="content-tit visual02">
        <span>개인정보</span>
    </h1>
    <div class="header">
        <h2>개인정보</h2>
        
    </div>
    <div class="contents">    
        <div class="inner-contents">
            <h3 class="tit-h3 tit-h3-sub mt50 mo-mt0"> 기본정보 <span>
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
                   {{ Auth::user()->identity }}
                </td>
                </tr>
                <tr>
                <th>
                    <em>*</em> 이름
                </th>
                <td>
                    {{ Auth::user()->name }}
                </td>
                </tr>    
                 <tr>
                <th>
                    <em>*</em> 보유금액
                </th>
                <td>
                    {{ Auth::user()->amount }}
                </td>
                </tr>    
                <tr>
                
                <th>
                    <em>*</em> 은행권정보
                </th>                
                <td>
                    {{ Auth::user()->bank_name }} - {{ Auth::user()->bank_num }} - {{ Auth::user()->bank_owner }}
                </td>
                </tr>            
                <tr>
                <th>
                    <em>*</em> 휴대전화
                </th>
                <td class="m-flex m-justify-space">
                   {{ Auth::user()->phone }}
                </td>
                </tr>
                <tr>
                
            </tbody>
            </table>    
        </div>
    </div>
</section>

@endsection