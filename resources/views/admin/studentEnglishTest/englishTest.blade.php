@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                English Tests &nbsp;
                    <span class="float-right">
                        <a href="{{route('englishTest.create')}}" class="btn btn-sm btn-success">Add English Test</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($englishTests as $englishTest)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $englishTest->name }}
                            <span>  {{ $englishTest->country['name'] }}</span>
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $englishTest->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $englishTest->id }}" action="{{ route('englishTest.destroy',[$englishTest->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('englishTest.edit',base64_encode($englishTest->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($englishTests->count()==0)
                        <p class="text-center">No English Test created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection