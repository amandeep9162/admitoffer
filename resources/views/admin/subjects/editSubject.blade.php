@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Edit Subject</div>
                <div class="card-body">
                    @include('multiauth::message')
                   
                    <form method="POST" action="{{route('subjects.update',$subject['id'])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="input-id" class=" col-sm-2">Qualification<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                        <select class="mb-2 form-control" name="qualification" required>
                            <option value=''> Select Qualification</option>
                            @foreach($qualifications as $qualification)
                            <option value="{{$qualification['id']}}" {{($qualification['id'] == $subject['qualification'])  ? 'selected' : '' }}>{{$qualification['name']}}</option>
                            @endforeach
                            
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Subject<span class="text-danger">*</span></label>
                        <div class="col-sm-10">         
                            <input type="text" placeholder="name" name="name" class="mb-2 form-control" value="{{$subject['name']}}" required>
                                
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                        <a href="{{route('subjects.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection