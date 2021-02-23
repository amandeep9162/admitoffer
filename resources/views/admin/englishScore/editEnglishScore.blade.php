@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Edit Ilets Score</div>
                <div class="card-body">
                    @include('multiauth::message')
                   
                    <form method="POST" action="{{route('englishScore.update',$englishScore['id'])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Ilets Score<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Score" name="score" class="mb-2 form-control" value="{{$englishScore['score']}}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                        <a href="{{route('englishScore.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection