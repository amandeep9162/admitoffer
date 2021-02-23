@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Announcements List &nbsp;
                    <span class="float-right">
                        <a href="{{route('announcement.create')}}" class="btn btn-sm btn-success">Add Announcement</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Announcements</th> 
                                <th>Posted At</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                            @foreach ($announcements as $announcement)
                            <tr>
                            <th scope="row capitalize">{{  $announcement->name }}</th>
                        <td >
                            {{ $announcement->created_at }}
                        </td>
                                <td class="float-right">
                                    <a href="{{route('announcement.edit',base64_encode($announcement->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                        </td>
                        @endforeach @if($announcements->count()==0)
                        <p class="text-center">No Announcement.</p>
                        @endif
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection