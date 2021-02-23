@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add New Task</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('taskmanager.store')}}">
                    @csrf
                        <div class="form-group row">
                            @if($isAddNew == 'no')
                            <label for="input-id" class="col-sm-2">Agent </label>
                            <label for="input-id" class="col-sm-10">{{$task->agent['name']}}</label>
                            @else
                            <label for="input-id" class="col-sm-2">Agents list</label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="agent" >
                                    <option value="" >Select agent</option>
                                    @foreach($agents as $agent)
                                    <option value="{{$agent['id']}}" >{{$agent['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Activity<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="email/whatsapp/call" name="activity" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Details<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea placeholder="Details" name="details" class="mb-2 form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Next Followup<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="date"  name="nextFollowUp" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <input type="hidden"  name="isAddNew" class="mb-2 form-control" value="{{$isAddNew}}">
                        @if($isAddNew == 'no')
                        <input type="hidden"  name="agent_id" class="mb-2 form-control" value="{{$task['agent_id']}}">
                        <input type="hidden"  name="taskId" class="mb-2 form-control" value="{{$task['id']}}">
                        @endif
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('taskmanager.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection