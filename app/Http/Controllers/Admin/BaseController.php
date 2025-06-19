<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Setting;
use App\Models\Agent;
use App\Models\User;
use App\Models\Site;
use App\Models\Bank;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
            $app_name = config('app.name');
            $layout = 'side-menu';

            if (\Route::current()->getName() != 'admin.tick') {
                session()->put('lastActivityTime', time());
            }

            $_setting = Setting::first();

            $authUser = \Auth::guard('admin')->user();
            $_agents =  $authUser;
            $_online_users_cnt = 0;

            $_banks = Bank::select('name')->get();
         
            \View::share(compact(
                'app_name', 'layout', '_setting', '_agents', '_online_users_cnt', '_banks'
            ));

            return $next($request);
        });
    }

    public function getMenuActive($route_name)
    {
        $first_active = '';
        $second_active = '';
        $third_active = '';
        
        $menu_list = $this->getMenu();
        foreach ($menu_list as $menu) {
            if ($menu == 'devider')
                continue;
            
            if (isset($menu['link']) && $menu['link'] == $route_name && empty($first_active)) {
                $first_active = $menu['name'];
            }

            if (isset($menu['sub_menu'])) {
                foreach ($menu['sub_menu'] as $sub_menu) {
                    if (isset($sub_menu['link']) && $sub_menu['link'] == $route_name && empty($second_active)) {
                        $first_active = $menu['name'];
                        $second_active = $sub_menu['name'];
                    }

                    if (isset($sub_menu['sub_menu'])) {
                        foreach ($sub_menu['sub_menu'] as $last_sub_menu) {
                            if (isset($last_sub_menu['link']) && $last_sub_menu['link'] == $route_name) {
                                $first_active = $menu['name'];
                                $second_active = $sub_menu['name'];
                                $third_active = $last_sub_menu['name'];
                            }
                        }
                    }
                }
            }
        }

        return [
            'first_active' => $first_active,
            'second_active' => $second_active,
            'third_active' => $third_active
        ];
    }

    public function getMenu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'name' => 'dashboard',
                'title' => '대시보드',
                'link' => 'admin.dashboard'
            ],
            
            'users' => [
                'icon' => 'box',
                'name' => 'users',
                'title' => '유저 관리',
                'sub_menu' => [
                    'user.list' => [
                        'icon' => '',
                        'name' => 'user.list',
                        'title' => '유저 목록',
                        'link' => 'admin.user.list'
                    ],
                    'user.create' => [
                        'icon' => '',
                        'name' => 'user.create',
                        'title' => '유저 추가',
                        'link' => 'admin.user.create'
                    ],
                ]
            ],
            'devider',
            'messages' => [
                'icon' => 'box',
                'name' => 'messages',
                'title' => '쪽지'
            ],
            'notices' => [
                'icon' => 'box',
                'name' => 'notices',
                'title' => '공지사항'
            ]
        ];
    }
}