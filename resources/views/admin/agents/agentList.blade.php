@extends('admin.layouts.admin') 
@section('content')
<?php
    $user = auth('admin')->user()->roles()->pluck('name');
?>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Agents List &nbsp;
                    <span class="float-right">
                        <a href="{{route('agents.create')}}" class="btn btn-sm btn-success">Add New Agent</a>
                    </span>
                    <span class="float-right">
                        <!-- <a href="{{route('agents.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Id</th> 
                                <th>Agent</th> 
                                <th>Name</th> 
                                <th>Company Name</th> 
                                <th>Mobile</th> 
                                <th>Email</th> 
                                <th>Country/City</th> 
                                <th>Applications</th> 
                                <th>Account Manager</th> 
                                <th>Last Login</th> 
                                <th>Status</th> 
                                <th>Applied at</th> 
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                        @foreach ($agents as $agent)
                        
                        <tr class="text-center">
                            <td class="capitalize text-left"  >
                                {{ $agent->id }}
                            </td>
                            <td class="capitalize"  >
                                <div class="agntImg">
                                    <img src="{{asset($agent->attachment['path'].'/'.$agent->attachment['name'])}}" >
                                </div>
                                
                            </td>
                            <td class="capitalize text-left"  >
                                {{ $agent->name }}
                            </td>

                            <td class="capitalize text-left"  >
                                {{ $agent->company_name }}
                            </td>
                            <td class="capitalize text-left"  >
                                {{ $agent->mobileno }}
                            </td>
                            <td class="capitalize text-left"  >
                                {{ $agent->email }}
                            </td>

                            <td class="capitalize">
                                {{$agent->country['name']}}/{{$agent->city['name']}}
                            </td>
                            <td class="capitalize">
                                    @if($agent->studentsApp)
                                    {{$agent->studentsApp->count()}}
                                    @endif
                            </td>
                            <td class="capitalize">
                                {{$agent->accountManager['name']}}
                            </td>
                             <td class="capitalize text-left"  >
                                @if($agent->last_login)
                                {{ Carbon\Carbon::parse($agent->last_login)->format('d-M-Y h:s A') }}
                                @endif
                            </td>
                            @if($agent['status'] == '0')
                            <td class="capitalize badge badge-warning badge-pill mt-10">
                                    Deactivate
                            </td>
                            @endif
                            @if($agent['status'] == '1')
                            <td class="capitalize badge badge-success badge-pill mt-10">
                                Activated
                            </td>
                            @endif
                            <td class="capitalize text-left"  >
                                @if($agent->created_at)
                                {{ Carbon\Carbon::parse($agent->created_at)->format('d-M-Y h:s A') }}
                                @endif
                            </td>
                            <td >
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $agent->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $agent->id }}" action="{{ route('agents.destroy',[$agent->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->
                                @if($user[0] != 'preprocess')
                                @if($agent['status'] == '0')
                                <a href="{{route('agent.approve',base64_encode($agent->id))}}" class="btn btn-sm btn-success mr-3">Activate</a>
                                @else
                                <a href="{{route('agent.disapprove',base64_encode($agent->id))}}" class="btn btn-sm btn-danger mr-3">Dectivate</a>
                                @endif
                                <a href="{{route('agents.edit',base64_encode($agent->id))}}" class="btn btn-sm btn-info mr-3 float-right">Edit</a>
                                @endif
                                <a href="{{route('chat.create',base64_encode($agent->id))}}" class="btn btn-sm btn-primary mr-3 float-right">Start Chat</a>
                            </td>
                        </tr>
                        @endforeach @if($agents->count()==0)
                        <p class="text-center">No Agent created Yet.</p>
                        @endif
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection