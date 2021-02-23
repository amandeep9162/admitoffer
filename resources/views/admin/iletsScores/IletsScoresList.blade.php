@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Ielts Scores List &nbsp;
                    <span class="float-right">
                        <a href="{{route('iletsScore.create')}}" class="btn btn-sm btn-success">Add New Ielts Scores</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($iletsScores as $iletsScore)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $iletsScore->name }}</span>
                            <span class="text-center" >{{ $iletsScore->countries['name'] }}</span>
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $iletsScore->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $iletsScore->id }}" action="{{ route('iletsScore.destroy',[$iletsScore->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('iletsScore.edit',base64_encode($iletsScore->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($iletsScores->count()==0)
                        <p class="text-center">No Ilets Scores created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection