<?php
use App\Http\Middleware\SiteIsClosed;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Web\HomeController as WebHomeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Web\InfoController;
use App\Http\Controllers\web\MemberController;

if (!config('custom.user_enabled')) return;
Route::prefix(config('custom.admin_prefix'));

Route::middleware([SiteIsClosed::class])->group(function ()
{
    if (!env('USER'))
        return;
   
    Route::get('/', [WebHomeController::class, 'index'])->name('web.index');
    //로또 안내 
    Route::get('/info/lotto_pb', [InfoController::class, 'lotto_pb'])->name('web.info.lotto-pb');
    Route::get('/info/lotto_live', [InfoController::class, 'lotto_live'])->name('web.info.lotto-live');
    Route::get('/info/lotto_mm', [InfoController::class, 'lotto_mm'])->name('web.info.lotto-mm');
    Route::get('/info/lotto_kr', [InfoController::class, 'lotto_kr'])->name('web.info.lotto-kr');
    Route::get('/info/lotto_kr1', [InfoController::class, 'lotto_kr1'])->name('web.info.lotto-kr1');
    Route::get('/info/lotto_ssq', [InfoController::class, 'lotto_ssq'])->name('web.info.lotto-ssq');
    Route::get('/info/lotto_dlt', [InfoController::class, 'lotto_dlt'])->name('web.info.lotto-dlt');
    Route::get('/info/lotto_6', [InfoController::class, 'lotto_6'])->name('web.info.lotto-6');
    Route::get('/info/lotto_7', [InfoController::class, 'lotto_7'])->name('web.info.lotto-7');
    Route::get('/info/lotto_mini', [InfoController::class, 'lotto_mini'])->name('web.info.lotto-mini');
    //회원 로그인/가입
    Route::get('/member/login', [MemberController::class, 'login'])->name('web.member.login');
    Route::post('/member/login', [MemberController::class, 'getUser'])->name('web.member.getUser');
    Route::get('/member/join', [MemberController::class, 'join'])->name('web.member.join');
    Route::post('/member/join', [MemberController::class, 'register'])->name('web.member.register');
    Route::get('/member/id_find', [MemberController::class, 'id_find'])->name('web.member.id_find');
    Route::post('/member/id_find', [MemberController::class, 'id_find_post'])->name('web.member.id_find_post');
    Route::get('/member/password_find', [MemberController::class, 'password_find'])->name('web.member.password_find');
    Route::post('/member/password_find', [MemberController::class, 'password_find_post'])->name('web.member.password_find_post');

    //대행 구매
    
    
    //리버스 구매

    //마이페이지
});

Route::middleware([SiteIsClosed::class])
        ->prefix(config('custom.admin_prefix'))
        ->group(function (){
                if (!env('ADMIN'))
                        return;
                Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('admin.login.get');
                Route::any('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        });

require __DIR__.'/auth.php';
