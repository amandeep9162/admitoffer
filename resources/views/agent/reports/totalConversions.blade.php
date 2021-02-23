@extends('agent.layouts.app')

@section('content')
    <div class="app-main__inner dashboard">
        <div class="app-page-title">
            <div class="page-title-wrapper page-title-wrapper2">
                <div class="page-title-heading">
                 <div class="row">
                    <div class="col-md-6">

                        <label>From Date</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>To Date</label>
                        <input type="date" class="form-control">
                    </div>
                 </div>
                </div>
              
             </div>
        </div>
        
       
        <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Total Conversion Report
                            <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <!-- <button class="active btn btn-focus">Last Week</button>
                                    <button class="btn btn-focus">All Month</button> -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                        
                        <div class="table-responsive">
                                <table class="align-middle text-truncate mb-0 table cell-border table-hover tableID" >
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Student ID</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Applications</th>
                                            <th class="text-center">Qualification</th>
                                            <th class="text-center">Pendency </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        
                                    @foreach ($students as $student)
                                        <tr>
                                            
                                            <td class="text-center capitalize">
                                                <span class="float-left padding-5px stdImg">
                                                @if($student->studentImage)
                                                    <img class="rounded-circle" src="{{asset($student->studentImage->path.'/'.$student->studentImage->name)}}" width="40"  >
                                                @else
                                                    <img class="rounded-circle" src="{{asset('images/site/user-img.png')}}" width="40" alt="your image" />
                
                                                @endif
                                                </span>
                                                
                                                <div class="stdDetail">
                                                
                                                <a href="{{route('student.show',base64_encode($student->id))}}" class="">{{ $student->firstName }}&nbsp;{{$student->lastName}}</a>
                                                @if($student->nationality)
                                                
                                                <div class="widget-subheading text-center"><small>Nationality: </small><i><img class="" src="{{asset($student->countryAddress['path'].'/'.$student->countryAddress['image_name'])}}" width="20"  ></i></div>
                                                @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-pill badge-warning">{{ $student->student_unique_id }}</div>
                                            </td>
                                            <td class="text-center">{{ $student->email }}</td>
                                            <td class="text-center">
                                                @if($student->country['path'])
                                                {{$student->appliedStudentFiles->count()}} X <img class="" src="{{asset($student->country['path'].'/'.$student->country['image_name'])}}" width="25"  >
                                                @else
                                                {{$student->appliedStudentFiles->count()}} X Flag
                                                @endif
                                            </td>
                                            <td class=" capitalize">
                                              <div class="widget-subheading grd_1"><strong>Completed :</strong> {{$student['previousQualification']}}</div>
                                                <div class="widget-subheading grd_1">
                                                    <strong>Grade10 :</strong>
                                                        @if($student->grade10)
                                                            @if($student->grade10->totals)
                                                            {{$student->grade10->totals['name']}} ({{$student->grade10['board']}})
                                                            @endif
                                                        @endif
                                                   
                                                </div>
                                                <div class="widget-subheading grd_1">
                                                    <strong>Grade12 :</strong>
                                                        @if($student->grade12)
                                                            @if($student->grade12->totals)
                                                            {{$student->grade12->totals['name']}} ({{$student->grade12['board']}})
                                                            @endif
                                                        @endif
                                                    
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if( $student->pendeciesStudentFiles->count() > 0)
                                                <div class="badge badge-pill badge-danger num_1">{{ $student->pendeciesStudentFiles->count() }} </div>
                                                @else
                                                <div class="badge badge-pill badge-success num_1">{{ $student->pendeciesStudentFiles->count() }} </div>
                                                @endif
                                            </td>
                                            
                                            
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                         </div>
                         
                      </div>
                      
                    </div>
                </div>
            </div>
        <!-- <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-danger">71%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Income Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-success">54%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Expenses Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-warning">32%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Spendings Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-info">89%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Totals Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

@endsection
