@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add New Country</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('admin.saveCountry')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Country Name<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="name" name="name" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Country Shotcode<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="shotcode" placeholder="uk" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Nationality<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="nationality" placeholder="nationality" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Upload Flag<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" name="flag" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Currency<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" name="currency" step="any" placeholder="$" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Upload Currency Icon<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="currencyIcon" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('admin.country.list')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection