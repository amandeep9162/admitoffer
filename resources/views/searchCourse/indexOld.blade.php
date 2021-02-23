@extends('layouts.app') 
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Find Eligibilities
                        <div class="page-title-subheading">This is a search about course requirements.
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        
    </div>
    <!-- <div class="col-md-12">
    <div class="row">
        <div class="bg-Img">
            <h1>Find Course</h1>
        </div>
    </div>
    </div> -->
    <div class="container search">

        <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('search.course')}}">  
            @csrf   
          
            
                   
            <div class="row">
                <div class="col-md-4">
                    <select class="mb-2 form-control bgColorGray" name="country_id" id="country_id" >
                        <option value=''> Select country</option>
                        @foreach($countries as $country)
                            <option value="{{$country['id']}}"> {{$country['name']}}</option>
                        @endforeach
                    </select>
                </div>   
                <div class="col-md-4">
                    <select class="mb-2 form-control bgColorGray" name="state_id" id="state_id" >
                        <option value=''> Select state</option>
                    </select>
                </div>   
                <div class="col-md-3">
                    <select class="mb-2 form-control bgColorGray" name="city_id" id="city_id"  >
                        <option value=''> Select city</option>
                    </select>
                </div>   
                <div class="col-md-1">
                    <button class="btn btn-info">Find</button>
                </div>   
            </div> 
            
            <br>  
            <div class="row">
                    <div class="col-md-12">
                        <div class="app-header__content" >
                               
                        <!-- <example-component></example-component> -->
                                <div class="app-header-left">
                                    <div class="search-wrapper active" style=" width:100%!important;">
                                        <div class="input-holder "  style=" width:100%!important;">
                                            <input type="text" class="search-input" name="searchText" placeholder="Type to search">
                                            <button type="button" class="search-icon"><span></span></button>
                                        </div>
                                        <!-- <button class="close"></button> -->
                                    </div>
                                </div>
                        </div>
                    </div>   
                </div> <br>
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                            @include('searchCourse/sidebar')
                            
                    </div>
                    <div class="col-sm-12 col-lg-9">
                        <div class="card-hover-shadow-2x mb-3 card">
                            
                            <div class="scroll-area-lg " style="height: auto !important;max-height: 800px !important;">
                                <perfect-scrollbar class="ps-show-limits">
                                    <div style="position: static;" class="ps ps--active-y">
                                        <div class="ps-content">
                                            <ul class="todo-list-wrapper list-group list-group-flush" id="exampleAccordion">
                                                


                                                @foreach($courses as $course)
                                               
                                                <li class="list-group-item">
                                                    <div class="todo-indicator bg-success"></div>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading"><h5><strong>{{$course['name']}}</strong></h5></div>
                                                                <div class="row">

                                                                    <div class=" col-md-3">{{date('M d Y',strtotime($course['intake']))}}<span class="float-right">|</span></div>
                                                                    <div class=" col-md-3 capitalize "><strong>Institute: </strong>{{$course->college['name']}}<span class="float-right">|</span></div>
                                                                    <div class=" col-md-3 ">
                                                                        @if($course['program_status'] == '0')
                                                                        <i class="fa fa-dot-circle" style="color:red;background:red;"></i> Close
                                                                        @endif
                                                                        @if($course['program_status'] == '1')
                                                                        <i class="fa fa-dot-circle" style="color:green;background:green;"></i> Open
                                                                        @endif
                                                                        @if($course['program_status'] == '2')
                                                                        <i class="fa fa-dot-circle" style="color:orange;background:orange;"></i> Waitlisted
                                                                        @endif
                                                                        <span class="float-right">|</span></div>
                                                                    <div class=" col-md-3"><strong>Website :</strong> <a href="{{$course->college['website_link']}}" target="_blank"> <i class="fa fa-link"></i></a></div>
                                                                </div>
                                                              
                                                            </div>
                                                            <div class="widget-content-right">
                                                                @if($course->college)
                                                                <div class="badge badge-warning mr-2">{{ $course->college->city['name'] }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="widget-content-right">
                                                                <button type="button" class="border-0 btn-transition btn btn-outline-success" aria-expanded="false" aria-controls="exampleAccordion2" data-toggle="collapse" href="#collapseExample{{$course['id']}}" class="m-0 p-0 btn btn-link">
                                                                    <fa name="check" _nghost-c2=""><i _ngcontent-c2="" aria-hidden="true" class="fa fa-arrow-down"></i></fa>
                                                                </button>
                                                                <!-- <button class="border-0 btn-transition btn btn-outline-danger">
                                                                    <fa name="trash" _nghost-c2=""><i _ngcontent-c2="" aria-hidden="true" class="fa fa-trash"></i></fa>
                                                                </button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item" style="padding:0 20px 0px 20px;">
                                                    <div class="todo-indicator bg-success"></div>
                                                    <div data-parent="#exampleAccordion" id="collapseExample{{$course['id']}}" class="collapse">
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><h5><strong>Course Detail</strong></h5></div>
                                                            <div class="col-md-8 padding-10px"><small>&nbsp;</small></div>
                                                        </div>
                                                        @if($course->subjects)
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><strong>Subject</strong></div>
                                                            <div class="col-md-8 padding-10px"><small>{{$course->subjects['name']}}</small></div>
                                                        </div>
                                                        @endif
                                                        @if($course->qualifications)
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><strong>Qualification</strong></div>
                                                            <div class="col-md-8 padding-10px"><small>{{$course->qualifications['name']}}</small></div>
                                                        </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><strong>Application Fee</strong></div>
                                                            <div class="col-md-8 padding-10px"><small>$ {{$course['application_fee']}}</small></div>
                                                        </div>
                                                        @if($course->program_lengths)
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><strong>Course Length</strong></div>
                                                            <div class="col-md-8 padding-10px"><small>{{$course->program_lengths['name']}}</small></div>
                                                        </div>
                                                        @endif
                                                        @if($course->course_levels)
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><strong>Course Level</strong></div>
                                                            <div class="col-md-8 padding-10px"><small>{{$course->course_levels['name']}}</small></div>
                                                        </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-4 courseDetail padding-10px"><strong>Scholarship</strong></div>
                                                            <div class="col-md-8 padding-10px">
                                                                @if($course['scholarship'] == '1')
                                                                <small>Available</small>
                                                                @endif
                                                                @if($course['scholarship'] == '2')
                                                                <small>Not Available</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                            <!-- <div class="row">
                                                                <div class="padding-10px capitalize ">{{$course['description']}}</div>
                                                            </div> -->
                                                    </div>
                                                </li>
                                                @endforeach
                                                @if($courses->count()==0)
                                                <p class="text-center">No Course available.</p>
                                                @endif
                                            </ul>
                                        </div>
                                        <!---->
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 296px;"></div>
                                        </div>
                                    </div>
                                </perfect-scrollbar>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </form>
            
        </div>
    </div>

    </div>

@endsection