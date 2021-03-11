<!-- HEADER DESKTOP-->
<header class="header-desktop" style="height:75px">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-button ml-md-auto mt-0 justify-content-center">
                    <div class="noti-wrap mr-lg-0 mr-5">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">{{Auth::user()->unreadNotifications->count()}}</span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>Vous avez {{Auth::user()->unreadNotifications->count()}} Notifications</p>
                                </div>
                                @foreach (Auth::user()->unreadNotifications->whereIn('type',
                                ['App\Notifications\NewClientNotification',]) as $notification)
                                {{-- @if(isset($notification->data['categorie'])) --}}
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>Nouveau client {{ $notification->data['client_name']}}</p>
                                        <span class="date">{{$notification->created_at}}</span>
                                    </div>
                                </div>
                                @endforeach
                                @foreach (Auth::user()->unreadNotifications->whereIn('type',
                                ['App\Notifications\NewOrderNotification',]) as $notification)
                                {{-- @if(isset($notification->data['categorie'])) --}}
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p style="color:red">nouvelle commande n°{{ $notification->data['order_id']}}
                                        </p>
                                        <span class="date">{{$notification->created_at}}</span>
                                    </div>
                                </div>
                                @endforeach

                                {{-- <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div> --}}
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{asset('admin/images/icon/avatar-01.jpg')}}"
                                    alt=" {{ Auth::user()->name }}" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#"> {{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{asset('admin/images/icon/avatar-01.jpg')}}"
                                                alt=" {{ Auth::user()->name }}" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#"> {{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email"> {{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="zmdi zmdi-power"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->