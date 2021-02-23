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
                    <a href="{{route('agent.dashboard')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                                
              <!--   <li>
                    <a href="{{route('chat.create.agent')}}" class="">
                        <i class="metismenu-icon pe-7s-chat"></i>
                        Chat
                    </a>
                </li> -->

                <li class="app-sidebar__heading">Application Management</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Applications
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('student.create')}}">
                                <i class="metismenu-icon"></i>
                                Add New Student
                            </a>
                        </li>
                        <li>
                            <a href="{{route('student.index')}}">
                                <i class="metismenu-icon"></i>
                                All Students List
                            </a>
                        </li>
                        <li>
                            <a href="{{route('all.Applications')}}">
                                <i class="metismenu-icon"></i>
                                All Applications List
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
                <li class="app-sidebar__heading">Pendency Management</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-repeat"></i>
                        Pendencies
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('student.studentsApplPendencies')}}">
                                <i class="metismenu-icon"></i>
                                Application Pendencies 
                            </a>
                        </li>
                        <li>
                            <a href="{{route('student.studentsPendencies')}}">
                                <i class="metismenu-icon"></i>
                                Student Pendencies 
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                      <a href="{{route('all.PendingTTCopy')}}">
                        <i class="metismenu-icon pe-7s-repeat"></i>
                        Pending TT / Tuition Fee
                    </a>
                </li>
                <li class="app-sidebar__heading">Application Offers</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-ticket"></i>
                        Offers
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('student.ApplicationOffers')}}">
                                <i class="metismenu-icon"></i>
                                Offer List
                            </a>
                        </li>
                        <li>
                            <a href="{{route('student.visaReceived')}}">
                                <i class="metismenu-icon"></i>
                                Visa Received
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Search Courses</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-search"></i>
                        Course
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('search.index')}}">
                                <i class="metismenu-icon"></i>
                                Search
                            </a>
                        </li>
                      
                    </ul>
                </li>
                <li class="app-sidebar__heading">Reports</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-cash"></i>
                       Commissions
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('agent.dashboard')}}">
                                <i class="metismenu-icon"></i>
                                Current Performance
                            </a>
                        </li>
                        <li>
                            <a href="{{route('agent.dashboard')}}">
                                <i class="metismenu-icon"></i>
                                Previous Intake Performance
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-graph3"></i>
                       Reports
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('totalConversions.report')}}">
                                <i class="metismenu-icon"></i>
                                Total Conversions
                            </a>
                        </li>
                        <li>
                            <a href="{{route('commission.report')}}">
                                <i class="metismenu-icon"></i>
                               Commissions
                            </a>
                        </li>
                        <li>
                            <a href="{{route('university.report')}}">
                                <i class="metismenu-icon"></i>
                               University Wise Report
                            </a>
                        </li>
                        <!-- <li>
                            <a href="{{route('location.report')}}">
                                <i class="metismenu-icon"></i>
                               Location Wise Report
                            </a>
                        </li> -->
                        <li>
                            <a href="{{route('total.report')}}">
                                <i class="metismenu-icon"></i>
                               Total Report
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Resources</li>
                <li class="mb-2">
                    
                     <li><a href="#">
                            <i class="metismenu-icon pe-7s-study"></i>
                        Commission Structure
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('comission.structure',base64_encode(230))}}">
                                    <i class="metismenu-icon"></i>
                                    UK 
                                </a>
                            </li>
                            @if(auth()->guard('agent')->check() == true)
                                @if(in_array('38',CheckCountry::allowCountry()))

                                <li>
                                    <a href="{{route('comission.structure',base64_encode(38))}}">
                                        <i class="metismenu-icon"></i>
                                        Canada 
                                    </a>
                                </li>
                                @endif
                            @endif
                           
                        </ul>
                     </li>
                    <li><a href="#">
                            <i class="metismenu-icon pe-7s-study"></i>
                        Uni Entry Requirements
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('allUk.universities.structure')}}">
                                    <i class="metismenu-icon"></i>
                                    UK
                                </a>
                            </li>
                           @if(auth()->guard('agent')->check() == true)
                                @if(in_array('38',CheckCountry::allowCountry()))

                                <li>
                                    <a href="{{route('allUk.universities.structure')}}">
                                        <i class="metismenu-icon"></i>
                                        Canada 
                                    </a>
                                </li>
                                @endif
                            @endif
                           
                        </ul>
                     </li>
                     
                </li>
            </ul>
        </div>
    </div>
</div>   