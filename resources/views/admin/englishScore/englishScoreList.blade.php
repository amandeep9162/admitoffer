@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                English Scores List &nbsp;
                    <span class="float-right">
                        <a href="{{route('englishScore.create')}}" class="btn btn-sm btn-success">Add New English Scores</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($englishScores as $englishScore)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $englishScore->score }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $englishScore->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $englishScore->id }}" action="{{ route('englishScore.destroy',[$englishScore->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('englishScore.edit',base64_encode($englishScore->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($englishScores->count()==0)
                        <p class="text-center">No English Scores created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection