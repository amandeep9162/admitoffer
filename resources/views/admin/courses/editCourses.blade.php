@extends('admin.layouts.admin') 
@section('content')
<div class="app-page-title" style="margin: -30px 0px 30px;">
    <div class="page-title-wrapper">
        <div class="page-title-heading" >
            <div class="" style="margin: 0 30px 0 0;">
                
            </div>
            <div class="capitalize">{{$college['name']}}
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
                
                <div class="card-header ">Edit Course &nbsp;  
                    </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('courses.update',$course['id'])}}">
                    @csrf
                       
                    
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Course Name<span class="text-danger">*</span></label>
                        <div class="col-sm-10">    
                        <input type="text" placeholder="name" name="name" value="{{$course['name']}}" class="mb-2 form-control" required>
                        </div>
                    </div>   
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Program Weblink</label>
                        <div class="col-sm-10">    
                        <input type="text" placeholder="program link" name="program_weblink" value="{{$course['program_weblink']}}" class="mb-2 form-control" required>
                        </div>
                    </div>   
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Campus</label>
                        <div class="col-sm-10">    
                        <input type="text" placeholder="campus" name="institute_type" value="{{$course['institute_type']}}" class="mb-2 form-control" required>
                        </div>
                    </div>   
                   
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Program Description </label>
                        <div class="col-sm-10">
                        <textarea placeholder="description" name="description" class="mb-2 form-control" >{{$course['description']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Duration<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="Plength" required>
                                <option value=''> Select Length</option>
                                @foreach($programLengths as $programLength)
                                <option value="{{$programLength['id']}}" {{($course['program_length'] == $programLength['id'])  ? 'selected' : '' }}>{{$programLength['name']}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div> <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Duration Text<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text"  class="mb-2 form-control" name="duration_text" value="{{$course['durationText']}}" required>
                          
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Intake/Start Date <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control"  name="intake" required>
                                    <option value=''> Select Intake/Start Date </option>
                                    @foreach($intakes as $intake)
                                    <option value="{{$intake['id']}}"  @if($intake['id'] == $course['intake']) 
                                            selected 
                                        @endif > {{$intake['name']}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Intake Quarter <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control"  name="merge_intake_id" required>
                                    <option value=''> Select Quarter </option>
                                    @foreach($mergeIntakes as $mergeIntake)
                                    <option value="{{$mergeIntake['id']}}"  @if($mergeIntake['id'] == $course['merge_intake_id']) 
                                            selected 
                                        @endif > {{$mergeIntake['name']}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>

                    <!-- <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Intake/Start Date <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="date" name="intake" class="mb-2 form-control" value="{{$course['intake']}}" required>
                        
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Qualification<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="qualification" id="getQualification_id" required>
                            @foreach($qualifications as $qualification)
                            <option value="{{$qualification['id']}}" {{($course['qualification'] == $qualification['id'])  ? 'selected' : '' }}>{{$qualification['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Category<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="subject"  required>
                            @foreach($subjects as $subject)
                            <option value="{{$subject['id']}}"  {{($course['subject'] == $subject['id'])  ? 'selected' : '' }}>{{$subject['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Title </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="programTitle" >
                            @foreach($programTitles as $programTitle)
                            <option value="{{$programTitle['id']}}"  {{($course['programTitle_id'] == $programTitle['id'])  ? 'selected' : '' }}>{{$programTitle['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Course Level<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="courseLevel" required>
                            <option value=''> Select course level</option>
                            @foreach($courseLevels as $courseLevel)
                            <option value="{{$courseLevel['id']}}" {{($course['course_level'] == $courseLevel['id'])  ? 'selected' : '' }} >{{$courseLevel['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Work Exp Required? <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="radio" name="workexp"  value="yes" class="mb-2"  {{($course['workexp'] == 'yes')  ? 'checked' : '' }} >&nbsp;Yes&nbsp;&nbsp;
                        <input type="radio" name="workexp" value="no" class="mb-2" {{($course['workexp'] == 'no')  ? 'checked' : '' }} >&nbsp;No
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Internship/Co-Op Based ? <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="radio" name="internship"  value="yes" class="mb-2"  {{($course['internship'] == 'yes')  ? 'checked' : '' }} >&nbsp;Yes&nbsp;&nbsp;
                        <input type="radio" name="internship" value="no" class="mb-2" {{($course['internship'] == 'no')  ? 'checked' : '' }} >&nbsp;No
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Highly Competitive? <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="radio" name="highlyCompetitive"  value="yes" class="mb-2"  {{($course['highlyCompetitive'] == 'yes')  ? 'checked' : '' }} >&nbsp;YES&nbsp;&nbsp;
                        <input type="radio" name="highlyCompetitive"  value="no" class="mb-2"  {{($course['highlyCompetitive'] == 'no')  ? 'checked' : '' }} >&nbsp;No&nbsp;&nbsp;
                        
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Priority? <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="radio" name="priority"  value="1" class="mb-2"  {{($course['priority'] == '1')  ? 'checked' : '' }} >&nbsp;High&nbsp;&nbsp;
                        <input type="radio" name="priority"  value="2" class="mb-2"  {{($course['priority'] == '2')  ? 'checked' : '' }} >&nbsp;Medium&nbsp;&nbsp;
                        <input type="radio" name="priority" value="3" class="mb-2" {{($course['priority'] == '3')  ? 'checked' : '' }} >&nbsp;Low
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2"> Academic Requirement<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="text" name="academicRequirement"  value="{{$course['academicRequirement']}}" class="mb-2 form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Tution Fee <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="number" name="tutionFee" min="0"  value="{{$course['tution_fee']}}" class="mb-2 form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Application Fee <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                         <input type="number" name="applicationFee"  min="0"   value="{{$course['application_fee']}}" class="mb-2 form-control" required>
                        </div>
                    </div>
                        <div class="isItetsClass">
                            <label>

                                <input type="checkbox" name="isIlets" id="isIletsCheck"  class="mb-2 " value="yes" {{($course['isIlets'] == 'yes')  ? 'checked' : '' }} > <span> IELTS waiver ?</span>
                            </label>
                        </div>
                    <div id="isIletsShow" class="<?php if($course['isIlets'] != 'yes') { echo 'displayNone'; } ?>">
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">English Score<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">   
                        <select class="mb-2 form-control" name="englishScore"  >
                            <option value=''> Select English Scores</option>
                                @foreach($englishScores as $englishScore)
                                <option value="{{$englishScore['id']}}" {{($course['english_score'] == $englishScore['id'])  ? 'selected' : '' }}>{{$englishScore['score']}}</option>
                                @endforeach        
                            </select>
                        </div>
                        </div>
                    </div>
                   <div id="change_loc_old">
                                <div class="btn btn-info mrg-t-b-10" id="change_loc" >Change Location</div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Country<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Country" value="{{$course->countrys['name']}}"  class="mb-2 form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">State<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="State" value="{{$course->states['name']}}" class="mb-2 form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">City<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="hidden"  value="{{$course['city']}}" name="city_id"  id="cId" class="mb-2 form-control" readonly>
                                        <input type="text" placeholder="City" value="{{$course->citys['name']}}" class="mb-2 form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="select_change_loc">
                                <div class="btn btn-info mrg-t-b-10" id="prev_change_loc" >Back To Previous Location</div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Select Country<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <select class="mb-2 form-control" name="country_id" id="country_id" >
                                            <option value='' > Select country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country['id']}}"> {{$country['name']}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Select State<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <select class="mb-2 form-control" name="state_id" id="state_id"  >
                                            <option value='' > Select state</option>
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Select City<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <select class="mb-2 form-control"  id="city_id" >
                                            <option value='' > Select city</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2"> IELTS Scores<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">    
                            <select class="mb-2 form-control" name="iletsScore">
                             <option value=''> Select IELTS Score</option>
                                @foreach($iletsScores as $iletsScore)
                                @if($course['country'] == $iletsScore['country'])
                                <option value="{{$iletsScore['id']}}" {{($course['ilets_score'] == $iletsScore['id'])  ? 'selected' : '' }}>{{$iletsScore['name']}}</option>
                                @endif
                                @endforeach
                            </select>
                        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Program Status<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="Pstatus" required>
                                <option value=''> Select Program Status</option>
                                <option value='1' {{($course['program_status'] == '1')  ? 'selected' : '' }}>Open</option>
                                <option value='0' {{($course['program_status'] == '0')  ? 'selected' : '' }}>Close </option>
                                <option value='2' {{($course['program_status'] == '2')  ? 'selected' : '' }}>Waitlisted </option>
                            
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Delivery<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="Pdelivery" required>
                            <option value=''> Select Program Delivery</option>
                            <option value='1' {{($course['program_delivery'] == '1')  ? 'selected' : '' }}>Full Time</option>
                            <option value='2' {{($course['program_delivery'] == '2')  ? 'selected' : '' }}>Part Time</option>
                            
                        </select>
                        </div>
                    </div> -->
                <!--     <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Scholarship<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control">
                                    <option value=''> Select ScholarShip</option>
                                    <option value='1' {{($course['scholarship'] != '')  ? 'selected' : '' }}>Available</option>
                                    <option value='2' {{($course['scholarship'] == '2')  ? 'selected' : '' }}>Not Available </option>
                                    
                                </select>
                            </div>
                    </div>  -->   
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Scholarship Link </label>
                            <div class="col-sm-10">
                                <input type="text" class="mb-2 form-control" name="scholarship" value="{{$course['scholarship']}}" >
                            </div>
                    </div>    
                    <div class="isItetsClass">
                        <label>

                            <input type="checkbox" name="isMath" id="isMathCheck" value="yes" {{($course['isMath'] == 'yes')  ? 'checked' : '' }}  class="mb-2 " > <span> Maths Required?</span>
                        </label>
                    </div>
                    <div id="isMathShow" class="<?php if($course['isMath'] != 'yes') { echo 'displayNone'; } ?>">
                      
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Score In Maths<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">    
                             <select class="mb-2 form-control" name="mathScore" >
                                    <option value=''> Select Math Scores</option>
                                @foreach($mathScores as $mathScore)
                                    <option value="{{$mathScore['id']}}" {{($course['mathScore'] == $mathScore['id'])  ? 'selected' : '' }}>{{$mathScore['name']}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Total Commission <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="number"  min="0"  name="totalCommission"  value="{{$course['total_commission']}}" id="totalCommission" class="mb-2 form-control" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Agent Commission <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                         <input type="number"  min="0"  name="agentCommission" value="{{$course['agent_commission']}}" id="agentCommission" class="mb-2 form-control" required>
                        </div>
                    </div>
                            <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Admit Offer Overseas Cut </label>
                            <div class="col-sm-10">
                            <input type="number" name="admissionOverseasCut" id="admissionOverseasCut" value="{{$course['admission_overseasCut']}}" class="mb-2 form-control" readonly>
                           </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Processing Time<span class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <select class="mb-2 form-control" name="processingTime" required>
                            <option value=''> Select Processing Time</option>
                            <option value='15' {{($course['processing_time'] == '15')  ? 'selected' : '' }}>15</option>
                            <option value='30' {{($course['processing_time'] == '30')  ? 'selected' : '' }}>30</option>
                            <option value='45' {{($course['processing_time'] == '45')  ? 'selected' : '' }}>45 </option>
                            <option value='60' {{($course['processing_time'] == '50')  ? 'selected' : '' }}>60 </option>
                            <option value='75' {{($course['processing_time'] == '75')  ? 'selected' : '' }}>75 </option>
                            <option value='90' {{($course['processing_time'] == '90')  ? 'selected' : '' }}>90 </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                                <label for="input-id" class="col-sm-2">Additional Admission Requirements :-</label>
                            <div class="col-sm-10">
                                <textarea placeholder="note" name="note"  class="mb-2 form-control">{{$course['note']}}</textarea>
                            <input type="hidden" placeholder="" value="{{$college['id']}}" name="college_id" class="mb-2 form-control" >
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-8">
                            
                            <button type="submit" class="btn btn-info btn-sm">Save</button>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="{{route('courses.index',base64_encode($college['id']))}}" class="btn btn-sm btn-danger float-right">Back</a>
                        </div>
                        </div>
                    </form>
                    <div class="row">
                    <div class="col-md-12">
                            <form method="POST" action="{{route('courses.verify')}}">
                                @csrf
                                <input type="hidden" name="course_id" value="{{$course['id']}}">
                                @if(!$course['verify_by'])
                                <button type="submit" class="btn btn-success btn-sm text-center" style="width: 100%;padding: 20px;margin-top: 10px;">Verify</button>
                                @else
                                <p class="text-success btn-sm text-center">Verified</p>
                                @endif
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection