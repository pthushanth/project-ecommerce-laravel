<!-- HEADER DESKTOP-->
<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/logo.png')}}" alt="Techzone" />
                    </a>
                </div>
                <div class="header-button2">
                    <div class="noti-wrap mt-1 mr-4 mr-lg-0">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications" style="color: #ffffff"></i>
                            <span class="quantity">{{Auth::user()->unreadNotifications->count()}}</span>
                            <div class="notifi-dropdown js-dropdown" style="left: -280px;">
                                <div class="notifi__title">
                                    <p>Vous avez {{Auth::user()->unreadNotifications->count()}} Notifications</p>
                                </div>

                                {{-- @foreach (Auth::user()->unreadNotifications->whereIn('type',
                                ['App\Notifications\NewOrderNotification',]) as $notification) --}}
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                {{-- @if(isset($notification->data['categorie'])) --}}
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p style="color:red">{{ $notification->data['message']}}
                                        </p>
                                        <span class="date">{{$notification->created_at}}</span>
                                    </div>
                                </div>
                                @endforeach
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{asset(Auth::user()->getAvatarUrl())}}"
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
                    <div class="header-button-item mr-0 js-sidebar-btn">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                </div>

                {{-- <div class="header-button2">
                    <div class="header-button-item has-noti js-item-menu">
                        <i class="zmdi zmdi-notifications"></i>
                        @if (Auth::user()->unreadNotifications->count()>0)
                        <span class="quantity">{{Auth::user()->unreadNotifications->count()}}</span>

                @endif
                <div class="notifi-dropdown js-dropdown">
                    <div class="notifi__title">
                        <p>Vous avez {{Auth::user()->unreadNotifications->count()}} Notifications</p>
                    </div>
                    @foreach (Auth::user()->unreadNotifications->whereIn('type',
                    ['App\Notifications\NewOrderNotification',]) as $notification)

                    <div class="notifi__item">
                        <div class="bg-c3 img-cir img-40">
                            <i class="zmdi zmdi-file-text"></i>
                        </div>
                        <div class="content">
                            <p>nouvelle commande n°{{ $notification->data['order_id']}}</p>
                            <span class="date">{{$notification->created_at}}</span>
                        </div>
                    </div>
                    @endforeach
                    <div class="notifi__footer">
                        <a href="#">All notifications</a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    </div>
    </div>
</header>