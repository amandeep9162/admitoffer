@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add Qualification Board</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('qualificationBoard.store')}}">
                    @csrf
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Board<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Qualification Board" name="name" class="mb-2 form-control" required>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('qualificationBoard.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection