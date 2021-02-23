<?php
$studentUser =Auth::guard('student')->check();
?>

@extends(($studentUser === false) ? 'agent.layouts.app' : 'applicant.layouts.app')

@section('content')

<div class="container-fluid addNewStudent">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12">
                    <div class="row">
                        @if($isEdit == 'yes')
                        <div class="col-md-12 card-header  tabs-border-right ">Edit Student</div>
                        @else    
                        <div class="col-md-12 card-header  tabs-border-right ">Add New Student</div>
                        @endif    
                    </div>
                </div>
                <div class="card-body" id="formTab">
                    <div id="validation-errors">
                    </div>
                    <!-- start -->
                    <div id="accordion" class=" accordion-wrapper mb-3  col-md-12">
                        <div class="card ">
                            <div id="headingOne" class="card-header ">
                                <button type="button" data-toggle="collapse" data-target="#collapseOnePe" aria-expanded="true" aria-controls="collapseOnePe" class="text-left m-0 p-0 btn btn-link btn-block collapsed ">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps"> 1</span>Personal Details</h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOnePe" aria-expanded="true" aria-controls="collapseOnePe" class="collapsed plusicon">
                                    <i class="fa fa-plus "></i>
                                </div>
                            </div>
                            <form method="POST" id="studentForm"  enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <input type="hidden" name="studentId" id="studentId" value="{{$data['id']}}">
                                <div data-parent="#accordion" id="collapseOnePe" aria-labelledby="headingOne" class="collapse step1 {{ Session::get('openNext') == 'openNextSession' ? 'hide' : 'show openSession' }} " style="">
                                    <div class="senSecImg ">
                                        <br>
                                        <div class="row">
                                            <div class="form-group col-md-2 ">
                                                <div class="row mb-2">
                                                    <!-- <label for="input-id" class="col-sm-5">&nbsp;</label> -->
                                                    <div class="col-sm-12" style="text-align: -webkit-center;">
                                                        <div class="blahSize displayBlock" style="width:100%;height:100%">
                                                            @if($data)
                                                            @if($data->studentImage)
                                                            <img class="blah" src="{{asset($data->studentImage['path'].'/'.$data->studentImage['name'])}}" alt="your image" />
                                                            @else
                                                            <img class="blah" src="{{asset('images/site/user-img.png')}}" alt="your image" />
                                                            @endif
                                                            @else
                                                            <img class="blah" src="{{asset('images/site/user-img.png')}}" alt="your image" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <label for="input-id" class="col-sm-5">Upload Student Image </label> -->
                                                    <div class="col-sm-12 text-center"> 
                                                        <label class="btn btn-warning btn-default-color">
                                                        Upload Student Image
                                                        <input type="file" name="image" class="mb-2 hide form-control imgInp " id="studentImage" >
                                                        </label>
                                                    </div>
                                                    <span class="text-center imgEr"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <label for="name" class="col-sm-3 hide">{{ __('Student ID') }}</label>
                                                        <div class="col-sm-9"> 
                                                            <input type="hidden" class="mb-2 form-control margin-right-30" id="studentUniqueId" value="{{$data['student_unique_id']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <label for="name" class="col-sm-3">{{ __('Title') }}<span class="text-danger">*</span></label>
                                                        <div class="col-sm-9">    
                                                            <select class="mb-2 form-control margin-right-30" name="title">
                                                            <option value="" >Select Title</option>
                                                            <option value="Mr" {{($data['title'] == 'Mr') ? 'selected' : ''}}>Mr</option>
                                                            <option value="Miss" {{($data['title'] == 'Miss') ? 'selected' : ''}}>Miss</option>
                                                            <option value="Mrs" {{($data['title'] == 'Mrs') ? 'selected' : ''}}>Mrs</option>
                                                            <option value="Mrs" {{($data['title'] == 'Ms') ? 'selected' : ''}}>Ms</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row senSecImg">
                                                    <label for="name" class="col-sm-3">{{ __('First Name') }}<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">    
                                                        <input id="name" type="text" class="mb-2 margin-right-30 form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{$data['firstName']}}" required autofocus>
                                                        @if ($errors->has('firstName'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('firstName') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row senSecImg">
                                                    <label for="middleName" class="col-sm-3">{{ __('Middle Name') }}<span class="text-danger"></span></label>
                                                    <div class="col-sm-9">    
                                                        <input id="middleName" type="text" class="mb-2 margin-right-30 form-control{{ $errors->has('middleName') ? ' is-invalid' : '' }}" name="middleName" value="{{$data['middleName']}}" requ>
                                                        @if ($errors->has('middleName'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('middleName') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row senSecImg">
                                                    <label for="name" class="col-sm-3">{{ __('Last Name') }}<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">    
                                                        <input id="name" type="text" class="mb-2 margin-right-30 form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{$data['lastName']}}" required autofocus>
                                                        @if ($errors->has('lastName'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lastName') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="email" class="col-sm-4">{{ __('Email') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input id="email" type="email" class=" mb-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$data['email']}}" required>
                                                                @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="mobile" class="col-sm-4">{{ __('Mobile No') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input id="mobile" type="number" class="mb-2 form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{$data['mobileNo']}}" required>
                                                                @if ($errors->has('mobile'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('mobile') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="gender" class="col-sm-4">{{ __('Gender') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <label class="containerRadio">Male
                                                                        <input id="gender" type="radio" class="mb-2 displayNone" name="gender" {{($data['gender'] == 'male') ? 'checked' : ''}} value="male" >    
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <label class="containerRadio">Female
                                                                        <input id="gender" type="radio" class="mb-2 displayNone" name="gender" {{($data['gender'] == 'female') ? 'checked' : ''}} value="female" >    
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="maritalStatus" class="col-sm-4">{{ __('Marital Status') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8 ">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <label class="containerRadio">Single
                                                                        <input id="maritalStatus" type="radio" class="mb-2 displayNone" name="maritalStatus" {{($data['maritalStatus'] == 'yes') ? 'checked' : ''}} value="yes" >  
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <label class="containerRadio">Married
                                                                        <input id="maritalStatus" type="radio" class="mb-2 displayNone" name="maritalStatus" {{($data['maritalStatus'] == 'no') ? 'checked' : ''}} value="no" >    
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <!-- <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="firstLanguage" class="col-sm-4">{{ __('First Language') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input id="firstLanguage" type="text" class="mb-2 form-control{{ $errors->has('firstLanguage') ? ' is-invalid' : '' }}" name="firstLanguage" value="{{$data['firstLanguage']}}" required autofocus>
                                                                @if ($errors->has('firstLanguage'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('firstLanguage') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <!-- <div class="row">
                                                    <label for="phone" class="col-sm-4">{{ __('Phone No.') }}</label>
                                                    <div class="col-sm-8">    
                                                        <input id="phone" type="number" class="mb-2 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{$data['phoneNo']}}" required autofocus>
                                                        @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>    
                                                    </div> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="skypeId" class="col-sm-4">{{ __('Skype ID') }}</label>
                                                            <div class="col-sm-8">    
                                                                <input id="skypeId" type="text" class="mb-2 form-control{{ $errors->has('skypeId') ? ' is-invalid' : '' }}" name="skypeId" value="{{$data['skypeId']}}" required>
                                                                @if ($errors->has('skypeId'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('skypeId') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="dateOfbirth" class="col-sm-4">{{ __('Date Of Birth') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input  type="text" class=" datepickerOfbirth mb-2 form-control{{ $errors->has('dateOfBirth') ? ' is-invalid' : '' }}" name="dateOfBirth" value="{{$data['dateOfBirth']}}" required readonly >
                                                                @if ($errors->has('dateOfBirth'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="passportNo" class="col-sm-4">{{ __('Passport No.') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input id="passportNo" type="text" class="mb-2 form-control{{ $errors->has('passportNo') ? ' is-invalid' : '' }}" name="passportNo" value="{{$data['passportNo']}}" required>
                                                                @if ($errors->has('passportNo'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('passportNo') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                               <!--  <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                                <input type="hidden" name="currentDate" class="currentDate" value="{{date('Y/m/d')}}">
                                                            <label for="passportIssueDate" class="col-sm-4">{{ __('Passport Issue date') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input id="passportIssueDate" type="text" class="Issuedatepicker mb-2 form-control{{ $errors->has('passportIssueDate') ? ' is-invalid' : '' }}" name="passportIssueDate" value="{{$data['passportIssueDate']}}" required readonly >
                                                                @if ($errors->has('passportIssueDate'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('passportIssueDate') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="passportExpiryDate" class="col-sm-4">{{ __('Passport Expiry Date') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <input id="passportExpiryDate" type="text" class="Expdatepicker mb-2 form-control{{ $errors->has('passportExpiryDate') ? ' is-invalid' : '' }}" name="passportExpiryDate" value="{{$data['passportExpiryDate']}}" required readonly >
                                                                @if ($errors->has('passportExpiryDate'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('passportExpiryDate') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="prequal" class="col-sm-4">{{ __('Previous Qualification') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <select id="prequal" class="mb-2  form-control{{ $errors->has('previousQualification') ? ' is-invalid' : '' }}" name="previousQualification" required>
                                                                <option value="" >Select Previous Qualification</option>
                                                                @foreach($PreviousQualifications as $PreviousQualification)
                                                                <option value="{{$PreviousQualification['id']}}" {{($data['previousQualification'] == $PreviousQualification['id']) ? 'selected' : ''}}>{{$PreviousQualification['name']}}</option>
                                                                @endforeach
                                                                </select>
                                                                @if ($errors->has('previousQualification'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('previousQualification') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                       <div class="col-md-6 ">
                                                        <div class="row">
                                                            <label for="input-id" class="col-sm-4">Applying For Country<span class="text-danger">*</span> </label>
                                                            <div class="col-sm-8">
                                                                <select class="mb-2 form-control country_id afterCheckHide" name="apply_country_id"  {{ Session::get('openNext') == 'openNextSession' ? 'disabled' : '' }} required>
                                                                <option value=''> Select country</option>
                                                                @foreach($countries as $country)
                                                                @if($country['applyFor'] == '1')
                                                                    @if(in_array($country['id'],$agentAllowCountry))
                                                                    <option value="{{$country['id']}}" {{($data['applingForCountry'] == $country['id']) ? 'selected' : ''}} >{{$country['name']}}</option>
                                                                    @endif
                                                                @endif
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                                <div class="row " >
                                                    <div class="col-md-6 ">
                                                        <div class="row {{($data['applingForCountry'] == '230') ? '' : 'hide'}}" id="engScoreShow">
                                                            <label for="prequal" class="col-sm-4">{{ __('English 12th Score') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">    
                                                                <select id="prequal" class="mb-2 form-control{{ $errors->has('previousQualification') ? ' is-invalid' : '' }}" name="englishScores" required>
                                                                <option value="" >Select English Score</option>
                                                                @foreach($englishScores as $englishScore)
                                                                <option value="{{$englishScore['id']}}" {{($data['englishScore'] == $englishScore['id']) ? 'selected' : ''}}>{{$englishScore['score']}}</option>
                                                                @endforeach
                                                                </select>
                                                                @if ($errors->has('englishScores'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('englishScores') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 float-right"  >
                                                        <div class="row">
                                                            <label for="input-id" class="col-sm-4">Applying for Course Level<span class="text-danger"><small> (Select country before course level)</small> *</span> </label>
                                                            <div class="col-sm-8">
                                                                <select class="mb-2 form-control afterCheckHide qualificationLvl" name="apply_qualification_level" id="qualification_id"  {{ Session::get('openNext') == 'openNextSession' ? 'disabled' : '' }} required>
                                                                <option value=''> Select Qualification</option>
                                                                @foreach($qualifications as $qualification)
                                                                <option value="{{$qualification['id']}}" {{($data['applingForLevel'] == $qualification['id']) ? 'selected' : ''}}> {{$qualification['name']}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-md-6 ">
                                                        <div class="row">
                                                            <label for="input-id" class="col-sm-4">Math 12th Score (optional)</label>
                                                            <div class="col-sm-8">
                                                                <select class="mb-2 form-control  " name="mathScore"  >
                                                                <option value=''> Select Math Score</option>
                                                                @foreach($mathScores as $mathScore)
                                                                
                                                                <option value="{{$mathScore['id']}}" {{($data['mathScore'] == $mathScore['id']) ? 'selected' : ''}} > {{$mathScore['name']}}</option>
                                                                
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label for="status" class="col-sm-4">{{ __('Residence Status') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <div class="row {{ Session::get('openNext') == 'openNextSession' ? 'hide' : '' }}">
                                                                    <div class="col-sm-6 ">
                                                                        <label class="containerRadio ">On Shore <small>(Apply For Same Country)</small>
                                                                        <input id="status" type="radio" class="mb-2 displayNone afterCheckHide " name="status" {{($data['status'] == 'on') ? 'checked' : ''}} value="on" {{ Session::get('openNext') == 'openNextSession' ? 'disabled' : '' }} ><label>&nbsp;</label>
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-6 ">
                                                                        <label class="containerRadio">Off Shore <small>(Apply For Other Country)</small>
                                                                        <input id="status" type="radio" class="mb-2 displayNone afterCheckHide " name="status" {{($data['status'] == 'off') ? 'checked' : ''}} value="off" {{ Session::get('openNext') == 'openNextSession' ? 'disabled' : '' }} ><label>&nbsp;</label>
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="row {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide' }}">
                                                                    <div class="col-sm-6 {{($data['status'] == 'on') ? 'show' : 'hide'}} ">
                                                                        On Shore <small>(Apllying within UK)</small>
                                                                    </div>
                                                                    <div class="col-sm-6 {{($data['status'] == 'off') ? 'show' : 'hide'}}">
                                                                        Off Shore <small>(Applying from overseas)</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-md-6 ">
                                                        <div class="row">
                                                            <label for="input-id" class="col-sm-4">Applying for Course Category<span class="text-danger">*</span> </label>
                                                            <div class="col-sm-8">
                                                                <select class="mb-2 form-control" name="category" id="category"   required>
                                                                    <option value=''> Select Category</option>
                                                                    @foreach($subjects as $subject)
                                                                    <option value="{{$subject['id']}}" {{($data['category'] == $subject['id']) ? 'selected' : ''}}> {{$subject['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="row">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       <!--  <div class="row">
                                            <div class="col-md-12 ">
                                                <h6><b>Current/Mailing Address </b></h6>
                                                <br>
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <div class="form-group col-md-4">
                                                <div class="row ">
                                                    <label for="input-id" class="col-sm-5">Select Country<span class="text-danger">*</span> </label>
                                                    <div class="col-sm-7">
                                                        <select class="mb-2 form-control " name="mailing_country_id" id='country_id'  required>
                                                            <option value=''> Select country</option>
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['id']}}" {{($data['country_id'] == $country['id']) ? 'selected' : ''}} > {{$country['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="row">
                                                    <label for="input-id" class="col-sm-5">Select State<span class="text-danger">*</span> </label>
                                                    <div class="col-sm-7">
                                                        <select class="mb-2 form-control" name="mailing_state_id" id="state_id"  required>
                                                            <option value=''> Select state</option>
                                                            @foreach($states as $state)
                                                            <option value="{{$state['id']}}"  {{($data['state_id'] == $state['id']) ? 'selected' : ''}}> {{$state['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class=" row">
                                                    <label for="input-id" class="col-sm-5">Select City<span class="text-danger">*</span> </label>
                                                    <div class="col-sm-7">
                                                        <select class="mb-2 form-control" name="mailing_city_id" id="city_id"  required>
                                                            <option value=''> Select city</option>
                                                            @foreach($cities as $city)
                                                            <option value="{{$city['id']}}"  {{($city['id']) == $data['city_id'] ? 'selected' : ''}}> {{$city['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="form-group col-md-4">
                                                <div class=" row">
                                                    <label for="nationality" class="col-sm-5">Nationality<span class="text-danger">*</span></label>
                                                    <div class="col-sm-7">
                                                        <select class="mb-2 form-control" name="nationality_country_id"  required>
                                                            <option value=''> Select Nationality</option>
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['id']}}" {{($data['nationality'] == $country['id']) ? 'selected' : ''}}> {{$country['nationality']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class=" row">
                                                    <label for="birthCountry" class="col-sm-5">Country of Birth<span class="text-danger">*</span></label>
                                                    <div class="col-sm-7">
                                                        <select class="mb-2 form-control" name="birth_country_id"  required>
                                                            <option value=''> Select country</option>
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['id']}}" {{($data['countryOfBirth'] == $country['id']) ? 'selected' : ''}}> {{$country['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class=" row">
                                                    <label for="zipCode" class="col-sm-5">Zip/Pin<span class="text-danger">*</span></label>
                                                    <div class="col-sm-7"> 
                                                        <input id="zipCode" type="text" class="mb-2 form-control{{ $errors->has('zipCode') ? ' is-invalid' : '' }}" name="zipCode" value="{{$data['zipCode']}}" required>
                                                        @if ($errors->has('zipCode'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('zipCode') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="address" class="col-sm-2">Address<span class="text-danger">*</span></label>
                                                <div class="col-sm-10"> 
                                                    <input id="address" type="text" placeholder="Add Permanent Address" class="margin-right-30 mb-2 form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$data['address']}}" required>
                                                    @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="detail" class="col-sm-2">Additional Details</label>
                                            <div class="col-sm-10"> 
                                                <textarea name="detail" class="mb-2 margin-right-30 form-control{{ $errors->has('detail') ? ' is-invalid' : '' }}">{{$data['detail']}}</textarea>
                                            </div>
                                        </div> -->
                                        <div class="form-group row {{ Session::get('openNext') == 'openNextSession' ? 'hide' : 'show openSession' }}">
                                            <div class="col-md-12 text-center">
                                                <a href="javascript:;" class="btn btn-info btn-sm confirmBasicDetail" >Save</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="accordion" class=" accordion-wrapper {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }} mb-3 col-md-12">
                        <div class="card">
                            <div id="headingOne" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOneQ" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed OtherCollap">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps"> 2</span>Qualification <small class="docPdftext" >(Please detail student's 10th, 12th, degree qualifications)</small></h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOneQ" aria-expanded="false" aria-controls="collapseOne" class="collapsed plusicon">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div data-parent="#accordion" id="collapseOneQ" aria-labelledby="headingOne" class="collapse step2 " style="">
                                <div class="senSecImg" >
                                    <br>
                                    <div id='appendQual'>
                                        @if($studentQualifications->count()>0)
                                        <table class="mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Qualification</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="appendQual">
                                                @foreach($studentQualifications as $key=> $studentQualification)
                                                <tr class="removeQualificationEditclass{{$studentQualification['id']}}">
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td >{{$studentQualification->qualification['qualification_grade']}}</td>
                                                    <td>{{$studentQualification['from']}}</td>
                                                    <td>{{$studentQualification['to']}}</td>
                                                    <td>{{$studentQualification->totals['name']}} <span class="capitalize"><small>({{$studentQualification->totals['type']}})</small></span></td>
                                                    <td><button class="btn btn-danger minus" data-id type="button"  onclick="remove_qualification_Edit_fields({{$studentQualification['id']}});"> <i class="fa fa-minus" aria-hidden="true"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                    <div class="qualificatioinWithoutJSAddMore text-center {{ $studentQualifications->count() > 0 ? 'show' : 'hide' }}">
                                        <hr>
                                        <button class=" btn btn-success text-center mb-2"><i class="fa fa-plus"></i> Add More Qualification</button><br>
                                    </div>
                                    <form method="POST" id="qualification_fieldsAddMore" class="studentQualificationForm qualification_fieldsData removeQualificationclass1 {{ $studentQualifications->count() > 0 ? 'hide' : 'show' }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row pad-border qualificationParent qualificationGet">
                                            <div class="col-sm-6 nopadding">
                                                <div class="form-group">
                                                    <label>Qualification </label><span class="text-danger">*</span>
                                                    <select class="form-control gradeClass" id="educationDate" name="qualificationGrade">
                                                        <option value="">Select Qualification Name</option>
                                                    </select>
                                                </div>
                                            </div>
                                           <div class="col-sm-6 nopadding">
                                                <div class="form-group">
                                                    <label>From</label><span class="text-danger">*</span><input type="text" class="datepicker form-control" name="qualification_from_date" value="" placeholder="From" readonly >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nopadding">
                                                <div class="form-group">
                                                    <label>To</label><span class="text-danger">*</span> <input type="text" class="datepicker form-control" name="qualification_to_date" value="" placeholder="To" readonly >
                                                </div>
                                            </div>
                                           
                                            <div class="col-sm-6 nopadding">
                                                <div class="form-group">
                                                    <label>Total Percentage</label><span class="text-danger">*</span>
                                                    <div class="input-group">
                                                        <select class="form-control resultOpt" name="qualification_total">
                                                            <option value="">Select Qualification Result</option>
                                                            <optgroup label="Percentage">
                                                                @foreach($qualificationPercentages as $qualificationPercentage)
                                                                <option value="{{$qualificationPercentage['id']}}">{{$qualificationPercentage['name']}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                            <optgroup label="Division">
                                                                    @foreach($qualificationDivisions as $qualificationDivision)
                                                                    <option value="{{$qualificationDivision['id']}}">{{$qualificationDivision['name']}}</option>
                                                                    @endforeach
                                                            </optgroup>
                                                            <optgroup label="GPA">
                                                                    @foreach($qualificationGpas as $qualificationGpa)
                                                                    <option value="{{$qualificationGpa['id']}}">{{$qualificationGpa['name']}}</option>
                                                                    @endforeach
                                                            </optgroup>
                                                          
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <label>&nbsp;</label>
                                                            <input type="hidden" class="RstudentQualification1">
                                                            <button class="btn btn-danger hide minus" data-id type="button"  onclick="remove_qualification_fields(1);"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 nopadding">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-btn margin-top-20 text-center width-100">
                                                            <button class="btn btn-info" type="submit"  > Save Qualification</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="qualificatioinAddMore text-center hide">
                                        <hr>
                                        <button class=" btn btn-success text-center mb-2"><i class="fa fa-plus"></i> Add More Qualification</button><br>
                                    </div>
                                    <div id="qualification_fields" class="hide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="step3 accordion-wrapper {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }} mb-3 col-md-12">
                        <div class="card">
                            <div id="headingOne" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOneT" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed OtherCollap">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps"> 3</span> English Qualification Tests 
                                        @if($data['applingForCountry'] == '230')<small class="docPdftext">(optional)</small>@endif</h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOneT" aria-expanded="false" aria-controls="collapseOne" class="collapsed plusicon">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div data-parent="#accordion" id="collapseOneT" aria-labelledby="headingOne" class="collapse" style="">
                                <div class="senSecImg">
                                    <div class="senSecImg" id='appendQualTest'>
                                        <br>
                                        @if($studentEnglishTests->count()>0)
                                        <table class="mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Test</th>
                                                    
                                                    <th>Over All</th>
                                                    <!-- <th>TScore</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="appendQualTest">
                                                @foreach($studentEnglishTests as $key=> $studentEnglishTest)
                                                <tr class="removeEditTestclass{{$studentEnglishTest['id']}}">
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td >{{$studentEnglishTest->englishTests['name']}}</td>
                                                    
                                                    <td>{{$studentEnglishTest['overAll']}}</td>
                                                    <!-- <td>{{$studentEnglishTest->totalScores['score']}}</td> -->
                                                    <td><button class="btn btn-danger minus" data-id type="button"  onclick="remove_edit_test_fields({{$studentEnglishTest['id']}});"> <i class="fa fa-minus" aria-hidden="true"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                    <div class="englishAfterAddMore text-center {{ $studentEnglishTests->count() > 0 ? 'show' : 'hide' }}">
                                        <hr>
                                        <button class=" btn btn-success text-center mb-2"><i class="fa fa-plus"></i> Add More English Test</button>
                                    </div>
                                    <form method="POST" id="test_AfterSavefields"  class="test_fields removeTestclass1 {{ $studentEnglishTests->count() > 0 ? 'hide' : 'show' }}">
                                        <div class="row pad-border testFields">
                                            <div class="col-sm-6 nopadding showtest">
                                                <div class="form-group">
                                                    <label>Test</label>
                                                    <select class="form-control englishDate onChangeTest "  name="testName" >
                                                        <option value="">Select Test</option>
                                                    </select>
                                                </div>
                                            </div>
                                          
                                            <div class="col-sm-6 nopadding ">
                                                <div class="form-group">
                                                    <label>Overall</label>
                                                    <select class="form-control"  name="overall" >
                                                        <option value="">Select Overall Score</option>
                                                        <option value="4">4</option>
                                                        <option value="4.5">4.5</option>
                                                        <option value="5">5</option>
                                                        <option value="5.5">5.5</option>
                                                        <option value="6">6</option>
                                                        <option value="6.5">6.5</option>
                                                        <option value="7">7</option>
                                                        <option value="7.5">7.5</option>
                                                        <option value="8">8</option>
                                                        <option value="8.5">8.5</option>
                                                        <option value="9">9</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 hide PTEScore">
                                                <div class="form-group">
                                                    <label>Overall</label>
                                                    <select class="form-control PTEScoreSelect" >
                                                        <option value="">Select Overall Score</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                        <option value="35">33</option>
                                                        <option value="34">34</option>
                                                        <option value="35">35</option>
                                                        <option value="36">36</option>
                                                        <option value="37">37</option>
                                                        <option value="38">38</option>
                                                        <option value="39">39</option>
                                                        <option value="40">40</option>
                                                        <option value="41">41</option>
                                                        <option value="42">42</option>
                                                        <option value="43">43</option>
                                                        <option value="44">44</option>
                                                        <option value="45">45</option>
                                                        <option value="46">46</option>
                                                        <option value="47">47</option>
                                                        <option value="48">48</option>
                                                        <option value="49">49</option>
                                                        <option value="50">50</option>
                                                        <option value="51">51</option>
                                                        <option value="52">52</option>
                                                        <option value="53">53</option>
                                                        <option value="54">54</option>
                                                        <option value="55">55</option>
                                                        <option value="56">56</option>
                                                        <option value="57">57</option>
                                                        <option value="58">58</option>
                                                        <option value="59">59</option>
                                                        <option value="60">60</option>
                                                        <option value="61">61</option>
                                                        <option value="62">62</option>
                                                        <option value="63">63</option>
                                                        <option value="64">64</option>
                                                        <option value="65">65</option>
                                                        <option value="66">66</option>
                                                        <option value="67">67</option>
                                                        <option value="68">68</option>
                                                        <option value="69">69</option>
                                                        <option value="70">70</option>
                                                        <option value="71">71</option>
                                                        <option value="72">72</option>
                                                        <option value="73">73</option>
                                                        <option value="74">74</option>
                                                        <option value="75">75</option>
                                                        <option value="76">76</option>
                                                        <option value="77">77</option>
                                                        <option value="78">78</option>
                                                        <option value="79">79</option>
                                                        <option value="80">80</option>
                                                        <option value="81">81</option>
                                                        <option value="82">82</option>
                                                        <option value="83">83</option>
                                                        <option value="84">84</option>
                                                        <option value="85">85</option>
                                                        <option value="86">86</option>
                                                        <option value="87">87</option>
                                                        <option value="88">88</option>
                                                        <option value="89">89</option>
                                                        <option value="90">90</option>
                                                        <option value="91">91</option>
                                                        <option value="92">92</option>
                                                        <option value="93">93</option>
                                                        <option value="94">94</option>
                                                        <option value="95">95</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nopadding showtest">
                                                <div class="form-group">
                                                    <label>Total Score</label>
                                                    <div class="input-group">
                                                        <select class="form-control iletsScore"  name="totalIletsScore" id="totalScore" required>
                                                            <option value="">Select Total Score</option>
                                                            @foreach($iletsScores as $iletsScore)
                                                                @if($data['applingForCountry'] == $iletsScore['country'])
                                                                <option value="{{$iletsScore['id']}}">{{$iletsScore['name']}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <input type="hidden" class="RstudentQualificationTest1">
                                                            <button class="btn btn-danger hide minus" type="button"  onclick="remove_test_fields(1);"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 nopadding showtest">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-btn text-center width-100">
                                                            <button class="btn btn-info" type="submit"  > Save English Test </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="englishAddMore text-center hide">
                                        <hr>
                                        <button class=" btn btn-success text-center mb-2"><i class="fa fa-plus"></i> Add More English Test</button>
                                    </div>
                                    <div id="test_fields" class="hide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="step4 accordion-wrapper {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }} mb-3 col-md-12">
                        <div class="card">
                            <div id="headingOne" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOneW" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed OtherCollap">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps"> 4</span>Work Experience <small class="docPdftext">(optional)</small></h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOneW" aria-expanded="false" aria-controls="collapseOne" class=" collapsed plusicon">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div data-parent="#accordion" id="collapseOneW" aria-labelledby="headingOne" class="collapse" style="">
                                <div class="senSecImg ">
                                    <br>
                                    <div id="WorkExperiancesAppend">
                                        @if($studentWorkExperiances->count()>0)
                                        <table class="mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Organization</th>
                                                    <th>Designation</th>
                                                    <th>From Date</th>
                                                    <th>To Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="WorkExperiancesAppend">
                                                @foreach($studentWorkExperiances as $key=> $studentWorkExperiance)
                                                <tr class="removeEditclass{{$studentWorkExperiance['id']}}">
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td >{{$studentWorkExperiance['organization']}}</td>
                                                    <td>{{$studentWorkExperiance['designation']}}</td>
                                                    <td>{{$studentWorkExperiance['fromDate']}}</td>
                                                    <td>{{$studentWorkExperiance['toDate']}}</td>
                                                    <td><button class="btn btn-danger minus" data-id type="button"  onclick="remove_Edit_education_fields({{$studentWorkExperiance['id']}});"> <i class="fa fa-minus" aria-hidden="true"></i> </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                    <form method="POST" class="educationFields removeclass1">
                                        <div class="row pad-border">
                                            <div class="col-sm-6 nopadding">
                                                <label>Organization</label><span class="text-danger">*</span>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="Schoolname" name="organization" value="" placeholder="Organization">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nopadding">
                                                <label>Designation</label><span class="text-danger">*</span> 
                                                <div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="designation" value="" placeholder="Designation"> </div>
                                            </div>
                                            <div class="col-sm-6 nopadding">
                                                <div class="form-group">
                                                    <label>From Date</label><span class="text-danger">*</span>
                                                    <input type="text" class="datepicker form-control"  name="work_from_date" value="" readonly >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nopadding">
                                                <div class="form-group">
                                                    <label>To Date</label><span class="text-danger">*</span>
                                                    <input type="text" class="datepicker form-control"  name="work_to_date" value="" readonly >
                                                    <div class="input-group">
                                                        <div class="input-group-btn">
                                                            <input type="hidden" class="RstudentQualificationWork1">
                                                            <button class="btn btn-danger hide minus" type="button"  onclick="remove_education_fields(1);"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 nopadding">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-btn text-center width-100">
                                                            <button class="btn btn-info" type="submit"  > Save Work Experience </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="education_fields">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="step5 accordion-wrapper {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }} mb-3 col-md-12">
                        <div class="card">
                            <div id="headingOne" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOneAG" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed OtherCollap">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps"> 5</span>Academic Gap <small class="docPdftext">(optional)</small></h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOneAG" aria-expanded="false" aria-controls="collapseOne" class=" collapsed plusicon">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div data-parent="#accordion" id="collapseOneAG" aria-labelledby="headingOne" class="collapse" style="">
                                    <br>
                                <div class="senSecImg ">
                                    @if($studentQualificationGaps->count()>0)
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Detail</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($studentQualificationGaps as $key=> $studentQualificationGap)
                                            <tr class="removeEditGapclass{{$studentQualificationGap['id']}}">
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$studentQualificationGap['fromDate']}}</td>
                                                <td>{{$studentQualificationGap['toDate']}}</td>
                                                <td >{{$studentQualificationGap['organization']}}</td>
                                                <td><button class="btn btn-danger minus" data-id type="button"  onclick="remove_Edit_gap_fields({{$studentQualificationGap['id']}});"> <i class="fa fa-minus" aria-hidden="true"></i> </button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif

                                    <div class="questionParent ">
                                        <label>Do you have any Academic Gap?</label>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label class="containerRadio"><small>Yes</small>
                                                    <input type="radio" class="displayNone" id="gapYes" name="gap" value="" >
                                                    <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <label class="containerRadio"><small>No</small>
                                                    <input type="radio" class="displayNone" id="gapNo" name="gap" value="" >
                                                    <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="gap gap_fields removeGapclass1" method="POST">
                                            <div class="row pad-border displayNone gapYes">
                                                <div class="col-sm-3 nopadding">
                                                    <div class="form-group">
                                                        <label>From Date</label>
                                                        <input type="text" class="datepicker form-control gapFromDate" id="gapFromDate" name="gapFromDate" value="" placeholder="From Date" readonly >
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 nopadding">
                                                    <div class="form-group">
                                                        <label>To Date</label>
                                                        <input type="text" class="datepicker form-control" id="gapToDate" name="gapToDate" value="" placeholder="To Date" readonly >
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 nopadding">
                                                    <div class="form-group">
                                                        <label>Detail</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="gapOrganization" name="gapOrganization" value="" placeholder="Detail">
                                                            <div class="input-group-btn">
                                                                <input type="hidden" class="RstudentQualificationGap1">
                                                                <button class="btn btn-danger hide minus" type="button" onclick="remove_gap_fields(1);" > <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 nopadding">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group">
                                                            <div class="input-group-btn text-center width-100">
                                                                <button class="btn btn-success btn btn-info" type="submit"  > Save Academic Gap </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div id="gap_fields">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="accordion" class="step6 accordion-wrapper {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }} mb-3 col-md-12">
                        <div class="card">
                            <div id="headingOne" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOneQG" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed OtherCollap">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps">6</span>Questionnaire</h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOneQG" aria-expanded="false" aria-controls="collapseOne" class=" collapsed plusicon">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div data-parent="#accordion" id="collapseOneQG" aria-labelledby="headingOne" class="collapse" style="">
                                <form method="POST" class="QuestionsSave">
                                        <br>
                                    <div class="senSecImg {{$studentQuestionAnswers->count() > 0 ? '' : 'QuestionsSet'}} ">
                                        @if($questions->count() >= 0)
                                        @foreach($questions as $key=>$questiong)
                                        <div class="questionParent ">
                                            @if($questiong->question)
                                            <div class="col-md-12">
                                                <h6 class="capitalize">
                                                    {{$questiong->question['question']}}?
                                                </h6>
                                                <input type="hidden" class="Qyes hide" name="questionsLenght" value="1">
                                                <input type="hidden" class="Qyes hide" name="questionId[]" value="3">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label class="containerRadio"><small>Yes</small>
                                                        <input type="radio" class="Qyes displayNone" name="question[{{$key}}]" value="yes" {{$questiong['answer'] == 'yes' ? 'checked' : ''}}>
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <label class="containerRadio"><small>No</small>
                                                        <input type="radio" class="QNo displayNone" name="question[{{$key}}]" value="no" {{$questiong['answer'] == 'no' ? 'checked' : ''}}>
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pad-border {{$questiong['answer'] == 'yes' ? '' : 'displayNone'}} Qyess">
                                                <div class="col-sm-12 nopadding">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <textarea class="form-control" id="Degree" name="questionText[]" value="" placeholder="Kindly Provide Details">{{$questiong['detail']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach 
                                        @endif    
                                    </div>
                                    <span class="QuestionsSaveBtnmsg"></span>
                                    <button type="submit" class="btn btn-info QuestionsSaveBtn mb-3">Submit Answer</button>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <div id="accordion" class="step7 accordion-wrapper {{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }} mb-3 col-md-12">
                        <div class="card">
                            <div id="headingOne" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOneD" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed OtherCollap">
                                    <h5 class="m-0 p-0 btn-black-color"><span class="tabSteps">6</span>Documents <small  class="docPdftext">(Please upload documents ( <small class="docPdftext"> Upload only PDF file - must not be above 5 MB (Kindly compress your if it is large size)</small>))</small></h5>
                                </button>
                                <div data-toggle="collapse" data-target="#collapseOneD" aria-expanded="false" aria-controls="collapseOne" class="collapsed plusicon">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div data-parent="#accordion" id="collapseOneD" aria-labelledby="headingOne" class="collapse" style="">
                                <div class="senSecImg">
                                    <br>
                                    <h4><strong>Passport </strong></h4>
                                    <form method="POST" class="documentUpload">
                                        <div class="form-group row">
                                            <label for="input-id" class="col-sm-2">Upload Passport Document<span class="text-danger">*</span> </label>
                                            <div class="col-sm-4">
                                                <label class="btn btn-info docBtn">
                                                <i class="fa fa-upload" ></i>
                                                <input type="file" name="passport" class="mb-2 hide form-control imgInpDoc imgInp images" accept="application/pdf" >
                                                </label>
                                                <div class="error"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class=" displayBlock" >
                                                    @if($data)
                                                    @if($data->passport)
                                                    <i class="fa fa-check btn btn-success " aria-hidden="true"></i>
                                                    <p>Passport Document Uploaded</p>
                                                    <!-- <img class="" src="{{asset('images/site/pdfIcon.png')}}"> -->
                                                    @else
                                                    <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                    @endif
                                                    @else
                                                    <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                    @endif
                                                    <span class="text-center imgPassportEr"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 <div class="senSecImg">
                                    <br>
                                    <h4><strong>Date of birth </strong></h4>
                                    <form method="POST" class="documentUpload">
                                        <div class="form-group row">
                                            <label for="input-id" class="col-sm-2">Upload Date of birth Document </label>
                                            <div class="col-sm-4">
                                                <label class="btn btn-info docBtn">
                                                <i class="fa fa-upload" ></i>
                                                <input type="file" name="dobDoc" class="mb-2 hide form-control imgInpDoc imgInp images" accept="application/pdf" >
                                                </label>
                                                <div class="error"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class=" displayBlock" >
                                                    @if($data)
                                                    @if($data->dobDoc)
                                                    <i class="fa fa-check btn btn-success " aria-hidden="true"></i>
                                                    <p>Date of birth Document Uploaded</p>
                                                    <!-- <img class="" src="{{asset('images/site/pdfIcon.png')}}"> -->
                                                    @else
                                                    <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                    @endif
                                                    @else
                                                    <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                    @endif
                                                    <span class="text-center imgDobDocEr"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="{{ $data != 'NULL' ? 'show' : 'hide' }} lorMoiSopDoc" >
                                <div class="{{ $data['applingForCountry'] == '230' ? 'show' : 'hide' }} {{ $data['applingForCountry'] == '230' ? 'lorMoiSopDoc' : '' }}">
                               
                                    <div class="senSecImg CadHide">
                                        <br>
                                        <h4><strong>LOR Document </strong></h4><small>(Kindly upload 2 letters of Recommendation in a single PDF file (specially for post graduate programs))</small>
                                        <form method="POST" class="documentUpload">
                                            <div class="form-group row">
                                                <label for="input-id" class="col-sm-2">Upload LOR Document </label>
                                                <div class="col-sm-4">
                                                    <label class="btn btn-info docBtn">
                                                    <i class="fa fa-upload" ></i>
                                                    <input type="file" name="lor" class="mb-2 hide form-control imgInpDoc imgInp images"  accept="application/pdf">
                                                    </label>
                                                    <div class="error"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class=" displayBlock" >
                                                        @if($data)
                                                        @if($data->lor)
                                                        <i class="fa fa-check btn btn-success " aria-hidden="true"></i>
                                                        <p>LOR Document Uploaded</p>
                                                        <!-- <img class="" src="{{asset('images/site/pdfIcon.png')}}"> -->
                                                        @else
                                                        <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                        @endif
                                                        @else
                                                        <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                        @endif
                                                        <span class="text-center imgPassportErl"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="senSecImg CadHide">
                                        <br>
                                        <h4><strong>MOI Document </strong></h4>
                                        <form method="POST" class="documentUpload">
                                            <div class="form-group row">
                                                <label for="input-id" class="col-sm-2">Upload MOI Document (Optional)</label>
                                                <div class="col-sm-4">
                                                    <label class="btn btn-info docBtn">
                                                    <i class="fa fa-upload" ></i>
                                                    <input type="file" name="moi" class="mb-2 hide form-control imgInpDoc imgInp images" accept="application/pdf" >
                                                    </label>
                                                    <div class="error"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class=" displayBlock" >
                                                        @if($data)
                                                        @if($data->moi)
                                                        <i class="fa fa-check btn btn-success " aria-hidden="true"></i>
                                                        <p>MOI Document Uploaded</p>
                                                        <!-- <img class="" src="{{asset('images/site/pdfIcon.png')}}"> -->
                                                        @else
                                                        <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                        @endif
                                                        @else
                                                        <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i>
                                                        @endif
                                                        <span class="text-center imgPassportErM"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                   
                                </div>
                                </div>
                                <div class="senSecImg" id="TestDocAppend">
                                    <br>
                                    @if($studentEnglishTests->count() > 0)
                                    <h4><strong>English Test Documents </strong></h4>
                                    @foreach($studentEnglishTests as $key=> $studentEnglishTest)
                                    <form method="POST" class="documentUpload">
                                        <div class="form-group row removeEditTestclass{{$studentEnglishTest['id']}}">
                                            <label for="input-id" class="col-sm-2"><strong> {{$studentEnglishTest->englishTests['name']}} </strong><span class="text-danger">*</span> </label> 
                                            <div class="col-sm-4">
                                                <label class="btn btn-info docBtn"> <i class="fa fa-upload" ></i> <input type="file" name="test[{{$studentEnglishTest->englishTests['name']}}]" class="mb-2 hide form-control imgInpDoc" accept="application/pdf"> </label>
                                                <div class="error"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="testId[{{$studentEnglishTest->englishTests['name']}}]" value="{{$studentEnglishTest['id']}}">
                                                <div class=" displayBlock" >@if($studentEnglishTest->documents['path']) <i class="fa fa-check btn btn-success " aria-hidden="true"></i>@else <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i> @endif </div>
                                                @if($studentEnglishTest->documents['path'])
                                                <p class="capitalize">{{$studentEnglishTest->documents['attachment_name']}} Document Uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach   
                                    @endif   
                                </div>
                                
                                <div class="senSecImg" id="QualificationDocAppend">
                                    <br>
                                    @if($studentQualifications->count() > 0)
                                    <h4><strong>Academic Documents </strong></h4>
                                    <span class="text-center imgqualificationDocumentEr"></span>
                                    @foreach($studentQualifications as $key=> $studentQualification)
                                    <form method="POST" class="documentUpload">
                                        <div class="form-group row removeQualificationEditclass{{$studentQualification['id']}}">
                                            <label for="input-id" class="col-sm-2">Upload Student <strong>" {{$studentQualification->qualification['qualification_grade']}} "</strong> Documents<span class="text-danger">*</span> </label> 
                                            <div class="col-sm-4">
                                                <label class="btn btn-info docBtn"> <i class="fa fa-upload" ></i> <input type="file" name="qualificationDocument[{{$studentQualification->qualification['qualification_grade']}}]" class="mb-2 hide form-control imgInpDoc" accept="application/pdf"> </label>
                                                <div class="error"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="qualificationDocumentId[{{$studentQualification->qualification['qualification_grade']}}]" value="{{$studentQualification['id']}}">
                                                <div class=" displayBlock" >@if($studentQualification->documents['path']) <i class="fa fa-check btn btn-success  " aria-hidden="true"></i>@else <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i> @endif</div>
                                                @if($studentQualification->documents['path'])
                                                <p>{{$studentQualification->documents['attachment_name']}} Document Uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach 
                                    @endif 
                                </div>
                                <div class="senSecImg" id="WorkExpDocAppend">
                                    <br>
                                    @if($studentWorkExperiances->count() > 0)
                                    <h4><strong>Experience Documents </strong></h4>
                                    @foreach($studentWorkExperiances as $key=> $studentWorkExperiance)
                                    <form method="POST" class="documentUpload">
                                        <div class="form-group row removeEditclass{{$studentWorkExperiance['id']}}">
                                            <label for="input-id" class="col-sm-2">Document Of {{$studentWorkExperiance['organization']}} Experience<span class="text-danger">*</span> </label> 
                                            <div class="col-sm-4">
                                                <label class="btn btn-info docBtn"> <i class="fa fa-upload" ></i> <input type="file" name="work[{{$studentWorkExperiance['organization']}}]" class="mb-2 hide form-control imgInpDoc" accept="application/pdf"> </label>
                                                <div class="error"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="workId[{{$studentWorkExperiance['organization']}}]" value="{{$studentWorkExperiance['id']}}">
                                                <div class=" displayBlock" >@if($studentWorkExperiance->documents['path']) <i class="fa fa-check btn btn-success  " aria-hidden="true"></i>@else <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i> @endif </div>
                                                @if($studentWorkExperiance->documents['path'])
                                                <p>{{$studentWorkExperiance->documents['attachment_name']}} Document Uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach   
                                    @endif   
                                </div>
                                <div class="senSecImg" id="AcademicGapDocAppend">
                                    <br>
                                    @if($studentQualificationGaps->count() > 0)
                                    <h4><strong>Academic Gap Documents </strong></h4>
                                    @foreach($studentQualificationGaps as $key=> $studentQualificationGap)
                                    <form method="POST" class="documentUpload">
                                        <div class="form-group row removeEditGapclass{{$studentQualificationGap['id']}}">
                                            <label for="input-id" class="col-sm-2">Documents Of {{$studentQualificationGap['organization']}} Gap<span class="text-danger">*</span> </label> 
                                            <div class="col-sm-4">
                                                <label class="btn btn-info docBtn"> <i class="fa fa-upload" ></i> <input type="file" name="Gap[{{$studentQualificationGap['id']}}]" class="mb-2 hide form-control imgInpDoc" accept="application/pdf"> </label> 
                                                <div class="error"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="GapId[{{$studentQualificationGap['id']}}]" value="{{$studentQualificationGap['id']}}">
                                                <div class=" displayBlock" >@if($studentQualificationGap->documents['path']) <i class="fa fa-check btn btn-success  " aria-hidden="true"></i>@else <i class="fa fa-check btn btn-success displayNone " aria-hidden="true"></i> @endif </div>
                                                @if($studentQualificationGap->documents['path'])
                                                <p>{{$studentQualificationGap->documents['attachment_name']}} Document Uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach 
                                    @endif 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="{{ Session::get('openNext') == 'openNextSession' ? 'show' : 'hide openSession' }}">
                        <form method="POST" action="{{route('verify.applyFor')}}" > 
                            @csrf
                            <input type="hidden" name="studentId" class="studentId" value="{{$data['id']}}">
                            <button class="btn btn-info btn-sm" style="background:#e77817;border-color: #e77817 ">Continue application to select your course </button>
                            @if(!Auth::guard('student')->check())
                            <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection