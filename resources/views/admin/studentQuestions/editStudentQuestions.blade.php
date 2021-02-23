@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Edit Question</div>
                <div class="card-body">
                    @include('multiauth::message')
                   
                    <form method="POST" action="{{route('studentQuestions.update',$studentQuestion['id'])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Country<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select  class="mb-2 form-control" name="country_id">
                                <option value="">select Country</option>
                                @foreach($countries as $countrie)
                                <option value="{{$countrie['id']}}" {{ ($countrie['id'] == $studentQuestion['country_id']) ? 'selected' : '' }}>{{$countrie['name']}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Assign Question  <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                             <select  class="mb-2 form-control" name="question_id">
                                <option value=''>select Question</option>
                                @foreach($questions as $question)
                                <option value="{{$question['id']}}" {{ ($question['id'] == $studentQuestion['question_id']) ? 'selected' : '' }}>{{$question['question']}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                        <a href="{{route('studentQuestions.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection