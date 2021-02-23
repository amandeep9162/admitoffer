@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Math Score List &nbsp;
                    <span class="float-right">
                        <a href="{{route('mathScore.create')}}" class="btn btn-sm btn-success">Add New Math Scores</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($mathScores as $mathScore)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $mathScore->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $mathScore->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $mathScore->id }}" action="{{ route('mathScore.destroy',[$mathScore->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('mathScore.edit',base64_encode($mathScore->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($mathScores->count()==0)
                        <p class="text-center">No Math Score created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection