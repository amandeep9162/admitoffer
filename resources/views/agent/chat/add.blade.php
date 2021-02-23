@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Application Conversation</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('studentQualificationGrades.store')}}">
                    @csrf
                  
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">New Qualification Grade<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div style="overflow: scroll;height:300px">
                                @foreach($messages as $message)
                                <p>meeee</p>  
                                @endforeach  
                                <input type="text" placeholder="grade" name="qualificationGrade" class="mb-2 form-control" required>
                            </div>
                            
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm float-right">Send</button>
                        <!-- <a href="{{route('studentQualificationGrades.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection