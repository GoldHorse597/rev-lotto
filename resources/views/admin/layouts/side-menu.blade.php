@extends('admin.layouts.main')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                @lang('admin/app.general')
            </div>
            <!-- Nav Item -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>@lang('admin/app.dashboard')</span></a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item {{ request()->routeIs('admin.live') }}">
                <a class="nav-link" href="{{ route('admin.live') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>실시간로또</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                @lang('admin/app.child') @lang('admin/app.manage')
            </div>
           
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['admin.user.list', 'admin.user.onlinelist', 'admin.user.payments', 'admin.user.coupons', 'admin.user.deposits', 'admin.user.withdraws', 'admin.user.balanceupdatelogs']) == 'active' ? '' : ' collapsed' }}"
                        href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
                    <i class="fas fa-fw fa-user"></i>
                    <span>@lang('admin/app.user')</span>
                </a>
                <div id="collapseUser" class="collapse {{ request()->routeIs(['admin.user.list', 'admin.user.onlinelist', 'admin.user.payments', 'admin.user.coupons', 'admin.user.deposits', 'admin.user.withdraws', 'admin.user.balanceupdatelogs'], 'show') }}" aria-labelledby="headingUser">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('admin.user.list') }}" href="{{ route('admin.user.list') }}">
                            <i class="fas fa-fw fa-user"></i>
                            <span>@lang('admin/app.users')</span>
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.user.onlinelist') }}" href="{{ route('admin.user.onlinelist') }}">
                            <i class="fas fa-fw fa-user"></i>
                            <span>@lang('admin/app.online_users')</span>
                        </a>
                        <a class="collapse-item" href="#userCreateModal" data-toggle="modal">
                            <i class="fas fa-fw fa-user-plus"></i>
                            <span>@lang('admin/app.new_user')</span>
                        </a>
                    </div>
                </div>
            </li>

           

             <hr class="sidebar-divider">
            
            
            <li class="nav-item {{ request()->routeIs('admin.statistics') }}">
                <a class="nav-link" href="{{ route('admin.statistics') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>@lang('admin/app.statistics')</span></a>
            </li>
            
           
             <!-- Divider -->
            
            <!-- Divider -->
            <hr class="sidebar-divider">
          
            <div class="sidebar-heading">
                @lang('admin/app.system') @lang('admin/app.manage')
            </div>
            <!-- Nav Item -->
           
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['admin.message.list', 'admin.inquiry.list', 'admin.inquirytemplate.list', 'admin.notice.list']) == 'active' ? '' : 'collapsed' }}"
                        href="#" data-toggle="collapse" data-target="#collapseCustomerCenter" aria-expanded="true" aria-controls="collapseCustomerCenter">
                    <i class="fas fa-fw fa-gamepad"></i>
                    <span>@lang('admin/app.customer_center')</span>
                </a>
                <div id="collapseCustomerCenter" class="collapse {{ request()->routeIs(['admin.message.list', 'admin.inquiry.list', 'admin.inquirytemplate.list', 'admin.event.list', 'admin.notice.list'], 'show') }}" aria-labelledby="headingGame">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('admin.message.list') }}" href="{{ route('admin.message.list') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>@lang('admin/app.message')</span>
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.inquiry.list') }}" href="{{ route('admin.inquiry.list') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>@lang('admin/app.inquiry')</span>
                        </a>
                        @if (Auth::guard('admin')->user()->parent_level == 0)
                        <!-- <a class="collapse-item {{ request()->routeIs('admin.inquirytemplate.list') }}" href="{{ route('admin.inquirytemplate.list') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>@lang('admin/app.inquiry_template')</span>
                        </a> -->
                        <a class="collapse-item {{ request()->routeIs('admin.notice.list') }}" href="{{ route('admin.notice.list') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>@lang('admin/app.notice')</span>
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.event.list') }}" href="{{ route('admin.event.list') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>@lang('admin/app.event')</span>
                        </a>
                       
                        @endif
                    </div>
                </div>
            </li>
             <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['admin.message.list', 'admin.inquiry.list', 'admin.inquirytemplate.list', 'admin.notice.list']) == 'active' ? '' : 'collapsed' }}"
                        href="#" data-toggle="collapse" data-target="#collapseLottoCenter" aria-expanded="true" aria-controls="collapseLottoCenter">
                    <i class="fas fa-fw fa-gamepad"></i>
                    <span>로또관리</span>
                </a>
                <div id="collapseLottoCenter" class="collapse {{ request()->routeIs(['admin.lotto.game', 'admin.lotto.setting'], 'show') }}" aria-labelledby="headingGame">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('admin.lotto.game') }}" href="{{ route('admin.lotto.game') }}">
                            <i class="fas fa-fw fa-barcode"></i>
                            <span>로또목록</span>
                        </a>
                        <a class="collapse-item {{ request()->routeIs('admin.lotto.setting') }}" href="{{ route('admin.lotto.setting') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>배당률설정</span>
                        </a>  
                        <a class="collapse-item {{ request()->routeIs('admin.lotto.pri') }}" href="{{ route('admin.lotto.pri') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>프리미엄로또 완료답지</span>
                        </a>    
                        <a class="collapse-item {{ request()->routeIs('admin.lotto.pri1') }}" href="{{ route('admin.lotto.pri1') }}">
                            <i class="fas fa-fw fa-gem"></i>
                            <span>프리미엄로또 예정답지</span>
                        </a>                   
                    </div>
                </div>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.betting_history') }}">
                <a class="nav-link" href="{{ route('admin.betting_history') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>@lang('admin/app.betting_history')</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.agent.codes') }}">
                <a class="nav-link" href="{{ route('admin.agent.codes') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>@lang('admin/app.codes')</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.agent.banks') }}">
                <a class="nav-link" href="{{ route('admin.agent.banks') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>@lang('admin/app.banks')</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.agent.settings') }}">
                <a class="nav-link" href="{{ route('admin.agent.settings') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>@lang('admin/app.setting_and_info')</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="{{ route('admin.user.onlinelist') }}">
                                <span class="d-none d-lg-inline small">
                                    <div class="text-dark text-right">
                                        @lang('admin/app.online_user_cnt')
                                    </div>
                                    <div class="text-gray-600 text-right">
                                        <span id="online_users_cnt">{{number_format(floor($_online_users_cnt), 0)}}</span> @lang('admin/app.myong')
                                    </div>
                                </span>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-lg-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-link dropdown-toggle">
                                <span class="d-none d-lg-inline small">
                                    <span class="badge badge-danger badge-counter m-0" id="new_statistics_cnt" style="margin-right: 10px !important;">0</span>
                                    <div class="text-dark text-right">
                                        <a href="{{ route('admin.statistics') }}?status=0" style="margin-right: 20px;">
                                            입출금신청
                                        </a>
                                        <audio src="{{ asset('admin/sound/new_message_alarm.mp3') }}" controls id="new_statistics_alarm" hidden></audio>
                                    </div>                                   
                                </span>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-lg-block"></div>

                        @if (Auth::guard('admin')->user()->parent_level == 0)
                        <li class="nav-item dropdown no-arrow pr-2">
                            <div class="nav-link dropdown-toggle">
                                <span class="d-none d-lg-inline small">
                                    <span class="badge badge-danger badge-counter m-0" id="new_users_cnt">0</span>
                                    <div class="text-dark text-right">
                                        <a href="{{ route('admin.user.list') }}">
                                            @lang('admin/app.user') @lang('admin/app.new_register')
                                        </a>
                                        <audio src="{{ asset('admin/sound/new_user_alarm.mp3') }}" controls id="new_user_alarm" hidden></audio>
                                    </div>
                                    <span class="badge badge-danger badge-counter m-0" id="new_inquiries_cnt">0</span>
                                    <div class="text-dark text-right">
                                        <a href="{{route('admin.inquiry.list')}}">
                                            @lang('admin/app.new_received_inquiries')
                                        </a>
                                        <audio src="{{ asset('admin/sound/new_inquiry_alarm.mp3') }}" controls id="new_inquiry_alarm" hidden></audio>
                                    </div>
                                </span>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-lg-block"></div>
                        @else
                        <li class="nav-item dropdown no-arrow pr-2">
                            <div class="nav-link dropdown-toggle">
                                <span class="d-none d-lg-inline small">
                                    <span class="badge badge-danger badge-counter m-0" id="new_messages_cnt">0</span>
                                    <div class="text-dark text-right">
                                        <a href="{{ route('admin.message.list') }}">
                                            @lang('admin/app.new_received_messages')
                                        </a>
                                        <audio src="{{ asset('admin/sound/new_message_alarm.mp3') }}" controls id="new_message_alarm" hidden></audio>
                                    </div>
                                    <span class="badge badge-danger badge-counter m-0" id="new_inquiries_cnt">0</span>
                                    <div class="text-dark text-right">
                                        <a href="{{route('admin.inquiry.list')}}">
                                            @lang('admin/app.new_received_inquiry_replies')
                                        </a>
                                        <audio src="{{ asset('admin/sound/new_inquiry_alarm.mp3') }}" controls id="new_inquiry_alarm" hidden></audio>
                                    </div>
                                </span>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-lg-block"></div>
                        @endif

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{ asset('admin/img/svg/undraw_profile.svg') }}">
                                <span class="ml-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::guard('admin')->user()->nickname }} ({{ '@'.Auth::guard('admin')->user()->identity }}) </span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item " href="{{ route('admin.agent.settings') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> @lang('admin/app.setting_and_info') </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item " href="{{ route('admin.lotto.scrap') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>로또 결과 가져오기 </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> @lang('admin/app.logout') </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }} 2022.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('admin.layouts.modals')
@endsection