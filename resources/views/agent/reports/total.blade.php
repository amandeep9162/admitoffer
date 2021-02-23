@extends('agent.layouts.app')
@section('content')
<div class="app-main__inner dashboard">
    <div class="app-page-title Treport">
        <form method="POST" action="{{route('get.total.report')}}">
            <div class="page-title-wrapper">
                @csrf
                <div class="row width-100" >
                     <div class="col-md-9">
                          
                        <label>Country <i class="fa fa-map-marker"></i></label>
                        <select class="form-control" name="country">
                        <option value=""> Select Any Country</option>
                           @foreach($countries as $country)
                              @if ($data != null)
                                 @if ($data['country'] == $country['id'])
                                    <option value="{{$country['id']}}" selected>{{$country['name']}}</option>
                                 @else
                                     <option value="{{$country['id']}}">{{$country['name']}}</option>
                                 @endif
                              @else
                                 <option value="{{$country['id']}}">{{$country['name']}}</option>
                              @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label >&nbsp;</label>
                        <div class="row">
                              <!-- <a href="javascript:;" class="btn btn-success toggleFilter">Filter</a> -->
                              <button type="submit" class="btn btn-success btn-default-color width-100 padding-t-b-8"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                        <!-- <label>From Date</label>
                              <input type="date" class="form-control" name="fromDate"> -->
                     </div>
                </div>
                <!-- <div class="col-md-4">
                    <label>To Date</label>
                    <input type="date" class="form-control" name="toDate">
                    </div> -->
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Intake</label>
                            <select class="form-control" name="intake" >
                               <option value="">Select Any Intake</option>
                               @foreach($intakes as $intake)
                                 @if ($data != null)
                                    @if ($data['intake'] == $intake['id'])
                                       <option value="{{$intake['id']}}" selected>{{$intake['name']}}</option>
                                    @else
                                       <option value="{{$intake['id']}}">{{$intake['name']}}</option>
                                    @endif
                                 @else
                                    <option value="{{$intake['id']}}">{{$intake['name']}}</option>
                                 @endif
                               @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                              <label>From Date</label>
                              @if ($data != null)
                                 @if ($data['fromDate'] != null)
                                 <input type="text" class="form-control datepicker" name="fromDate" placeholder="DD/MM/YY" value="{{$data['fromDate']}}" readonly>
                                 @else
                                 <input type="text" class="form-control datepicker" placeholder="DD/MM/YY" name="fromDate" readonly>
                                 @endif
                              @else
                              <input type="text" class="form-control datepicker" placeholder="DD/MM/YY" name="fromDate" readonly>
                              @endif
                          </div>
                          <div class="col-md-3">
                              <label>To Date</label>
                              @if ($data != null)
                                 @if ($data['toDate'] != null)
                                 <input type="text" class="form-control datepicker" name="toDate"  placeholder="DD/MM/YY"  value="{{$data['toDate']}}" readonly>
                                 @else
                                 <input type="text" class="form-control datepicker" name="toDate"  placeholder="DD/MM/YY" readonly >
                                 @endif
                              @else
                              <input type="text" class="form-control datepicker" name="toDate"  placeholder="DD/MM/YY" readonly >
                              @endif
                          </div>
                        <div class="col-md-3">
                            <label>University</label>
                            <select class="form-control" name="university" >
                            <option value="">Select Anyone</option>
                               @foreach($Universities as $University)
                               <option value="{{$University['id']}}">{{$University['name']}}</option>
                               @endforeach
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-3">
                           <label>Visa</label>
                           <select class="form-control" name="visa" >
                              <option value="">Select Anyone</option>
                                 <option value="Accepted">Accepted</option>
                                 <option value="Rejected">Rejected</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Status</label>
                           <select class="form-control" name="status" >
                           <option value="">Select Anyone</option>
                              @foreach($applicationStatus as $status)
                              <option value="{{$status['id']}}">{{$status['name']}}</option>
                              @endforeach
                           </select>
                        </div>
                        <!-- <div class="col-md-3">
                           <label>Select Visa</label>
                           <select class="form-control" name="totalVisa" >
                           <option value="">Select Anyone</option>
                              <option value="Total Applications">Total Applications</option>
                              <option value="Total Offers">Total Offers</option>
                              <option value="Total Tuition Deposits">Total Tuition Deposits</option>
                              <option value="Total Pendencies">Total Pendencies</option>
                              <option value="Total CAS">Total CAS</option>
                              <option value="Total Visa">Total Visa</option>
                           </select>
                        </div> -->
                       
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <!-- <div class="card-header">
                    Total Report
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                <div class="row">
                    <div class="table-responsive">
                        <table class="align-middle text-truncate mb-0 table table-borderless table-hover reprotTable" >
                            <thead class="reprotTableDesign">
                                <tr>
                                    <th class="text-center">Report Types</th>
                                    <th class="text-center">No. Of Applications</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <tr>
                                    <td class="text-center capitalize">
                                        <b>Total Applications</b>
                                    </td>
                                    <td class="text-center">{{ $total }}</td>
                                </tr>
                                 <tr>
                                    <td class="text-center capitalize">
                                        <b>Total Offers</b>
                                    </td>
                                    <td class="text-center">{{ $offers }}</td>
                                </tr>
                                 <tr>
                                    <td class="text-center capitalize">
                                        <b>Students</b>
                                    </td>
                                    <td class="text-center">{{ $students }}</td>
                                </tr>
                                 <tr>
                                    <td class="text-center capitalize">
                                        <b>Fee Deposit</b>
                                    </td>
                                    <td class="text-center"><i class="fa fa-dollar-sign"></i> {{ $offers }}</td>
                                </tr>
                                 <tr>
                                    <td class="text-center capitalize">
                                        <b>Comission</b>
                                    </td>
                                    <td class="text-center"><i class="fa fa-dollar-sign"></i> {{ $offers }}</td>
                                </tr>
                                 <tr>
                                    <td class="text-center capitalize">
                                        <b>Earn Comission</b>
                                    </td>
                                    <td class="text-center"><i class="fa fa-dollar-sign"></i> {{ $offers }}</td>
                                </tr>
                                <!-- @foreach ($applications as $key => $application)
                                <tr>
                                    <td class="text-center capitalize">
                                        {{$key+1}}
                                    </td>
                                    <td class="text-center capitalize">
                                        @if($application)
                                        {{ $application['name'] }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $application->total }}</td>
                                </tr>
                                @endforeach  -->
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection