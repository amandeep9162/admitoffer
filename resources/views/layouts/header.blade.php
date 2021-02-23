<div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                         </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <?php
                                                  $agentImg =  ImageUpload::agentImage();
                                                ?>  
                                                @if($agentImg)
                                                <img width="42" class="rounded-circle" src="{{asset($agentImg['path'].'/'.$agentImg['name'])}}" alt="">
                                                @else
                                                <img width="42" class="rounded-circle" src="/images/site/user-img.png" alt="">
                                                @endif
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Activity
                                                        </li>
                                                        @if(!Auth::guard('agent')->check() || Auth::guard('admin')->check())
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ route('agent.login') }}">{{ __('Agent Login') }}</a>
                                                        </li>
                                                            @if (Route::has('register'))
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="{{ route('agent.register') }}">{{ __('Agent Register') }}</a>
                                                                </li>
                                                            @endif
                                                            <!-- @if(!Auth::guard('admin')->check())
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Admin Login') }}</a>
                                                            </li>
                                                            @endif -->
                                                        @else
                                                       
                                                        <li class="nav-item dropdown">
                                                         
                                                            <div class="dropdown-menu-header">
                                                                    <div class="dropdown-menu-header-inner bg-info">
                                                                        <div class="menu-header-image opacity-2" style="background-image: url('/images/dropdown-header/city3.jpg');"></div>
                                                                        <div class="menu-header-content text-left">
                                                                            <div class="widget-content p-0">
                                                                                <div class="widget-content-wrapper">
                                                                                    <div class="widget-content-left mr-3">
                                                                                        
                                                                                            @if($agentImg)
                                                                                            <img width="42" class="rounded-circle" src="{{asset($agentImg['path'].'/'.$agentImg['name'])}}" alt="">
                                                                                            @else
                                                                                            <img width="42" class="rounded-circle" src="/images/avatars/1.jpg" alt="">
                                                                                            @endif
                                                                                    </div>
                                                                                    <div class="widget-content-left">
                                                                                        <div class="widget-heading">{{ Auth::guard('agent')->user()->name }}
                                                                                        </div>
                                                                                        <div class="widget-subheading opacity-8">A short profile description
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="widget-content-right mr-2">
                                                                                        <button class="btn-pill btn-shadow btn-shine ">   
                                                                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                                                            onclick="event.preventDefault();
                                                                                                            document.getElementById('logout-form').submit();">
                                                                                                {{ __('Logout') }}
                                                                                            </a>
                            
                                                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                                                @csrf
                                                                                            </form>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                           
                                                        </li>
                                                    @endif
                                                       
                                                    </ul>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mb-0 nav-item"></li>
                                            </ul>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        @if(Auth::guard('agent')->check())
                                        {{ Auth::guard('agent')->user()->name }}
                                        @elseif(Auth::guard('admin')->check())
                                        {{ Auth::guard('admin')->user()->name }}
                                        @endif
                                    </div>
                                    <div class="widget-subheading">
                                        VP People Manager
                                    </div>
                                </div>
                                <!-- <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="header-btn-lg">
                        <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>    -->
                     </div>
            </div>
        </div>