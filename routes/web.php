<?php
use App\Http\Middleware\SiteIsClosed;
use App\Http\Middleware\AuthAlertMiddleware;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Web\HomeController as WebHomeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Web\InfoController;
use App\Http\Controllers\web\MemberController;
use App\Http\Controllers\web\CustomerController;
use App\Http\Controllers\web\MypageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\InquiryTemplateController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\LottoController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Web\PlayController;

Route::middleware([SiteIsClosed::class])->group(function ()
{
    // if (!env('USER'))
    //     return;
   
    Route::get('/', [WebHomeController::class, 'index'])->name('web.index');
//     //로또 안내 
//     Route::get('/info/lotto_pb', [InfoController::class, 'lotto_pb'])->name('web.info.lotto-pb');
//     Route::get('/info/lotto_live', [InfoController::class, 'lotto_live'])->name('web.info.lotto-live');
//     Route::get('/info/lotto_mm', [InfoController::class, 'lotto_mm'])->name('web.info.lotto-mm');
//     Route::get('/info/lotto_kr', [InfoController::class, 'lotto_kr'])->name('web.info.lotto-kr');
//     Route::get('/info/lotto_kr1', [InfoController::class, 'lotto_kr1'])->name('web.info.lotto-kr1');
//     Route::get('/info/lotto_ssq', [InfoController::class, 'lotto_ssq'])->name('web.info.lotto-ssq');
//     Route::get('/info/lotto_dlt', [InfoController::class, 'lotto_dlt'])->name('web.info.lotto-dlt');
//     Route::get('/info/lotto_6', [InfoController::class, 'lotto_6'])->name('web.info.lotto-6');
//     Route::get('/info/lotto_7', [InfoController::class, 'lotto_7'])->name('web.info.lotto-7');
//     Route::get('/info/lotto_mini', [InfoController::class, 'lotto_mini'])->name('web.info.lotto-mini');
    //회원 로그인/가입
    Route::get('/member/login', [MemberController::class, 'login'])->name('login');
    Route::post('/member/login', [MemberController::class, 'postLogin'])->name('web.member.postLogin');
    Route::get('/member/logout', [MemberController::class, 'logout'])->name('web.member.logout');
    Route::get('/member/join', [MemberController::class, 'join'])->name('web.member.join');
    Route::post('/member/join', [MemberController::class, 'register'])->name('web.member.register');
    Route::post('/member/id_check', [MemberController::class, 'idCheck'])->name('web.member.idCheck');
    Route::post('/member/code_check', [MemberController::class, 'codeCheck'])->name('web.member.codeCheck');
//     Route::get('/member/id_find', [MemberController::class, 'id_find'])->name('web.member.id_find');
//     Route::post('/member/id_find', [MemberController::class, 'id_find_post'])->name('web.member.id_find_post');
//     Route::get('/member/password_find', [MemberController::class, 'password_find'])->name('web.member.password_find');
//     Route::post('/member/password_find', [MemberController::class, 'password_find_post'])->name('web.member.password_find_post');
});
Route::middleware([AuthAlertMiddleware::class])->prefix('customer')->group(function() {
    
    Route::get('/notice', [CustomerController::class, 'notice'])->name('customer.notice');
    Route::get('/notice_view', [CustomerController::class, 'noticeView'])->name('customer.notice_view');
    Route::get('/event', [CustomerController::class, 'event'])->name('customer.event');
    Route::get('/event_view', [CustomerController::class, 'eventView'])->name('customer.event_view');
    Route::get('/faq', [CustomerController::class, 'faq'])->name('customer.faq');
    Route::get('/faq_view', [CustomerController::class, 'faqView'])->name('customer.faq_view');
    Route::post('/faq_write', [CustomerController::class, 'faqWrite'])->name('customer.faq_write');
    // 추가적인 customer 관련 라우트들 여기에 작성
    
});
Route::middleware([AuthAlertMiddleware::class])->prefix('mypage')->group(function() {
    
    Route::get('/message', [MypageController::class, 'message'])->name('mypage.message');
    Route::get('/message_view', [MypageController::class, 'messageView'])->name('mypage.message.view');
    Route::post('/message/{id}', [MypageController::class, 'delete'])->name('mypage.message.delete');
    Route::get('/modify', [MypageController::class, 'modify'])->name('mypage.modify');
    Route::get('/buy_list', [MypageController::class, 'buyList'])->name('mypage.buy_list');
    Route::get('/depo_with', [MypageController::class, 'depoWith'])->name('mypage.depo_with');
    Route::get('/withdrawal', [MypageController::class, 'withdrawal'])->name('mypage.withdrawal');
    Route::post('/withdrawal', [MypageController::class, 'postWithdrawal'])->name('mypage.postWithdrawal');
    Route::get('/deposit', [MypageController::class, 'deposit'])->name('mypage.deposit');
    Route::post('/deposit', [MypageController::class, 'postDeposit'])->name('mypage.postDeposit');
    // 추가적인 mypage 관련 라우트들 여기에 작성
    
});

Route::middleware([AuthAlertMiddleware::class])->prefix('play')->group(function() {
    Route::get('/lotto_live', [PlayController::class, 'lotto_live'])->name('play.lotto_live');
    Route::get('/lotto_kr', [PlayController::class, 'lotto_kr'])->name('play.lotto_kr');
    Route::get('/lotto_pb', [PlayController::class, 'lotto_pb'])->name('play.lotto_pb');
    Route::get('/lotto_mm', [PlayController::class, 'lotto_mm'])->name('play.lotto_mm');
    Route::get('/lotto_dlt', [PlayController::class, 'lotto_dlt'])->name('play.lotto_dlt');
    Route::get('/lotto_ssq', [PlayController::class, 'lotto_ssq'])->name('play.lotto_ssq');
    Route::get('/lotto_6', [PlayController::class, 'lotto_6'])->name('play.lotto_6');
    Route::get('/lotto_7', [PlayController::class, 'lotto_7'])->name('play.lotto_7');
    Route::get('/lotto_mini', [PlayController::class, 'lotto_mini'])->name('play.lotto_mini');
    Route::get('/old_number', [PlayController::class, 'old_number'])->name('play.old_number');
    Route::get('/number_list', [PlayController::class, 'number_list'])->name('play.number_list');
    Route::post('/number_list_ok', [PlayController::class, 'number_list_ok'])->name('play.number_list_ok');
});
Route::middleware([AuthAlertMiddleware::class])->prefix('jplay')->group(function() {
    Route::get('/lotto_live', [PlayController::class, 'jlotto_live'])->name('play.jlotto_live');
    Route::get('/lotto_kr', [PlayController::class, 'jlotto_kr'])->name('play.jlotto_kr');
    Route::get('/lotto_pb', [PlayController::class, 'jlotto_pb'])->name('play.jlotto_pb');
    Route::get('/lotto_mm', [PlayController::class, 'jlotto_mm'])->name('play.jlotto_mm');
    Route::get('/lotto_dlt', [PlayController::class, 'jlotto_dlt'])->name('play.jlotto_dlt');
    Route::get('/lotto_ssq', [PlayController::class, 'jlotto_ssq'])->name('play.jlotto_ssq');
    Route::get('/lotto_6', [PlayController::class, 'jlotto_6'])->name('play.jlotto_6');
    Route::get('/lotto_7', [PlayController::class, 'jlotto_7'])->name('play.jlotto_7');
    Route::get('/lotto_mini', [PlayController::class, 'lotto_mini'])->name('play.jlotto_mini');
});

Route::middleware([SiteIsClosed::class])
        ->prefix(config('custom.admin_prefix'))
        ->group(function (){
                // if (!env('ADMIN'))
                //         return;
                Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('admin.login.get');
                Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('admin.login.post');

        });

Route::prefix(config('custom.admin_prefix'))
        ->middleware(['auth:admin', SiteIsClosed::class])
        ->group(function () {
            Route::any('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
            Route::get('/statistics', [DashboardController::class, 'statistics'])->name('admin.statistics');
            Route::post('/statistic/process/{id}', [DashboardController::class, 'process'])->where('id', '[0-9]+')->name('admin.statistic.process');

            Route::post('/tick', [DashboardController::class, 'tick'])->name('admin.tick');
            Route::get('/betting_history', [HistoryController::class, 'betting_history'])->name('admin.betting_history');
            Route::post('/betting_history/process/{id}', [HistoryController::class, 'process'])->where('id', '[0-9]+')->name('admin.history.process');
            Route::match(['get', 'put'], '/betting_history/{id}', [HistoryController::class, 'edit'])->where('id', '[0-9]+')->name('admin.history.edit');

            Route::post('/setting', [DashboardController::class, 'setting'])->name('admin.setting');
            Route::get('/agent/settings', [AgentController::class, 'settings'])->name('admin.agent.settings');
            Route::patch('/agent/change-password', [AgentController::class, 'changepassword'])->name('admin.agent.changepassword');
            Route::get('/agent/banks', [AgentController::class, 'banks'])->name('admin.agent.banks');
            Route::match(['get', 'put'], '/bank/{id}', [AgentController::class, 'bankedit'])->where('id', '[0-9]+')->name('admin.bank.edit');
            Route::post('/bank/process/{id}', [AgentController::class, 'bankprocess'])->where('id', '[0-9]+')->name('admin.bank.process');
            Route::post('/bank/create', [AgentController::class, 'bankcreate'])->name('admin.bank.create');

            Route::get('/agent/codes', [AgentController::class, 'codes'])->name('admin.agent.codes');           
            Route::match(['get', 'put'], '/code/{id}', [AgentController::class, 'codeedit'])->where('id', '[0-9]+')->name('admin.code.edit');
            Route::post('/code/process/{id}', [AgentController::class, 'codeprocess'])->where('id', '[0-9]+')->name('admin.code.process');
            Route::post('/code/create', [AgentController::class, 'codecreate'])->name('admin.code.create');

            Route::get('/users', [AdminUserController::class, 'index'])->name('admin.user.list');
            Route::get('/users/online', [AdminUserController::class, 'onlineusers'])->name('admin.user.onlinelist');
            Route::post('/user/create', [AdminUserController::class, 'create'])->name('admin.user.create');
            Route::match(['get', 'put'], '/user/{id}', [AdminUserController::class, 'edit'])->where('id', '[0-9]+')->name('admin.user.edit');
            Route::post('/user/process/{id}', [AdminUserController::class, 'process'])->where('id', '[0-9]+')->name('admin.user.process');

            Route::get('/lotto/game', [LottoController::class, 'game'])->name('admin.lotto.game');
            Route::get('/lotto/setting', [LottoController::class, 'setting'])->name('admin.lotto.setting');
            Route::post('/lotto/setting', [LottoController::class, 'postSetting'])->name('admin.lotto.postSetting');
            Route::get('/lotto/scrap', [LottoController::class, 'scrap'])->name('admin.lotto.scrap');
            Route::post('/lotto/create', [LottoController::class, 'create'])->name('admin.lotto.create');
            Route::match(['get', 'put'], '/lotto/{id}', [LottoController::class, 'edit'])->where('id', '[0-9]+')->name('admin.lotto.edit');
            Route::post('/lotto/process/{id}', [LottoController::class, 'process'])->where('id', '[0-9]+')->name('admin.lotto.process');

            Route::get('/messages', [MessageController::class, 'index'])->name('admin.message.list');
            Route::post('/message/send', [MessageController::class, 'send'])->name('admin.message.send');
            Route::post('/message/{id}', [MessageController::class, 'read'])->where('id', '[0-9]+')->name('admin.message.read');
            Route::post('/message/readall', [MessageController::class, 'readall'])->name('admin.message.readall');
            Route::delete('/message/{id}/delete', [MessageController::class, 'delete'])->name('admin.message.delete');

            Route::delete('/message/deleteall', [MessageController::class, 'deleteall'])->name('admin.message.deleteall');
            Route::get('/inquiries', [InquiryController::class, 'index'])->name('admin.inquiry.list');
            Route::post('/inquiry/send', [InquiryController::class, 'send'])->name('admin.inquiry.send');
            Route::post('/inquiry/{id}', [InquiryController::class, 'read'])->where('id', '[0-9]+')->name('admin.inquiry.read');
            Route::post('/inquiry/readall', [InquiryController::class, 'readall'])->name('admin.inquiry.readall');
            Route::post('/inquiry/{id}/reply', [InquiryController::class, 'reply'])->name('admin.inquiry.reply');
            Route::delete('/inquiry/{id}/delete', [InquiryController::class, 'delete'])->name('admin.inquiry.delete');
            Route::delete('/inquiry/deleteall', [InquiryController::class, 'deleteall'])->name('admin.inquiry.deleteall');
            
            Route::get('/inquirytemplates', [InquiryTemplateController::class, 'index'])->name('admin.inquirytemplate.list');
            Route::post('/inquirytemplates/create', [InquiryTemplateController::class, 'create'])->name('admin.inquirytemplate.create');
            Route::post('/inquirytemplate/{id}', [InquiryTemplateController::class, 'edit'])->where('id', '[0-9]+')->name('admin.inquirytemplate.edit');
            Route::delete('/inquirytemplate/{id}/delete', [InquiryTemplateController::class, 'delete'])->name('admin.inquirytemplate.delete');

            Route::get('/notices', [NoticeController::class, 'index'])->name('admin.notice.list');
            Route::post('/notice/create', [NoticeController::class, 'create'])->name('admin.notice.create');
            Route::match(['get', 'put'], '/notice/{id}', [NoticeController::class, 'edit'])->where('id', '[0-9]+')->name('admin.notice.edit');
            Route::delete('/notice/{id}/delete', [NoticeController::class, 'delete'])->name('admin.notice.delete');

            Route::get('/events', [EventController::class, 'index'])->name('admin.event.list');
            Route::post('/event/create', [EventController::class, 'create'])->name('admin.event.create');
            Route::match(['get', 'put'], '/event/{id}', [EventController::class, 'edit'])->where('id', '[0-9]+')->name('admin.event.edit');
            Route::delete('/event/{id}/delete', [EventController::class, 'delete'])->name('admin.event.delete');

        });
require __DIR__.'/auth.php';
