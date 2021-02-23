@include('admitoffer/_head')

<style>

  #contact

  {

  color:#e77817 !important;

  }

</style>

<body>

  <!--==========================

    Header

  ============================-->

  @include('admitoffer/header')



  <!--==========================

    Slider Section

  ============================-->

  

  <div class="banner">

    <div class="container">

       <div class="text-center"><h1>Contact us</h1></div>

       

    </div>

  </div>

  

  



  <main id="main">



   <!--==========================

      Span1 Section

    ============================-->

   

     <div class="span1">

       <div class="container">

         

         <div class="row">

           <div class="col-12 col-md-5">

             <div class="con1">

             <h4>Supernova Edu Technologies Inc.</h4>

              <ul>

                <li><i class="flaticon-placeholder"></i> Genesis Centre, 100 Signal Hill Rd #0100, St. John's, NL A1A 1B3, Canada</li>

              <li><i class="flaticon-call"></i> <a href="#">(+682) 55202 </a></li>

              <li><i class="flaticon-mail"></i> <a href="#">contact@admitoffer.com </a></li>

            </ul>

             </div>

           </div>

           

           <div class="col-12 col-md-7">

              <div class="con2">

                 <form action="query.php" method="post" class="cmxform" id="commentForm" novalidate="novalidate">

                

                 <div class="row">



				        <div class="col-xs-12 col-sm-6 pd15">



							



                            <div class="input"><input type="text" name="name" class="form-control cont" required="" placeholder="Your Name*"></div>



						</div> 



						 <div class="col-xs-12 col-sm-6 pd15">



							



                            <div class="input"><input type="text" name="phone" class="form-control cont" required="" placeholder="Phone*"></div>

                           </div>



							



						<div class="col-xs-12 col-sm-12 pd15">

                           



                            <div class="input"><input type="email" name="email" class="form-control cont" required="" placeholder="Email Address*"></div>

                           </div>



						  <div class="col-xs-12 col-sm-12 pd15">



						 



                          <div class="input"><textarea name="msg" class="form-control cont" style="height:130px; resize:none;" placeholder="Message"></textarea></div>

                          <input type="hidden" name="page" value="contact.php">



						 </div> 

                         <div class="col-xs-12 pd15"><button type="submit" class="btn2"><span>Send a message</span></button></div>

                      </div>

                     </form>

              </div>

           </div>

           

         </div>

         

       </div>

     </div>

    

    



    <!--==========================

      About span2

    ============================-->

    

    

    

    

    

    

       

     

       

    <!--==========================

      span3 Section

    ============================-->

      



  </main>



  <!--==========================

    Footer

  ============================-->

  @include('admitoffer/footer')



 

</body>

</html>

