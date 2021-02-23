@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add New Question</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('Questions.store')}}">
                    @csrf
                   
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Add New Question  <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                             <input type="text"  class="mb-2 form-control" name="question">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Question For Country<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select  class="mb-2 form-control" name="country_id" required>
                                <option value=''>select Country</option>
                                @foreach($countries as $countrie)
                                <option value="{{$countrie['id']}}">{{$countrie['name']}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('Questions.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection