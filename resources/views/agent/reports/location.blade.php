@extends('agent.layouts.app')

@section('content')
    <div class="app-main__inner dashboard">
        <div class="app-page-title">
            <form method="POST" action="{{route('get.location.report')}}">
            <div class="page-title-wrapper">
                                @csrf
                        <div class="col-md-4">

                            <label>Select Location</label>
                            <select class="form-control" name="location" >
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}">{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">

                            <label>From Date</label>
                            <input type="date" class="form-control" name="fromDate">
                        </div>
                        <div class="col-md-4">
                            <label>To Date</label>
                            <input type="date" class="form-control" name="toDate">
                        </div>
                        
                    </div>
                </form>
        </div>
        
       
        <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Location Report
                            <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <!-- <button class="active btn btn-focus">Last Week</button>
                                    <button class="btn btn-focus">All Month</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="table-responsive">
                                <table class="align-middle text-truncate mb-0 table table-borderless table-hover tableID" >
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Student ID</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($locations as $key => $location)
                                    {{dd($location)}}
                                    <tr>
                                        <td class="text-center capitalize">
                                            {{$key+1}}
                                        </td>
                                        <td class="text-center capitalize">
                                            @if($location)
                                              {{ $location['name'] }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $location->total }}</td>
                                    </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                         </div>
                         </div>
                        
                    </div>
                </div>
            </div>
      
    </div>

@endsection
