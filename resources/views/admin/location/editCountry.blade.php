@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Country</div>
                <div class="card-body">
                @include('multiauth::message')
                    <form action="{{ route('admin.country.Update',$country['id']) }}" method="post" enctype="multipart/form-data"> 
                        @csrf @method('patch')
                        <div class="form-group row">
                            <label for="role" class="col-sm-2">Country Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                            <input type="text" value="{{ $country['name'] }}" name="name" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-2">Country shotcode<span class="text-danger">*</span></label>
                            <div class="col-sm-10">    
                                <input type="text" value="{{ $country['shotcode'] }}" name="shotcode" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-2">Country Nationality<span class="text-danger">*</span></label>
                            <div class="col-sm-10">    
                                <input type="text" value="{{ $country['nationality'] }}" name="nationality" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Upload Flag<span class="text-danger">*</span></label>
                            @if($country['path'])
                            <div class="col-sm-7">
                                <input type="file" name="flag" class="mb-2 form-control" >
                            </div>
                            <div class="col-sm-3">
                                <img src="{{asset($country['path'].'/'.$country['image_name'])}}" width="20%">
                            </div>
                            @else  
                            <div class="col-sm-10">
                                <input type="file" name="flag" class="mb-2 form-control" required>
                            </div> 
                            @endif   
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Currency<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" name="currency" value="{{ $country['currency'] }}" placeholder="$" class="mb-2 form-control" step="any" required>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <label for="input-id" class="col-sm-2">Upload Currency Icon<span class="text-danger">*</span></label>
                            @if($country['currency'])
                            <div class="col-sm-10">
                                <input type="text" name="currencyIcon" class="mb-2 form-control" value="{{$country['currency_icon_name']}}" required>
                            </div>
                            <!-- <div class="col-sm-3">
                                <img src="{{asset($country['currency_icon_path'].'/'.$country['currency_icon_name'])}}" width="20%">
                            </div> -->
                            @else
                            <div class="col-sm-10">
                                <input type="text" name="currencyIcon" class="mb-2 form-control" required>
                            </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Change</button>
                        <a href="{{route('admin.country.list')}}" class="btn btn-danger btn-sm float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection