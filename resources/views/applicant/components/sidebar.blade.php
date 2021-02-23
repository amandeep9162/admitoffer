<div class="app-sidebar sidebar-shadow" style="overflow: scroll;">
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
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Navigation</li>
                <li>
                    <a href="{{route('applicant.dashboard')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Application Management</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Applications
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('EditStudent.edit',base64_encode(Auth::guard('student')->user()->id))}}">
                                <i class="metismenu-icon"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{route('EditStudent.show',base64_encode(Auth::guard('student')->user()->id))}}">
                                <i class="metismenu-icon"></i>
                                View Details
                            </a>
                        </li>
                        <li>
                            <a href="{{route('applicant.all.Applications')}}">
                                <i class="metismenu-icon"></i>
                                All Applications
                            </a>
                        </li>
                        <!-- <li>
                            <a href="{{route('student.studentsPendencies')}}">
                                <i class="metismenu-icon"></i>
                                Pendencies List
                            </a>
                        </li> -->
                    </ul>
                </li>
               
            </ul>
        </div>
    </div>
</div>   