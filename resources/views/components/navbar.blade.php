<header class="pc-header bg-white">
    <div class="header-wrapper"><!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <div class="page-header-title mt-3"><h2 class="mb-0">{{config('app.name')}}</h2></div>
{{--            {{auth()->user()->firstName}} {{auth()->user()->surname}}--}}
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">


                <li class="dropdown pc-h-item header-user-profile"><a
                        class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false"><img
                            src="{{asset('assets/images/user/avatar-2.jpg')}}" alt="user-image" class="user-avtar"></a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5
                                class="m-0">
{{--                                {{auth()->user()->firstName}} {{auth()->user()->surname}}--}}
                            </h5>
                        </div>
                        <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative"
                                 style="max-height: calc(100vh - 225px);max-width: 90px!important;">
                                <a class="dropdown-item " href="javascript:void();"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti ti-power"></i> <span
                                        key="t-logout">logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
