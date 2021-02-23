@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add Qualification Level Grade</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('studentQualificationLevelGrades.store')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Qualification Level<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select  class="mb-2 form-control" name="qualification" required="">
                                <option value="">select Qualification Level</option>
                                @foreach($qualifications as $qualification)
                                <option value="{{$qualification['id']}}">{{$qualification['name']}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">New Qualification Grade<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select placeholder="grade" name="qualificationGrade" class="mb-2 form-control" required>
                            <option value="">select Qualification Level</option>
                                @foreach($qualificationGrades as $qualificationGrade)
                                <option value="{{$qualificationGrade['id']}}">{{$qualificationGrade['qualification_grade']}}</option>
                                @endforeach    
                            </select>    
                            
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('studentQualificationLevelGrades.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection