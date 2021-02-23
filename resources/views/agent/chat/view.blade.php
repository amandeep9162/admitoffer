@extends('agent.layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Application Conversation History</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-3 chatSidebar">
                            <div class="chatSidebarName">
                                {{$application->course['name']}}
                            </div>
                        </label>
                        <div class="col-sm-9">
                            <div style="overflow: scroll;height:400px">
                                <div class="">
                                    @foreach($messages as $message)
                                    <p>meeee</p>  
                                    @endforeach
                                </div>  
                                <div class="row ">
                                    <div class=" col-md-12 chatInput">
                                    <form method="POST" class="chatRequestFormAgent">
                                    @csrf
                                    <div class=" row">
                                        <div class="col-md-10 ">
                                            <input type="hidden" name="application_id" value="{{$application['id']}}">
                                            <input type="text" placeholder="Enter Message" name="message" class="mb-2 form-control" required>
                                        </div>  
                                        <div class="col-md-2 ">
                                            <button type="submit" class="btn btn-success ">Send</button>
                                        </div>  
                                    </div>  
                                </form>  
                                    </div>  
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                        <!-- <button type="submit" class="btn btn-info btn-sm float-right">Send</button> -->
                        <!-- <a href="{{route('studentQualificationGrades.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('addjavascript')
<script>
setInterval(function() { 
        var application_id = $('.application_id').val();  
        $.ajax(
        {
            type:'get',
            url:'/admin/chat/edit/'+application_id,
            success:function(result)
            {
                $('.appendAllMessage').html('');
                console.log(result);
                $.each(result.data, function(index, value) {
                    if(value.type === 'admin'){
                        $('.appendAllMessage').append("<div class='row'> <div class='col-md-12'> <div class='max-width-420 float-right mr-10'> <p class='lineBarRight'><strong>Admin: </strong>"+value.message+"</p> </div> </div> </div>");
                    } else{
                        console.log('hello');
                        $('.appendAllMessage').append("<div class='row'> <div class='col-md-12'> <div class='max-width-420'> <p class='lineBar'><strong>Agent: </strong>"+value.message+"</p> </div> </div> </div>");
                    }
                });
                    $('.scrollBottom').animate({scrollTop: 9349}, 'slow');
                
            },
        });
    }, 1000 * 60 * 0.2);
</script>
@endsection