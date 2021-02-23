@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "><div class="col-md-7">Commission Structure</div>
                   
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('commission.store')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- @method('PUT') -->
                        
                        <div class="form-group row">  
                            <div class="col-sm-12">
                                <textarea class="form-control " id="editor"  rows="4" cols="50" name="commission" >{{$commission['commission']}}</textarea>
                            </div>
                        </div>
                       <input type="hidden" name="country" value="{{$commission['country_id']}}">
                       <input type="hidden" name="type" value="{{$commission['type']}}">
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        </div> 
                           
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('addjavascript')
<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
<script type="text/javascript">
       ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
         ClassicEditor
        .create( document.querySelector( '#editorEntry' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection