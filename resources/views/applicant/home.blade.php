@extends('applicant.layouts.app')

@section('content')
<style type="text/css">
    .work-process-wrap {
    margin: 20px -15px -60px;
    display: -webkit-box;
    display: -moz-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row;
    -moz-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-flex-wrap: wrap;
    -moz-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-justify-content: flex-start;
    -moz-justify-content: flex-start;
    -ms-justify-content: flex-start;
    justify-content: flex-start;
    -webkit-align-items: flex-start;
    -moz-align-items: flex-start;
    -ms-align-items: flex-start;
    align-items: flex-start;
}
.single-work-process {
    position: relative;
    margin: 0 15px 60px;
    width: calc(25% - 30px);
}
.work-process-icon-wrap {
     position: relative; 
     display: inline-block; 
     width: 70px; 
     height: 70px; 
}

.primary-bg {
    background: #e77817;
}
.work-process-icon-wrap i {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.icon-md {
    font-size: 40px;
    line-height: 40px;
}
.work-process-icon-wrap .process-step {
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    position: absolute;
    right: -20px;
    top: -20px;
    font-size: 20px;
    font-weight: 700;
    font-family: 'Montserrat', sans-serif;
}
.secondary-bg {
    background: #e80566;
}
.single-work-process .work-process-divider {
    position: absolute;
    left: auto;
    top: 40px;
    width: calc(100% - 130px);
    height: 1px;
    background-image: linear-gradient(90deg, #73778C, #73778C 40%, transparent 40%, transparent 100%);
    background-size: 12px 1px;
}
.single-work-process .work-process-divider:after {
    
   
    position: absolute;
    right: -30px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 20px;
}
.fa-arrow-right{
    position: absolute;
    right: -38px;
    top: 33px;
}
.timeline {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
    width: 100%;
}
</style>
<div class="container-fluid">
  <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Welcome to Admit Offer 
                    <div class="page-title-subheading">Simplifying Overseas Education for international students.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="View your pendencies list">
                <i class="fa fa-star"></i>
                </button>
                <div class="d-inline-block ">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
        <div class=" card">
            <div class="work-process-wrap text-center">
                <div class="single-work-process">
                    <div class="work-process-icon-wrap primary-bg rounded">
                        <i class="fa fa-user icon-md text-white"></i>
                        <span class="process-step secondary-bg text-white shadow-sm">1</span>
                    </div>
                    <i class="fas fa-arrow-right"></i>
                    <div class="work-process-content mt-4">
                        <h5>Add Application</h5>
                        <!-- <p>Add basic detail in profile section. </p> -->
                    </div>
                </div>
                <div class="single-work-process">
                    <div class="work-process-icon-wrap primary-bg rounded">
                        <i class="fa fa-search icon-md text-white"></i>
                        <span class="process-step secondary-bg text-white shadow-sm">2</span>
                    </div>
                    <i class="fas fa-arrow-right"></i>
                    <div class="work-process-content mt-4">
                        <h5>Select Courses & Universities</h5>
                        <!-- <p>search course related to your basic education and select upto 5 course to apply application. </p> -->
                    </div>
                </div>
                <div class="single-work-process">
                    <div class="work-process-icon-wrap primary-bg rounded">
                        <i class="fa fa-check icon-md text-white"></i>
                        <span class="process-step secondary-bg text-white shadow-sm">3</span>
                    </div>
                    <i class="fas fa-arrow-right"></i>
                    <div class="work-process-content mt-4">
                        <h5>Recheck Application</h5>
                        <!-- <p>In this section you can check your basic detail and applied courses detail. </p> -->
                    </div>
                </div>
                <div class="single-work-process">
                    <div class="work-process-icon-wrap primary-bg rounded">
                        <i class="fa fa-lock icon-md text-white"></i>
                        <span class="process-step secondary-bg text-white shadow-sm">4</span>
                    </div>
                   
                    <div class="work-process-content mt-4">
                        <h5>Submit Application</h5>
                        <!-- <p>After recheck all details click on final submit button.</p> -->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <h3 class="text-center" style="padding: 15px 0px 15px 0px">Applications Status Timeline</h3>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($allApplyStudents as $application)

        <div class="col-md-6">
        <div class="timeline-1 hide" style="border-top: 1px solid rgba(26, 54, 126, 0.125); display: block;">
            <div class="card-header">
                <h5 class="width-100">{{$application->course['name']}}</h5>
                <h6 class=""><small>{{$application->course->college['name']}}</small></h6>
            </div>
            <div class="card mb-3">
             <?php
                $even = 0;
                $odd = 0;
                ?>
                <div class="timeline">
                    <div class="containertime text-center left">
                        <div class="contentLeft">
                            <h6><small>New Application</small></h6>
                            <p>{{$application['applied_at']}}</p>
                        </div>
                    </div>
                </div>
                @foreach($application->timelines as $key => $applicationStatusT)
                <div class="timeline">
                    @if($key == (int)$even)
                    <?php $odd = (int)$even+1; ?>
                    <div class="containertime text-center right">
                        <div class="contentRight">
                            <h6><small>{{$applicationStatusT->status['name']}}</small></h6>
                            <p>{{$applicationStatusT['status_date']}}</p>
                        </div>
                    </div>
                    @endif 
                    @if($key == $odd)
                    <?php $even = $odd+1; ?>
                    <div class="containertime text-center left">
                        <div class="contentLeft">
                            <h6><small>{{$applicationStatusT->status['name']}}</small></h6>
                            <p>{{$applicationStatusT['status_date']}}</p>
                        </div>
                    </div>
                    @endif
                   
                </div>
                @endforeach
            </div>
</div>
        </div>
        @endforeach
</div>
</div>
@endsection
