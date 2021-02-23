@extends('agent.layouts.app')

@section('content')
    <div class="app-main__inner dashboard">
        <div class="app-page-title">
            <form method="POST" action="{{route('get.university.report')}}">
                @csrf
            <div class="page-title-wrapper page-title-wrapper2">
                <div class="page-title-heading">
                 <div class="row">
                    <div class="col-md-5">

                        <label>From Date</label>
                        <input type="date" name="fromDate" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label>To Date</label>
                        <input type="date" name="toDate" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-success btn2 mrg50" type="submit">Search</button>
                    </div>
                  </div>
                </div>
              
             </div>
            </form>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">University Report
                            <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <!-- <button class="active btn btn-focus">Last Week</button>
                                    <button class="btn btn-focus">All Month</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                         <div class="card-body">
                        <div class="table-responsive">
                                <table class="align-middle text-truncate mb-0 table table-borderless table-hover tableID" >
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">University Name</th>
                                            <th class="text-center">Total Applications</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                        
                                    @foreach ($universities as $key => $universitie)
                                        <tr>
                                            <td class="text-center capitalize">
                                               {{$key+1}}
                                            </td>
                                            <td class="text-center capitalize">
                                                @if($universitie->college)
                                                {{ $universitie->college->university['name'] }}
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $universitie->total }}</td>
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
    </div>

@endsection
