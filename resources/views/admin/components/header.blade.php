<?php
    $isLogin = \Auth::user();
    $roleType = config('multiauth.prefix');
    if($roleType =="admin"){
        $isLogin = auth('admin')->user();
    }
?>
@if($isLogin)
                
<div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"><img src="{{ asset('images/logo.png')}}" width= '175px';></div>
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
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <!-- <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> -->
                    <ul class="header-menu nav">
                        <li class="nav-item">
                        <li class="btn-group nav-item">
                            <a href="{{route('search.index')}}" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Find
                            </a>
                        </li>
                        <?php
                        $user = auth('admin')->user()->roles()->pluck('name');
                        ?>
                        @if($user[0] == 'preprocess'|| $user[0] == 'process' || $user[0] == 'account manager')
                        @else
                        <li class="nav-item">
                            <a href="{{route('colleges.index')}}" class="nav-link">
                                <i class="nav-link-icon fa fa-home"> </i>
                                Institutes
                            </a>
                        </li>
                        @endif
                    <!--
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li> -->
                    </ul>        
                </div>
                
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <!-- <h6 class="margin-btm-4">Total Commission Dispersed</h6> -->
                            <div class="widget-content-wrapper">
                                <!-- <div class="pound"> -->
                                    <!-- <img src="{{asset('images/site/Bitcoin.jpg')}}"  style="width:100%;height:100%;"> -->
                                <!-- </div> -->
                                <!-- <h5 class="margin-right70px font-weight-color">96000 &nbsp;</h5>
                                <h6 style="margin-bottom:0px;">CAD &nbsp;</h6> -->
                                <!-- <div class="dollar"> -->
                                    <!-- <img src="{{asset('images/site/Bitcoin.jpg')}}"  style="width:100%;height:100%;"> -->
                                <!-- </div> -->
                                <!-- <h5 class="margin-right70px font-weight-color">1920000 &nbsp;</h5> -->
                                @php $notifications = Notify::adminNotifications();@endphp
                                @php $messages = Notify::adminMessages();@endphp
                                @if($user[0] != 'account manager')
                                <div class="widget-content-left mr-50 notifmsg">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                           <span class="msgCountAdminAppend">
                                               @if($messages->count() > 0)
                                               <span class="msgCountAdmin">{{$messages->count()}}</span>
                                               @endif
                                            </span>
                                            <i class="fas fa-envelope-square fa-2x ml-2 opacity-8" style="color:#e77817"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right AdminappendMessageMsg">
                                            <h5 class="text-center">Messages</h5>
                                            <!-- <div>
                                                <h6 class="">Mark Read All</h6>
                                            </div> -->
                                            <?php $i = 0; ?>
                                            @foreach($messages as $message) 
                                            @if($i++ == 5)
                                                @break
                                            @endif
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="{{route('student.notify.update',$message['id'])}}" class="onClickNotif"><p class="padding-10px font-size-12">{{$message['message']}}</p></a>
                                            @endforeach
                                           
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="{{route('notification.messages.list')}}"><h5 class="text-center">View All</h5></a>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left mr-50 notifbell">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                           <span class="bellCountAdminAppend">
                                               @if($notifications->count() > 0)
                                               <span class="bellCountAdmin">{{$notifications->count()}}</span>
                                               @endif
                                            </span>
                                            <i class="fas fa-bell fa-2x ml-2 opacity-8" style="color:#e77817"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right AdminappendMessage">
                                            <h5 class="text-center">Notifications</h5>
                                            <!-- <div>
                                                <h6 class="">Mark Read All</h6>
                                            </div> -->
                                            <?php $i = 0; ?>
                                            @foreach($notifications as $notification) 
                                            @if($i++ == 5)
                                                @break
                                            @endif
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="{{route('student.notify.update',$notification['id'])}}" class="onClickNotif"><p class="padding-10px font-size-12">{{$notification['message']}}</p></a>
                                            @endforeach
                                            
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="{{route('notification.list')}}"><h5 class="text-center">View All</h5></a>
                                            
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="widget-content-left" >
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="50" class="rounded-circle" src="/images/avatars/2.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                         <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-292px, 44px, 0px);">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2" style="background-image: url('/assets/site/city3.jpg');"></div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <img width="42" class="rounded-circle" src="assets/site/1.jpg" alt="">
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">{{ auth('admin')->user()->name }} ({{$user[0]}})
                                                                    </div>
                                                                    <div class="widget-heading">{{$isLogin['email']}} 
                                                                    </div>
                                                                    <div class="widget-subheading opacity-8">({{ config('multiauth.prefix') }})
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                     <a  href="/admin/logout" tabindex="0" class="dropdown-item" onclick="event.preventDefault();
                                                                                 document.getElementById('logout-form').submit();">
                                                                            {{ __('Logout') }}
                                                                    </a>
                                                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Activity
                                                        </li>
                                                       
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Change Password
                                                            </a>
                                                        </li><li class="nav-item">
                                                            <a href="#" class="nav-link">My Account
                                                            </a>
                                                        </li>
                                                        
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Settings
                                                                <div class="ml-auto badge badge-success">New
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Messages
                                                                <div class="ml-auto badge badge-warning">512
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Logs
                                                            </a>
                                                        </li>
                                                    </ul>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mb-0 nav-item"></li>
                                            </ul>
                                            <div class="grid-menu grid-menu-2col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6">
                                                        <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                                                            <i class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                                                            Message Inbox
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                            <i class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                            <b>Support Tickets</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider nav-item">
                                                </li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <button class="btn-wide btn btn-primary btn-sm">
                                                        Open Messages
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                    {{ auth('admin')->user()->name }} <small> ({{ config('multiauth.prefix') }})</small>
                                    </div>
                                    <!-- <div class="widget-subheading">
                                        VP People Manager
                                    </div> -->
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <!-- <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
        @endif
        