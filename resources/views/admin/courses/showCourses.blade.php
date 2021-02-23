@extends('admin.layouts.admin') 
@section('content')

<div class="app-page-title" style="margin: -30px 0px 30px;">
    <div class="page-title-wrapper">
        <div class="page-title-heading" >
            <div class="" style="margin: 0 30px 0 0;">
                
            </div>
            <div class="capitalize"><b>{{$college['name']}}</b>
                <div class="page-title-subheading capitalize">{{$college['description']}}.
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header ">
                    <div class="col-md-10">
                        
                        Program Detail
                    </div>
                    <div class="col-md-2">
                            @if($course['verify_by'])
                            <p class="text-success btn-sm"><i class="fa fa-check"></i> &nbsp;Verified</p>
                            @endif
                    </div>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    
                       
                    
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Course Name</label>
                        <div class="col-sm-10">    
                        <p class="mb-2" >{{$course['name']}}</p>
                        </div>
                    </div>   
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Program Weblink</label>
                        <div class="col-sm-10">    
                        <p class="mb-2" ><a href="{{$course['program_weblink']}}">{{$course['program_weblink']}}</a></p>
                        </div>
                    </div>   
                   
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Course Description </label>
                        <div class="col-sm-10">
                        <p class="mb-2" >{{$course['description']}}</p>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Duration </label>
                        <div class="col-sm-10">
                            
                            <p>{{$programLengths[$course['program_length']]['name']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Intake/Start Date  </label>
                            <div class="col-sm-10">
                                
                                @if($course['intake'])
                                <p>{{$intakes[$course['intake']]['name']}}</p>
                                @endif
                            </div>
                        </div>
                    <!-- <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Intake/Start Date  </label>
                        <div class="col-sm-10">
                        <input type="date" name="intake" class="mb-2 form-control" value="{{$course['intake']}}" required>
                        
                        </div>
                    </div> -->
                    
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Qualification </label>
                        <div class="col-sm-10">
                            <p>{{$qualifications[$course['qualification']]['name']}}</p>
                      
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Course Category </label>
                        <div class="col-sm-10">
                            <p>{{$subjects[$course['subject']]->name}}</p>
                       
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Title </label>
                        <div class="col-sm-10">
                            <p>{{$programTitles[$course['programTitle_id']]->name}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Course Level </label>
                        <div class="col-sm-10">
                            <p>{{$courseLevels[$course['course_level']]->name}}</p>
                       
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Work Exp Required?  </label>
                        <div class="col-sm-10">
                            <p>{{$course['workexp']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Internship/Co-Op Based ?  </label>
                        <div class="col-sm-10">
                            <p>{{$course['internship']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Highly Competitive ?  </label>
                        <div class="col-sm-10">
                            <p>{{$course['highlyCompetitive']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2"> Academic Requirement </label>
                        <div class="col-sm-10">
                            <p>{{$course['academicRequirement']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Tution Fee  </label>
                        <div class="col-sm-10">
                            <p>{{$course['tution_fee']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Application Fee  </label>
                        <div class="col-sm-10">
                            <p>{{$course['application_fee']}}</p>
                        </div>
                    </div>
                       
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Is IELTS </label>
                        <div class="col-sm-10">   
                            <p>{{$course['isIlets']}}</p>
                        
                        </div>
                    </div>
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">English Score </label>
                        <div class="col-sm-10">   
                            <p>{{$course['english_score']}}</p>
                        
                        </div>
                    </div>
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2"> Ilets Scores </label>
                        <div class="col-sm-10">    
                            <p>{{$course['ilets_score']}}</p>
                        </div>
                    </div>
                
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Scholarship </label>
                            <div class="col-sm-10">
                                <p><a href="{{$course['scholarship']}}">{{$course['scholarship']}}</a></p>
                            </div>
                    </div>    
                    <div class="">
                        <label>
                            Is Math
                        </label>
                        <p>{{$course['isMath']}}</p>
                    </div>
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Score In Maths </label>
                        <div class="col-sm-10">   
                                <p>{{$course['mathScore']}}</p> 
                        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Total Commission  </label>
                        <div class="col-sm-10">
                            <p>{{$course['total_commission']}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Agent Commission  </label>
                        <div class="col-sm-10">
                            <p>{{$course['agent_commission']}}</p>
                        </div>
                    </div>
                            <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Admission Overseas Cut </label>
                            <div class="col-sm-10">
                                <p>{{$course['admission_overseasCut']}}</p>
                           </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Processing Time </label>
                    <div class="col-sm-10">
                        <p>{{$course['processing_time']}}</p>
                     
                        </div>
                    </div>
                    <div class="form-group row">
                                <label for="input-id" class="col-sm-2">Note:- </label>
                            <div class="col-sm-10">
                                <p>{{$course['note']}}</p>
                            <input type="hidden" placeholder="" value="{{$college['id']}}" name="college_id" class="mb-2 form-control" >
                        </div>
                    </div>
                    <form method="POST" action="{{route('courses.verify')}}">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$course['id']}}">
                            @if(!$course['verify_by'])
                            <button type="submit" class="btn btn-success btn-sm">Verify</button>
                            @else
                            <p class="text-success btn-sm">Verified</p>
                            @endif
                            <a href="{{route('courses.index',base64_encode($college['id']))}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection