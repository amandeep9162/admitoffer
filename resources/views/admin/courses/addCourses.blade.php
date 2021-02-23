@extends('admin.layouts.admin') 
@section('content')
<div class="app-page-title" style="margin: -30px 0px 30px;">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
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
                
                <div class="card-header ">Add New Program </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('courses.store')}}">
                    @csrf
                    <input type="hidden" name="course_unique_id" value="{{strtoupper($college['ucode'])}}" class="mb-2 form-control" >
                           
                    <div class="form-group row">        
                        <label for="input-id" class=" col-sm-2">Program Name<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                        <input type="text" placeholder="name" name="name" value="{{ old('name') }}" class="mb-2 form-control" required>
                       
                        </div>
                    </div>
                    <div class="form-group row">        
                        <label for="input-id" class=" col-sm-2">Program Weblink</label>
                        <div class="col-sm-10">
                        <input type="text" placeholder="course link" name="program_weblink" style="text-transform: lowercase;" value="{{ old('program_weblink') }}" class="mb-2 form-control" required>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Program Description </label>
                        <div class="col-sm-10">
                        <textarea placeholder="description" name="description" value="{{ old('description') }}" class="mb-2 form-control" ></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Duration<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="Plength" required>
                                <option value=''> Select Length</option>
                                @foreach($programLengths as $programLength)
                                <option value="{{$programLength['id']}}">{{$programLength['name']}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Duration Text<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" class="mb-2 form-control" name="duration_text" required>
                        </div>
                    </div>
                    <div class="form-group row">   
                        <label for="input-id" class="col-sm-2">Campus</label>
                        <div class="col-sm-10">    
                        <input type="text" placeholder="Campus" name="institute_type"  class="mb-2 form-control" required>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Intake/Start Date <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control"  name="intake"  required>
                                <option value=''> Select Intake/Start Date </option>
                                @foreach($intakes as $intake)
                                <option value="{{$intake['id']}}">{{$intake['name']}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Intake Quarter <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control"  name="merge_intake_id"  required>
                                <option value=''> Select IQuarter </option>
                                @foreach($mergeIntakes as $mergeIntake)
                                <option value="{{$mergeIntake['id']}}">{{$mergeIntake['name']}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                     <div class="form-group row">      
                            <label for="input-id" class="col-sm-2">Select Country<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="country_id" id="country_id" required>
                                    <option value=''> Select country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}"> {{$country['name']}}</option>

                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">       
                        <label for="input-id" class="col-sm-2">Select State<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="state_id" id="state_id"  required>
                                <option value=''> Select state</option>
                            
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">    
                        <label for="input-id" class="col-sm-2">Select City<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="city_id" id="city_id"  required>
                                <option value=''> Select city</option>
                            
                            </select>
                        </div>
                    </div> 
                    <!-- <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Intake/Start Date <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="date" name="intake" class="mb-2 form-control" value="{{ old('intake') }}" required>
                        
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Level<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="qualification" id="getQualification_id" required>
                            <option value=''> Select Qualification</option>
                            @foreach($qualifications as $qualification)
                            <option value="{{$qualification['id']}}">{{$qualification['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Course Category<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <!-- <select class="mb-2 form-control" name="subject" id="getSubject_id"  required> -->
                        <select class="mb-2 form-control" name="subject"  required>
                            <option value=''> Select Category</option>
                            @foreach($subjects as $subject)
                            <option value="{{$subject['id']}}">{{$subject['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Title </label>
                        <div class="col-sm-10">
                        <!-- <select class="mb-2 form-control" name="subject" id="getSubject_id"  required> -->
                        <select class="mb-2 form-control" name="programTitle"  >
                            <option value=''> Select Title</option>
                            @foreach($programTitles as $programTitle)
                            <option value="{{$programTitle['id']}}">{{$programTitle['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Level<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="courseLevel" required>
                            <option value=''> Select course level</option>
                            @foreach($courseLevels as $courseLevel)
                            <option value="{{$courseLevel['id']}}">{{$courseLevel['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Work Exp Required? <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                            <input type="radio" name="workexp"  value="yes" class="mb-2" >&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" name="workexp" value="no" class="mb-2" >&nbsp;No
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Internship/Co-Op Based ? <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                            <input type="radio" name="internship"  value="yes" class="mb-2" >&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" name="internship" value="no" class="mb-2" >&nbsp;No
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Highly Competitive ? <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                            <input type="radio" name="highlyCompetitive"  value="yes" class="mb-2" >&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" name="highlyCompetitive" value="no" class="mb-2" >&nbsp;No
                            
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Priority ? <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                            <input type="radio" name="priority"  value="1" class="mb-2" >&nbsp;High&nbsp;&nbsp;
                            <input type="radio" name="priority" value="2" class="mb-2" >&nbsp;Medium
                            <input type="radio" name="priority" value="3" class="mb-2" >&nbsp;Low
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2"> Academic Requirement<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                            <input type="text" name="academicRequirement" class="mb-2 form-control" required>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Tution Fee <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="number" name="tutionFee" min="0" value="{{ old('tutionFee') }}" class="mb-2 form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Application Fee <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="number" name="applicationFee" value="{{ old('applicationFee') }}"  min="0" class="mb-2 form-control" required>
                        <div class="isItetsClass">
                            <label>

                                <input type="checkbox" name="isIlets" id="isIletsCheck"  class="mb-2 " value="yes" > <span> IELTS waiver ?</span>
                            </label>
                        </div>
                        <div id="isIletsShow" class="displayNone">
                            <div class="form-group row">    
                                <!-- <label for="input-id" class=" col-sm-2">Ilets Score<span class="text-danger">*</span> </label> -->
                                <div class="col-sm-12">
                                   <select class="mb-2 form-control" name="englishScore" >
                                        <option value=''> Select English Scores</option>
                                        @foreach($englishScores as $englishScore)

                                        <option value="{{$englishScore['id']}}">{{$englishScore['score']}}</option>
                                        @endforeach    
                                        
                                    </select>
                                    <div id="isEScoreHide" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2"> IELTS Scores<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="iletsScore" >
                                <option value=''> Select IELTS Score</option>
                                @foreach($iletsScores as $iletsScore)
                                @if($college['country_id'] == $iletsScore['country'])
                                <option value="{{$iletsScore['id']}}">{{$iletsScore['name']}}</option>
                                @endif
                                @endforeach
                            
                        </select>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Status<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="Pstatus" required>
                            <option value=''> Select Program Status</option>
                            <option value='1'>Open</option>
                            <option value='0'>Close </option>
                            <option value='2'>Waitlisted </option>
                            
                        </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Program Delivery<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="Pdelivery" required>
                                <option value=''> Select Program Delivery</option>
                                <option value='1'>Full Time</option>
                                <option value='2'>Part Time</option>
                                
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Scholarship </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="scholarshipType" required>
                                <option value=''> Select ScholarShip</option>
                                <option value='1'>Available</option>
                                <option value='2'>Not Available </option>
                                
                            </select>
                       </div>     
                    </div>     
                    <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Scholarship Link </label>
                        <div class="col-sm-10">
                            <input type="text" class="mb-2 form-control" name="scholarship" >
                               
                            <div class="isItetsClass">
                                <label>

                                    <input type="checkbox" name="isMath" id="isMathCheck"  class="mb-2 " value="yes" > <span> Maths Required?</span>
                                </label>
                            </div>
                            <div id="isMathShow" class="displayNone">
                                <div class="form-group row">    
                                    <!-- <label for="input-id" class=" col-sm-2">Score In Maths<span class="text-danger">*</span> </label> -->
                                    <div class="col-sm-12">
                                    <select class="mb-2 form-control" name="mathScore" >
                                            <option value=''> Select Math Scores</option>
                                        @foreach($mathScores as $mathScore)
                                            <option value="{{$mathScore['id']}}">{{$mathScore['name']}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Total Commission <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="number"  min="0" name="totalCommission" value="{{ old('totalCommission') }}" id="totalCommission" class="mb-2 form-control" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Agent Commission <span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <input type="number"  min="0" name="agentCommission" value="{{ old('agentCommission') }}" id="agentCommission" class="mb-2 form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Admit Offer Cut </label>
                        <div class="col-sm-10">
                        <input type="number" name="admissionOverseasCut" value="{{ old('admissionOverseasCut') }}" id="admissionOverseasCut" class="mb-2 form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Processing Time<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="processingTime" required>
                            <option value=''> Select Processing Time</option>
                            <option value='15'>15</option>
                            <option value='30'>30</option>
                            <option value='45'>45 </option>
                            <option value='60'>60 </option>
                            <option value='75'>75 </option>
                            <option value='90'>90 </option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Additional Admission Requirements </label>
                        <div class="col-sm-10">
                            <textarea placeholder="Additional Admission Requirements" name="note" class="mb-2 form-control" value="{{ old('note') }}" ></textarea>
                            <input type="hidden" placeholder="" value="{{$collegeId}}" name="college_id" class="mb-2 form-control" >
                        </div>
                    </div>
                            <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('courses.index',base64_encode($college['id']))}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection