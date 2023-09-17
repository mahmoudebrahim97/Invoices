<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/yvgxudcr.png') }}"
                        width="100px" height="100" class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="dark-logo-1"
                        alt="logo"></a>
                {{-- <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('assets/img/brand/fwateer-logos_white.png') }}" class="logo-2"
                        alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('assets/img/brand/fwateer-logos_white.png') }}" class="dark-logo-2"
                        alt="logo"></a> --}}
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
        </div>
        <div class="main-header-right">
            <div class="nav nav-item  navbar-nav-right ml-auto">


                <div class="dropdown nav-item main-header-notification">
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <a class="new nav-link" href="#" id="noty">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs " viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg><span class="pulse"></span>
                        </a>
                    @else
                        <a class="new nav-link ml-3" href="#" id="noty"
                            style=" display: inline-block ;margin-left:-5px; margin-top: -4px; margin-right: -3px">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg><span class=""></span>
                        </a>
                    @endif



                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الاشعارات</h6>
                                <span class="badge badge-pill badge-warning mr-auto my-auto float-left"><a
                                        href="{{ route('markAsRead') }}">تحديد الكل كمقروء</a></span>
                            </div>
                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 "
                                id="notifications_count">عدد الاشعارات الغير مقروءة :
                                {{ auth()->user()->unreadNotifications->count() }}</p>
                        </div>
                        <div class="main-notification-list Notification-scroll" id="unreadNotifications">
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <a class="d-flex p-3 border-bottom"
                                    href="{{ route('invoice.details_notify', $notification->data['invoice']['id']) }}">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white m-2"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h5 class="notification-label mb-1">{{ $notification->data['title'] }} رقم
                                            {{ $notification->data['invoice']['invoice_number'] }} بواسطة :
                                            {{ $notification->data['user_create'] }}</h5>
                                        <div class="notification-subtext">{{ $notification->created_at }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="dropdown-footer">
                            <a href="{{ route('invoices') }}">عرض الكل</a>
                        </div>
                    </div>
                </div>
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg"
                            class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                            </path>
                        </svg></a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt=""
                            src="{{ URL::asset('assets/img/faces/user.jpg') }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user m-1"><img alt=""
                                        src="{{ URL::asset('assets/img/faces/user.jpg') }}" class="m-2"></div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ Auth::user()->name }}</h6><span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        @can('تعديل مستخدم')
                            <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}"><i
                                    class="bx bx-user-circle"></i>تعديل الملف الشخصي</a>
                            <a class="dropdown-item" href="{{ url('/' . ($page = 'users')) }}"><i
                                    class="bx bx-cog"></i>تعديل المستخدمين</a>
                        @endcan
                        <a class="nav-link text-primary btn" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">تسجيل
                            الدخول
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
