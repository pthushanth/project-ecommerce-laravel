<!-- HEADER DESKTOP-->
<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a class="logo" href="{{route('home')}}">
                        <img src="{{asset('images/logo.png')}}" alt="Tech Zone" />
                    </a>
                </div>
                <div class="header-button2">
                    {{-- <div class="header-button-item js-item-menu">
                        <i class="zmdi zmdi-search"></i>
                        <div class="search-dropdown js-dropdown">
                            <form action="">
                                <input class="au-input au-input--full au-input--h65" type="text"
                                    placeholder="Search for datas &amp; reports..." />
                                <span class="search-dropdown__icon">
                                    <i class="zmdi zmdi-search"></i>
                                </span>
                            </form>
                        </div>
                    </div> --}}
                    <div class="header-button-item has-noti js-item-menu">
                        <i class="zmdi zmdi-notifications"></i>
                        @if (Auth::user()->unreadNotifications->count()>0)
                        <span class="quantity">{{Auth::user()->unreadNotifications->count()}}</span>

                        @endif
                        <div class="notifi-dropdown js-dropdown">
                            <div class="notifi__title">
                                <p>Vous avez {{Auth::user()->unreadNotifications->count()}} Notifications</p>
                            </div>
                            {{-- <div class="notifi__item">
                                <div class="bg-c1 img-cir img-40">
                                    <i class="zmdi zmdi-email-open"></i>
                                </div>
                                <div class="content">
                                    <p>You got a email notification</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c2 img-cir img-40">
                                    <i class="zmdi zmdi-account-box"></i>
                                </div>
                                <div class="content">
                                    <p>Your account has been blocked</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div> --}}
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
                </div>
            </div>
        </div>
    </div>
</header>