<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Admit Offer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/stroke.css')}}" rel="stylesheet">
        <script src="https://use.fontawesome.com/72451ebe5b.js"></script>
        <link href="https://use.fontawesome.com/72451ebe5b.css" media="all" rel="stylesheet">
        <link href="{{ asset('css/signin.css')}}" rel="stylesheet">
        <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
        <link href="{{ asset('css/signup.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    </head>
    <body class="text-center signUpbody">
        @if(Session::has('success'))
            <div class="btn btn-success popOver float-right ">
                <div class="btn btn-success">
                    <strong class="text-white">Heads Up!</strong><span class="text-white"> {!!Session::get('success')!!}</span>
                </div>
            </div>
        @endif
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-10 offset-lg-1">
                    <div class="sec1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-12 col-lg-12 part1 border-radius10">
                                <a href="{{route('student.show',$id)}}" class="btn btn-danger float-right registerBackBtn"><i class="fa fa-arrow-left"></i> Back</a>
                                <div class="login_form">
                                    <a href="{{route('agent.login')}}"><img src="{{ asset('images/logo.png')}}"></a>
                                    <div class="small_txt">
                                        <!-- <p>Log in to most advanced Overseas Education Admission Portal.</p> -->
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li><small>{{ $error }}</small></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                  <style type="text/css">
                                    .text-center{
                                        text-align: center;
                                    }
                                    .width-30{
                                        width: 30%;
                                    }
                                    .jumbotron{
                                            background-color: #ffffff;
                                    }
                                    .jumbotron h1{
                                                font-size: 33px;
                                            color: #e77817;
                                            text-transform: uppercase;
                                            font-weight: 600;
                                            margin-bottom: 25px;
                                    }
                                    .jumbotron .lead{
                                                font-size: 17px;
                                    }

                                    .jumbotron p a {
                                                  color: #e77817;
                                    }
                                    .jumbotron p .btn-sm
                                    {
                                        margin-top: 20px;
                                        box-shadow: none;
                                        font-size: 17px;
                                        padding: 10px 30px;
                                        background-image: linear-gradient(-90deg, #a61a0a, #ff4104);
                                        color: #fff; 
                                        border:none;
                                    }
                                    #time{
                                      font-size: 30px;
                                    }
                                </style>
                                <div class="jumbotron ">
                                  <div class="text-center" ><img class="text-center width-30" src="{{asset('images/site/check.gif')}}"></div>
                                  
                                  <div class="row">
                                    <div class="col-sm-12 col-md-10 offset-md-1">

                                        <h1 class=" text-center">THANKS FOR PAYMENT </h1>
                                        <table>
                                            
                                            <thead>
                                                <!-- <tr>
                                                    <th colspan="3">Invoice</th>
                                                    <th>14 January 2025 
                                                </tr> -->
                                                <tr>
                                                    <td colspan="3"> <strong>Pay for:</strong></td>
                                                    <td colspan="3"> <strong>Fee:</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $Tamt = 0;
                                                ?>
                                               @foreach($applications as $application)
                                               <?php
                                                 $Tamt += (int)$application['amount'];
                                                ?>
                                                <tr>
                                                    <td>{{$application['college_name']}}</td>
                                                    <td class="float-right">{{$application['amount']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                               
                                                <tr>
                                                    <th colspan="3">Grand Total</th>
                                                    <td>{{$Tamt}}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                      <h5 class="lead text-center"><strong>“Note email it to <span class="text-warning">contact@admitoffer.com</span>”. </h5>
                                        <h6>Thank you</h6>
                                        <div>
                                          <span id="timer">
                                            <span id="time">Redirect in 10</span> Seconds      
                                          </span>
                                        </div>
                                      <hr>
                                      <p class="text-center ">
                                        Having trouble? <a href="{{route('contactus')}}">Contact us</a>
                                      </p>
                                    
                                     

                                    </div>
                                  </div>
                                  <div class="small_txt"><p>Connect with us on social media</p></div>
                                   <input type="hidden" name="student_id" id="student_id" value="{{$id}}">
                                    <div class="social_m">
                                        <ul>
                                            <li> <a href="https://www.facebook.com/Admit-Offer-104241471171700/?modal=admin_todo_tour" style="color:#3b5998"><i class="fa fa-facebook padding-top-10"></i></a></li>
                                            <li> <a href="https://www.instagram.com/admitoffer/" style="color:#dc4e41"><i class="fa fa-instagram padding-top-10"></i></a></li>
                                        </ul>
                                    </div>
                                  
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------- sec1 end --------->
                </div>
            </div>
            <div class="row loginRegisterFooter" >
                <div class="col-md-12">
                    <div class="footer text-center" >
                        <div class="small_txt">
                            <!-- <p>© Copyright 2019 . All Rights Reserved by Admit Offer Technologies Ltd.</p> -->
                            <p>© Copyright 2019 . All Rights Reserved by Supernova Edu Technologies Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('admins/js/custom.js')}}" ></script>
        <script type="text/javascript" src="{{ asset('admins/js/location.js')}}" ></script>
        <script>
            var student_id = $('#student_id').val();
            console.log(student_id);
            var counter = 10;
            var interval = setInterval(function() {
                counter--;
                // Display 'counter' wherever you want to display it.
                if (counter <= 0) {
                        clearInterval(interval);
                    $('#timer').html("<h3>Redirect...</h3>");  
                    return;
                }else{
                    $('#time').text(counter);
                
                }
            }, 1000);
            setTimeout(function(){
                
                window.location.href = '/agent/student/'+student_id;                                   
            }, 10000);

        </script>
    </body>
</html>