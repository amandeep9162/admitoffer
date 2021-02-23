<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Razorpay Payment Gateway - Admitoffer.com</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<style type="text/css">
	#header {
    background: #da251d!important;
    color: #FFFFFF;
}
</style>
</head>
<body>
<div class="container">
	<form>
		
<input type="hidden" name="student_id" id="student_id" value="{{$student_id}}">
<input type="hidden" name="amount" id="amount" value="{{$amount}}">

	</form>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var SITEURL = '{{URL::to('')}}';
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
}); 
$(document).ready( function(e){
var totalAmount = {{$amount}};
var student_id =  {{$student_id}};
var countryDollar =  {{$country['currency']}};

var options = {
"key": "rzp_test_wo98zqdwbMu4n3",
"amount": (totalAmount*countryDollar*100), // 2000 paise = INR 20
"name": "Admitoffer",
"description": "Payment",
"image": "https://admitoffer.com/images/logo.png",
"handler": function (response){
$.ajax({
url: SITEURL + '/agent/paysuccess',
type: 'post',
dataType: 'json',
data: {
razorpay_payment_id: response.razorpay_payment_id , 
totalAmount : totalAmount ,student_id : student_id,
}, 
success: function (msg) {
	var stdId = msg.student_id;
 			$body = $("body");
                    $body.addClass("loading");
			$.ajax({   
				type: "GET",
				url: "/agent/student/completeApplication/"+msg.student_id,
				success: function(response){

				    $body.removeClass("loading"); 
				   
				    console.log('id');
				    if(response.countryId == '38'){
				        
				        if(response.true != 'true'){
				    
				            if(response.amount){
				                
				                if(response.amount > 0){
				                    window.location.href = '/agent/payment/'+btoa(response.student_id)+'/'+btoa(response.amount);

				                }
				            }else{

				            $('#completeApplication').show();
				              $('.modal-backdrop').css('position','inherit');
				              $('.finalPop').click();
				              $('.modal-backdrop').css('position','inherit');
				              setTimeout(function(){
				              $('.modal-backdrop').css('position','inherit');
				                
				            }, 1000);
				            }	
				        }
				    }
				    
				    if(response.true == 'true'){
				     
				        $('#completeApplication').hide();
						window.location.href = SITEURL + '/agent/razor-thank-you/'+btoa(stdId);
				       
				    }                   
				                       
				}

			});

// window.location.href = SITEURL + '/agent/razor-thank-you';
}
});
},
"prefill": {
"contact": '9915034645',
"email":   'amandeep9162@gmail.com',
},
"theme": {
"color": "#528FF0"
}
};
var rzp1 = new Razorpay(options);
rzp1.open();
// e.preventDefault();
});
/*document.getElementsClass('buy_plan1').onclick = function(e){
rzp1.open();
e.preventDefault();
}*/
</script>
</body>
</html>