@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Apply For Abroad</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row"> 
                            <div class="col-sm-5"> 
                                    <label for="input-id" class="col-sm-12 ">Student<span class="text-danger">*</span> </label>
                            <select class="mb-2 form-control" name="student"  required>
                                <option value=''> Select student</option>
                                @foreach($students as $student)
                                <option value="{{$student['id']}}">{{$student['name']}}</option>
                                @endforeach
                            </select>
                        </div>    
                     
                        <div class="col-sm-5"> 
                            <label for="input-id" class="col-sm-12 ">Country<span class="text-danger">*</span> </label>
                            <select class="mb-2 form-control" name="country_id"  required>
                                <option value=''> Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}">{{$country['name']}}</option>
                                @endforeach
                                
                            </select>
                        </div>    
                        <div class="col-md-2">
                            
                            <label for="input-id" class="col-sm-12 ">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-sm">Apply For</button>
                            <!-- <a href="{{route('files.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                        </form>
                    </div>      
                </div   >  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
