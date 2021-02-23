<div class="app-sidebar sidebar-shadow positionUnset">
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
    </div>    
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <!-- <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('admin.home')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li> -->
               
                <li class="app-sidebar__heading">Inventory</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Institutes
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                        @foreach($colleges as $college)
                        <li>
                            <a href="#" class="capitalize">
                                <i class="metismenu-icon">
                                </i>
                                <input type="checkbox" name="college" value="{{$college['id']}}">
                                {{$college['name']}}
                            </a>
                        </li>
                       @endforeach
                    </ul>
                </li>
                <li class="app-sidebar__heading">Masters</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Qualifications
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                    @foreach($qualifications as $qualification)
                        <li>
                            <a href="javascript:void;">
                                <i class="metismenu-icon">
                                </i>
                                <input type="checkbox" name="qualification[]" value="{{$qualification['id']}}">
                                {{$qualification['name']}}
                            </a>
                        </li>
                    @endforeach    
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Program Lengths
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                    @foreach($programLengths as $programLength)
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="programLength[]" type="checkbox" value="{{$programLength['id']}}">
                                {{$programLength['name']}}
                            </a>
                        </li>
                    @endforeach    
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Subjects
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                    @foreach($subjects as $subject)
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="subject[]" type="checkbox" value="{{$subject['id']}}">
                                {{$subject['name']}}
                            </a>
                        </li>
                    @endforeach    
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Course Levels
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                    @foreach($courseLevels as $courseLevel)
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="courseLevel[]" type="checkbox" value="{{$courseLevel['id']}}">
                                {{$courseLevel['name']}}
                            </a>
                        </li>
                    @endforeach    
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Ilets Scores
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                    @foreach($iletsScores as $iletsScore)
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="iletsScore" type="radio" value=" {{$iletsScore['id']}}"> 
                                {{$iletsScore['name']}}
                            </a>
                        </li>
                    @endforeach    
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Course Status
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="programStatus" type="radio" value="1"> 
                               Open
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="programStatus" type="radio" value="0"> 
                               Close
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <input name="programStatus" type="radio" value="2"> 
                               Waitlisted
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        English Scores
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                    @foreach($englishScores as $englishScore)
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>
                                <!-- <input type="checkbox"> -->
                                {{$englishScore['score']}}
                            </a>
                        </li>
                    @endforeach    
                       
                    </ul>
                </li>
              
            </ul>
        </div>
        <div class="margin-top-40">&nbsp;</div>
    </div>
</div>   