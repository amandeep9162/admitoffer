@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Notifications List &nbsp;
                    
                    <span class="float-right">
                        <!-- <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table data-order='[[ 0, "desc" ]]' class="align-middle text-truncate mb-0 table table-borderless table-hover tableID" >
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">Notifications</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach ($notifications as $key=>$notification)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="">
                                <div class="">{{ $notification['message'] }}</div>
                            </td>
                            <td class="text-center">
                                <div class="">{{ date('d-M-Y',strtotime($notification['created_at']))  }}</div>
                            </td>
                            <td class="text-center">
                                <a href="{{route('student.notify.update',$notification['id'])}}" class=" btn btn-sm btn-info ">View</a>
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
@endsection
