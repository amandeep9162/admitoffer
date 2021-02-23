<div class="app-sidebar sidebar-shadow" style="overflow:scroll;">
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
                <?php
                    $user = auth('admin')->user()->roles()->pluck('name');
                ?>
                 @if($user[0] == 'account manager')
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('admin.home')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Task Manager</li>
                <li>
                    <a href="{{route('taskmanager.index')}}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Todo List
                    </a>
                </li>
                <li class="app-sidebar__heading">Agents</li>
               
               <li>
                   <a href="#">
                       <i class="metismenu-icon pe-7s-user"></i>
                       Agent
                       <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                   </a>
                   <ul > 

                       <li>
                           <a href="{{route('agents.index')}}">
                               <i class="metismenu-icon">
                               </i>Agents List
                           </a>
                       </li>
                   </ul>
               </li>
               <li class="app-sidebar__heading">Applied Students List</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Students
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                        <li>
                            <a href="{{route('studentfiles.index')}}">
                                <i class="metismenu-icon">
                                </i>Students List
                            </a>
                        </li>

                    </ul>
                </li>
                @else
                @if($user[0] == 'preprocess'|| $user[0] == 'process')
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('admin.home')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Applied Students List</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Students
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                        <li>
                            <a href="{{route('studentfiles.index')}}">
                                <i class="metismenu-icon">
                                </i>Students List
                            </a>
                        </li>

                        
                         <li>
                             <a href="{{route('today.application')}}">
                                 <i class="metismenu-icon">
                                 </i>Today students
                             </a>
                         </li>
                        <li>
                            <a href="{{route('application.index')}}">
                                <i class="metismenu-icon">
                                </i>Applications
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Pending Applications
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                        <li>
                           <a href="{{route('admin.pending.applications')}}">
                               <i class="metismenu-icon">
                               </i>Pending Applications
                           </a>
                       </li>
                       <li>
                           <a href="{{route('admin.pendencies.applications')}}">
                               <i class="metismenu-icon">
                               </i>All Pendcncies
                           </a>
                       </li>
                     
                    </ul>
                </li>
                <li class="app-sidebar__heading">Agents</li>
               
               <li>
                   <a href="#">
                       <i class="metismenu-icon pe-7s-user"></i>
                       Agent
                       <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                   </a>
                   <ul > 

                       <li>
                           <a href="{{route('agents.index')}}">
                               <i class="metismenu-icon">
                               </i>Agents List
                           </a>
                       </li>
                   </ul>
               </li>
                @else
                @if($user[0] == 'shortlisting')
                 <li class="app-sidebar__heading">Applied Students List</li>
               
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-user"></i>
                         Students
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul > 

                         <li>
                             <a href="{{route('application.Shortlist')}}">
                                 <i class="metismenu-icon">
                                 </i>Students For Shortlisting
                             </a>
                         </li>
                         <li>
                             <a href="{{route('today.application.Shortlist')}}">
                                 <i class="metismenu-icon">
                                 </i>Today Students For Shortlisting
                             </a>
                         </li>
                         <li>
                             <a href="{{route('total.application.Shortlist')}}">
                                 <i class="metismenu-icon">
                                 </i>Total Students For Shortlisting
                             </a>
                         </li>
                         <li>
                             <a href="{{route('today.application')}}">
                                 <i class="metismenu-icon">
                                 </i>Today students
                             </a>
                         </li>
                       
                     </ul>
                 </li>
                @else
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('admin.home')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                 <li class="app-sidebar__heading">Task Manager</li>
                <li>
                    <a href="{{route('taskmanager.index')}}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Todo List
                    </a>
                </li>
                <li class="app-sidebar__heading">Account Manager</li>
                <li>
                    <a href="{{route('taskmanager.mainList')}}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Account Managers Todo List
                    </a>
                </li>
                <li class="app-sidebar__heading">Management</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        User Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.show') }}">
                                <i class="metismenu-icon"></i>
                                User List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles') }}">
                                <i class="metismenu-icon">
                                </i>Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{route('announcement.index')}}">
                                <i class="metismenu-icon">
                                </i>Announcements
                            </a>
                        </li>
                    </ul>
                </li>
               @if($user[0] == 'preprocess' || $user[0] == 'super')
                <li class="app-sidebar__heading">Agents</li>
               
               <li>
                   <a href="#">
                       <i class="metismenu-icon pe-7s-user"></i>
                       Agent
                       <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                   </a>
                   <ul > 

                       <li>
                           <a href="{{route('agents.index')}}">
                               <i class="metismenu-icon">
                               </i>Agents List
                           </a>
                       </li>
                   </ul>
               </li>
               @endif
                <li class="app-sidebar__heading">Applied Students List</li>
               
               <li>
                   <a href="#">
                       <i class="metismenu-icon pe-7s-user"></i>
                       Students
                       <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                   </a>
                   <ul > 

                       <li>
                           <a href="{{route('studentfiles.index')}}">
                               <i class="metismenu-icon">
                               </i>Students List
                           </a>
                       </li>
                       <li>
                           <a href="{{route('application.index')}}">
                               <i class="metismenu-icon">
                               </i>All Applications
                           </a>
                       </li>
                       <li>
                           <a href="{{route('pending.final.submit')}}">
                               <i class="metismenu-icon">
                               </i>Pending Final Submits
                           </a>
                       </li>
                       <li>
                           <a href="{{route('admin.pending.applications')}}">
                               <i class="metismenu-icon">
                               </i>Pending Applications
                           </a>
                       </li>
                      <li>
                           <a href="{{route('admin.pendencies.applications')}}">
                               <i class="metismenu-icon">
                               </i>All Pendcncies
                           </a>
                       </li>
                       <li>
                             <a href="{{route('application.Shortlist')}}">
                                 <i class="metismenu-icon">
                                 </i>Students For Shortlisting
                             </a>
                         </li>
                         <li>
                             <a href="{{route('today.application.Shortlist')}}">
                                 <i class="metismenu-icon">
                                 </i>Today Students For Shortlisting
                             </a>
                         </li>
                         <li>
                             <a href="{{route('total.application.Shortlist')}}">
                                 <i class="metismenu-icon">
                                 </i>Total Students For Shortlisting
                             </a>
                         </li>
                         <li>
                             <a href="{{route('today.application')}}">
                                 <i class="metismenu-icon">
                                 </i>Today students
                             </a>
                         </li>
                   </ul>
               </li>
                <li class="app-sidebar__heading">Inventory</li>
               
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-map-marker"></i>
                        Location
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 

                        <li>
                            <a href="{{route('admin.country.list')}}">
                                <i class="metismenu-icon">
                                </i>Countries List
                            </a>
                        </li>
                      
                        <li>
                            <a href="{{route('admin.state.list')}}">
                                <i class="metismenu-icon">
                                </i>Province List
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.city.list')}}">
                                <i class="metismenu-icon">
                                </i>Cities List
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <!-- <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-home"></i>
                        University
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 

                        <li>
                            <a href="{{route('university.index')}}">
                                <i class="metismenu-icon">
                                </i>University List
                            </a>
                        </li>
                       
                    </ul>
                </li> -->
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Institutes
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 

                        <li>
                            <a href="{{route('colleges.index')}}">
                                <i class="metismenu-icon">
                                </i>Institutes List
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Pre Process Team
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 

                        <li>
                            <a href="{{route('teamPreProcess.index')}}">
                                <i class="metismenu-icon">
                                </i>Pre Process List
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-server"></i>
                        Masters
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 
                        <li>
                            <a href="{{route('commission.create','230')}}">
                                <i class="metismenu-icon">
                                </i>Uk Commission Structure
                            </a>
                        </li>
                        <li>
                            <a href="{{route('commission.create','38')}}">
                                <i class="metismenu-icon">
                                </i>Canada Commission Structure
                            </a>
                        </li> 
                        <li>
                            <a href="{{route('entry.requirements.get')}}">
                                <i class="metismenu-icon">
                                </i>Entry Requirement
                            </a>
                        </li>  
                        <li>
                            <a href="{{route('qualification.index')}}">
                                <i class="metismenu-icon">
                                </i>Qualification
                            </a>
                        </li>
                        <li>
                            <a href="{{route('instituteTypes.index')}}">
                                <i class="metismenu-icon">
                                </i>Institute Types
                            </a>
                        </li>
                        <li>
                            <a href="{{route('programLength.index')}}">
                                <i class="metismenu-icon">
                                </i>Program Length
                            </a>
                        </li>
                        <li>
                            <a href="{{route('programTitle.index')}}">
                                <i class="metismenu-icon">
                                </i>Program Title
                            </a>
                        </li>
                        <li>
                            <a href="{{route('mathScore.index')}}">
                                <i class="metismenu-icon">
                                </i>Math Score
                            </a>
                        </li>
                        <li>
                            <a href="{{route('schoolType.index')}}">
                                <i class="metismenu-icon">
                                </i>School Type
                            </a>
                        </li>
                        <li>
                            <a href="{{route('courseLevel.index')}}">
                                <i class="metismenu-icon">
                                </i>Course Level
                            </a>
                        </li>
                        <li>
                            <a href="{{route('subjects.index')}}">
                                <i class="metismenu-icon">
                                </i>Subjects
                            </a>
                        </li>
                        <li>
                            <a href="{{route('iletsScore.index')}}">
                                <i class="metismenu-icon">
                                </i>IELTS Score
                            </a>
                        </li>
                        <li>
                            <a href="{{route('englishScore.index')}}">
                                <i class="metismenu-icon">
                                </i>English Score
                            </a>
                        </li>
                        <li>
                            <a href="{{route('intakes.index')}}">
                                <i class="metismenu-icon">
                                </i>Intakes
                            </a>
                        </li>
                        <li>
                            <a href="{{route('applicationStatus.index')}}">
                                <i class="metismenu-icon">
                                </i>Application Status
                            </a>
                        </li>
                        <li>
                            <a href="{{route('previousQualification.index')}}">
                                <i class="metismenu-icon">
                                </i>Previous Qualification
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-server"></i>
                        Student Masters
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul > 

                        <li>
                            <a href="{{route('studentQualificationGrades.index')}}">
                                <i class="metismenu-icon">
                                </i>Qualification Grades
                            </a>
                        </li>
                        <li>
                            <a href="{{route('studentQualificationLevelGrades.index')}}">
                                <i class="metismenu-icon">
                                </i>Qualification Level Grades
                            </a>
                        </li>
                        <li>
                            <a href="{{route('studentQuestions.index')}}">
                                <i class="metismenu-icon">
                                </i>Assigned Questions List
                            </a>
                        </li>
                        <li>
                            <a href="{{route('Questions.index')}}">
                                <i class="metismenu-icon">
                                </i>Questions List
                            </a>
                        </li>
                        <li>
                            <a href="{{route('englishTest.index')}}">
                                <i class="metismenu-icon">
                                </i>English Tests
                            </a>
                        </li>
                        <li>
                            <a href="{{route('qualificationTotals.index')}}">
                                <i class="metismenu-icon">
                                </i>Qualification Totals
                            </a>
                        </li>
                        <li>
                            <a href="{{route('qualificationBoard.index')}}">
                                <i class="metismenu-icon">
                                </i>Qualification Board
                            </a>
                        </li>
                        
                       
                    </ul>
                </li>
               @endif
               @endif
               @endif
              
                
            </ul>
        </div>
    </div>
</div>   