@extends('agent.layouts.app')
@section('content')
<style type="text/css">
    .bg-arielle-org {
    background-image: radial-gradient(circle 248px at center,#e34f16 0%,#ec9830 47%,#f78b46 100%)!important;
}
</style>
<div class="app-main__inner dashboard">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Welcome to Admit Offer 
                    <div class="page-title-subheading">Simplifying Overseas Education for international students
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <span class="mr-3"><strong class="text-danger">Pendencies:</strong> {{sizeof($pendancy)}}</span>
                <button type="button" data-toggle="tooltip" title="View your pendencies list" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
                </button>
                <div class="d-inline-block ">
                    <a  href="{{route('student.studentsPendencies')}}"  class="btn-shadow btn btn-info">
                        <!-- <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-business-time fa-w-20"></i>
                            </span> -->
                        View all
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if($pendancy->count() > 0)
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Pendencies &nbsp;({{$pendancy->count()}})
                    </div>
                    <ul class="nav">
                        <!-- <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li> -->
                        <!-- <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li> -->
                    </ul>
                </div>
                <div class="card-body" style="padding:0px;">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                          
                            <div class="" style="padding:10px;overflow-y: scroll;height: 300px;" >
                                <div class="scrollbar-container">
                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                    
                            
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="card-body">
                                                        @include('multiauth::message')
                                                        <table data-order='[[ 0, "desc" ]]' class="align-middle text-truncate mb-0 table table-borderless table-hover tableID cell-border" >
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Student name</th>
                                                                <th class="text-center">pendency name</th>
                                                                
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                           
                                                        @foreach($pendancy as $pend)

                                                            <tr style="background: #ffefef!important;">
                                                                <td class="text-center" >
                                                                    <div class="badge badge-pill badge-warning num_1" style="width: auto!important;">{{ $pend->student['id'] }}</div>
                                                                </td>
                                                                <td class="text-center" >
                                                                    <div class="text-center">{{ $pend->student['firstName'] }} {{ $pend->student['lastName'] }}</div>
                                                                </td>
                                                                <td class="text-center" >
                                                                    <div class="text-center">
                                                                        @if(is_numeric($pend['type']))
                                                                        
                                                                        @if($pend->qualification)
                                                                        {{ $pend->qualification['qualification_grade'] }}
                                                                        @else
                                                                        {{ $pend['type'] }}
                                                                        @endif
                                                                        @else
                                                                        {{ $pend['type'] }}
                                                                        @endif
                                                                    &nbsp;{{ $pend['name'] }}&nbsp;{{ $pend['title'] }}</div>
                                                                    <p>{{ $pend['reason']}}</p>
                                                                </td>
                                                              
                                                                <td class="text-center profile_btn">
                                                                    
                                                                  @if($pend)
                                                                        @if($pend['application_id'])
                                                                            <a href="{{route('student.application.View',base64_encode($pend['application_id']))}}" class="btn btn-sm btn-info mb-4" > View </a>
                                                                        @else
                                                                            <a href="{{route('student.show',base64_encode($pend->student['id']))}}" class=" btn btn-sm btn-info mb-4" data-toggle="tooltip" title="View">View</a>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            
                                                            @endforeach 
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="widget-content-left">
                                                       
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1"></small>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Students</div>
                        <!-- <div class="widget-subheading"><small>GLOBAL</small></div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$students->count()}}</span></div>
                    </div>
                </div>
                <a href="{{route('student.index')}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>  
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Applications</div>
                        <!-- <div class="widget-subheading"><small>GLOBAL</small></div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{sizeof($submittedFiles)}}</span></div>
                    </div>
                </div>
                  <a href="{{route('all.Applications')}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">New Applications</div>
                        <!-- <div class="widget-subheading"><small>APPROVED VISAS: 800</small></div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$newApplications->count()}}</span></div>
                    </div>
                </div>
                  <a href="{{route('all.Applications.status',base64_encode(1))}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>
         
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Conditional Offer Letter</div>
                        <!-- <div class="widget-subheading">Revenue streams</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{$applicationsconditioOfferUpload->count()}}</span></div>
                    </div>
                </div>
                  <a href="{{route('all.Applications.status',base64_encode(3))}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Unconditional Offer Letter</div>
                        <!-- <div class="widget-subheading">Revenue streams</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{$applicationsUnconditioOfferUpload->count()}}</span></div>
                    </div>
                </div>
                  <a href="{{route('all.Applications.status',base64_encode(4))}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-gray">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">TT Paid</div>
                        <!-- <div class="widget-subheading"><small>GLOBAL</small></div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$ttpaid->count()}}</span></div>
                    </div>
                </div>  <a href="{{route('all.Applications.status',base64_encode(5))}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content  bg-grow-early">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Provide CAS requests</div>
                            <!-- <div class="widget-subheading">Sep 2019 intake</div> -->
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">{{$provideCasRequest->count()}}</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('all.Applications.status',base64_encode(8))}}">
                    
                    <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-gray">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">CAS Issued</div>
                        <!-- <div class="widget-subheading"><small>GLOBAL</small></div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$casIssued->count()}}</span></div>
                    </div>
                </div>
                  <a href="{{route('all.Applications.status',base64_encode(9))}}">
                    
                <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-org">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"> Pending Applications</div>
                        <!-- <div class="widget-subheading"><small>APPROVED VISAS: 800</small></div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$pendingApplications->count()}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Processed </div>
                    <div class="widget-subheading"><small>Applications</small></div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$processedApplications->count()}}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-arielle-org">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Approved VISAS</div>
                    <div class="widget-subheading"><small>Rejected VISAS: {{$visaDisApproved->count()}}</small></div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$visaApproved->count()}}</span></div>
                </div>
            </div>
              <a href="{{route('all.Applications.status',base64_encode(10))}}">
                
            <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
            </a>
        </div>
    </div>
      <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Rejected Applications</div>
                    <!-- <div class="widget-subheading"><small>GLOBAL</small></div> -->
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$rejectedApplications->count()}}</span></div>
                </div>
            </div>
              <a href="{{route('all.Applications.status',base64_encode(12))}}">
                
            <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Pending Final Submission</div>
                        <!-- <div class="widget-subheading">India, China, Nepal</div> -->
                    </div>

                    <div class="widget-content-right">
                        <div class="widget-numbers text-success">{{sizeof($notSubmittedFiles)}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Today Applications</div>
                        <!-- <div class="widget-subheading">Sep 2019 intake</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning">{{sizeof($todayApplied)}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Visa Approved</div>
                        <!-- <div class="widget-subheading">Fee Paid</div> -->
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-danger">{{$visaApproved->count()}}</div>
                    </div>
                </div>
            </div>
              <a href="{{route('all.Applications.status',base64_encode(10))}}">
                
            <i class="pe-7s-exapnd2" style="color: white;position:absolute;right:2px;top:2px; font-size:17px;"></i> 
            </a>
        </div>
    </div>
  </div>
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="widget-content-wrapper  zoom">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                   <div class="slide-icon1">
                                    <i class="fa fa-university" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                    <div class="widget-heading">
                                        <h6>Your Total Applications</h6>
                                        <div class="intake">INTAKE</div>
                                         <div class="intakeMonth">Apr-Jul: <span>{{sizeof($aprlToJul)}}</span></div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="slide-icon1"> <i class="fa fa-university" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                   <div class="widget-heading">
                                        <h6>Your Total Applications</h6>
                                    <div class="intake">
                                         INTAKE 
                                    </div>
                                    <div class="intakeMonth">
                                          Aug-Nov: 
                                    
                                          <span>{{sizeof($augToNov)}}</span>
                                    </div>
                                 </div>
                                </div>
                                <div class="carousel-item">
                                <div class="slide-icon1"> <i class="fa fa-university" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                   <div class="widget-heading">
                                        <h6>Your Total Applications</h6>
                                        <div class="intake">
                                            INTAKE 
                                        </div>
                                        <div class="intakeMonth">
                                            Dec-Mar: 
                                        
                                            <span>{{sizeof($decToMar)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-md-6 col-xl-4">
            <div class="widget-content-wrapper  zoom">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                   <div class="slide-icon2">
                                    <i class="fa fa-copy" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                    <div class="widget-heading">
                                        <h6>Your Total Offers</h6>
                                        <div class="intake">INTAKE</div>
                                         <div class="intakeMonth">Apr-Jul: <span>{{sizeof($aprlToJulOffers)}}</span></div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="slide-icon2"> <i class="fa fa-copy" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                   <div class="widget-heading">
                                        <h6>Your Total Offers</h6>
                                    <div class="intake">
                                         INTAKE 
                                    </div>
                                    <div class="intakeMonth">
                                          Aug-Nov: 
                                    
                                          <span>{{sizeof($augToNovOffers)}}</span>
                                    </div>
                                 </div>
                                </div>
                                <div class="carousel-item">
                                <div class="slide-icon2"> <i class="fa fa-copy" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                   <div class="widget-heading">
                                        <h6>Your Total Offers</h6>
                                        <div class="intake">
                                            INTAKE 
                                        </div>
                                        <div class="intakeMonth">
                                            Dec-Mar: 
                                        
                                            <span>{{sizeof($decToMarOffers)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="widget-content-wrapper  zoom">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div id="carouselExampleControls3" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                   <div class="slide-icon3">
                                    <i class="fa fa-credit-card" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                    <div class="widget-heading">
                                        <h6>Your total Fee Deposit</h6>
                                        <div class="intake">INTAKE</div>
                                         <div class="intakeMonth">Apr-Jul: <span>{{$aprlToJulComission}}</span></div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="slide-icon3"> <i class="fa fa-credit-card" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                   <div class="widget-heading">
                                        <h6>Your total Fee Deposit</h6>
                                    <div class="intake">
                                         INTAKE 
                                    </div>
                                    <div class="intakeMonth">
                                          Aug-Nov: 
                                    
                                          <span>{{$augToNovComission}}</span>
                                    </div>
                                 </div>
                                </div>
                                <div class="carousel-item">
                                <div class="slide-icon3"> <i class="fa fa-credit-card" aria-hidden="true" title="Copy to use calendar"></i>
                                   </div>
                                   <div class="widget-heading">
                                        <h6>Your total Fee Deposit</h6>
                                        <div class="intake">
                                            INTAKE 
                                        </div>
                                        <div class="intakeMonth">
                                            Dec-Mar: 
                                        
                                            <span>{{$decToMarComission}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        University Applications
                    </div>
                    <ul class="nav">
                        <!-- <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li> -->
                        <!-- <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li> -->
                    </ul>
                </div>
                <div class="card-body" style="padding:0px;">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                          
                            <div class="" style="padding:10px;overflow-y: scroll;height: 302px;" >
                                <div class="scrollbar-container">
                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                    @foreach($fileds as $file)
                            
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle" src="assets/images/avatars/9.jpg" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">
                                                        @if($file->college)
                                                            @if($file->college)
                                                                {{$file->college['name']}}
                                                            @endif
                                                        @endif
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1"></small>
                                                            @if($file->college)
                                                            <span>{{$file['total']}}</span>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                         @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title">
                        <!-- <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i> -->
                        Announcements 
                    </div>
                    <div class="btn-actions-pane-right">
                        <div class="nav">
                            <!-- <a href="javascript:void(0);" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab 1</a> -->
                            <!-- <a href="javascript:void(0);" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab 2</a> -->
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">
                        <div class="widget-chart p-3 marq">
                            <marquee direction="up" scrollamount="1" >
                                @foreach($announcements as $announcement)
                                <p class="" >{{$announcement['name']}}</p>
                                @endforeach
                            </marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card activity">
                <div class="card-header">
                    Recent Activity 
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <!-- <button class="active btn btn-focus">Last Week</button>
                                <button class="btn btn-focus">All Month</button> -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover ">
                        <!-- <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th class="text-center">Program</th>
                                <th class="text-center">Applied Date</th>
                                <th class="text-center">Current Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead> -->
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                        <button class="btn-wide btn btn-success">Save</button> -->
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="align-middle mb-0 table table-borderless table-striped table-hover ">
                            <thead>
                               <!-- <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Activities</th>
                                    <th>Date</th>
                                     <th class="text-center">Actions</th> 
                                </tr>-->
                            </thead>
                            <tbody>
                                @foreach($notifications as $key=>$notification)
                                <tr>
                                   <!-- <td class="text-center text-muted badge badge-pill badge-warning">#{{$notification['id']}}</td>-->
                                    <td class="text-left text-muted capitalize activity_icon"><i class="fa fa-angle-double-right"></i> {{$notification['message']}}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading badge badge-pill badge-orange">{{$notification['created_at']->format('d/M/Y')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td class="text-center">
                                        <a href="{{$notification['link']}}" id="PopoverCustomT-1" class="btn-shadow btn btn-primary activeAppliBack">Details</a>
                                        </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                                @if($notifications->count() == 0)
                                    <p class="text-center">No recent activity</p>
                                @endif
                    </div>
                    <a href="{{route('notification.list')}}" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-lg"><span class="mr-2 opacity-7"><i class="fa fa-cog fa-spin"></i></span><span class="mr-1">View All</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content zoom">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading uppercase">Total Conversions</div>
                            <div class="widget-subheading"></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success"> {{$conversion->count()}}</div>
                        </div>
                    </div>
                     
                    <div class=" progress" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{$conversion->count()}}%;background-color: #3ac47d"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content zoom">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading uppercase">Active Applications</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">{{$activeApplication->count()}}</div>
                        </div>
                    </div>
                    
                    <div class=" progress" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{$activeApplication->count()}}%;background-color: #f7b924"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content zoom">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading uppercase">Total Applications</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">{{$totalApplication->count()}}</div>
                        </div>
                    </div>
                     
                    <div class=" progress" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{$totalApplication->count()}}%;background-color: #d92550"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Income</div>
                            <div class="widget-subheading">Expected totals</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-focus">$147</div>
                        </div>
                    </div>
                    <div class="widget-progress-wrapper">
                        <div class="progress-bar-sm progress-bar-animated-alt progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                        </div>
                        <div class="progress-sub-label">
                            <div class="sub-label-left">Expenses</div>
                            <div class="sub-label-right">100%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    Active Applications
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <!-- <button class="active btn btn-focus">Last Week</button>
                                <button class="btn btn-focus">All Month</button> -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table data-order='[[ 0, "desc" ]]' class="align-middle mb-0 table table-borderless table-striped table-hover ">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th class="">Program</th>
                                <th class="">Applied Date</th>
                                <th class="text-center">Current Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $key=>$file)
                            <tr>
                                <td class="text-center text-muted">#{{$file['id']}}</td>
                                <td>
                                    <div class="  ">
                                        <div class="SlistImg ">
                                            @if($file->student)
                                            @if($file->student->studentImage)
                                            <img src="{{asset($file->student->studentImage->path.'/'.$file->student->studentImage->name)}}" >
                                            @else
                                            <img class="blah" src="{{asset('images/site/user-img.png')}}" alt="your image" />
                                            @endif
                                            @else
                                            <img class="blah" src="{{asset('images/site/user-img.png')}}" alt="your image" />
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"><a href="#">{{$file->student['firstName']}} &nbsp;{{$file->student['lastName']}}</a></div>
                                                <div class="widget-subheading opacity-7 capitalize ">
                                                    <?php
                                                        $isAdmin =Auth::guard('admin')->check();
                                                        ?>
                                                    @if($isAdmin)
                                                    @if($file->agent)
                                                    {{$file->agent['name']}}
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"><a href="#">{{$file->course['name']}}</a></div>
                                                <div class="widget-subheading opacity-7 capitalize text-warning"  style="width:20px">
                                                    @if($file->course)
                                                    @if($file->student)
                                                    <img class=""  width="100%"  src="{{asset($file->student->country->path.''.$file->student->country->image_name)}}">&nbsp;
                                                    @endif
                                                    @if($file->course->college) 
                                                        @if($file->course->college->university) 
                                                        {{$file->course->college->university['name']}}
                                                        @endif
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading badge badge-pill badge-orange">{{$file['created_at']->format('d/M/Y')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($file['file_status'] == '1')
                                    <div class="badge badge-warning">
                                        {{$file->applicationStatus['name']}}
                                    </div>
                                    @elseif($file['file_status'] == '2')
                                    <div class="badge badge-success">
                                        {{$file->applicationStatus['name']}}
                                    </div>
                                    @elseif($file['file_status'] == '3')
                                    <div class="badge badge-success">
                                        {{$file->applicationStatus['name']}}
                                    </div>
                                    @elseif($file['file_status'] == '4')
                                    <div class="badge badge-danger">
                                        {{$file->applicationStatus['name']}}
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('student.application.View',base64_encode($file['id']))}}" id="PopoverCustomT-1" class="btn-shadow btn btn-primary activeAppliBack">Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                        <button class="btn-wide btn btn-success">Save</button> -->
                    <a href="{{route('student.index')}}" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-lg"><span class="mr-2 opacity-7"><i class="fa fa-cog fa-spin"></i></span><span class="mr-1">View All</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection