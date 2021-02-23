@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add Qualification Total </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('qualificationTotals.store')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Qualification Total Type<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select  class="mb-2 form-control" name="type">
                                <option value=''>select Qualification Total Type</option>
                                
                                <option value="percentage">Percentage</option>
                                <option value="division">Division</option>
                                <option value="gpa">GPA</option>
                               
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Add Qualification Total  <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="total" name="name" class="mb-2 form-control" required>
                            
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('qualificationTotals.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection