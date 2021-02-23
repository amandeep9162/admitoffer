@include('admitoffer._head') 
<style>
  #home
  {
  color:#e77817 !important;
  }
</style>
<body class="demo-1">
<div id="ip-container" class="ip-container">
<header class="ip-header">
				<h1 class="ip-logo">
					<div class="text-center"><img src="{{asset('admitoffer/img/logo.png')}}" alt="" title="" /></div>
				</h1>
				<div class="ip-loader">
					<svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
						<path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
						<path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
					</svg>
				</div>
			</header>
          </div>
  <!--==========================
    Header
  ============================-->
  @include('admitoffer.header') 

  <!--==========================
    Slider Section
  ============================-->
  
  <div class="home_banner">
    <div class="container">
       <!--<div class="row">
         <div class="col-12 col-sm-4 wow animated fadeInUp" data-wow-delay="2s">
           <h3>1. Discover Courses</h3>
         </div>
         <div class="col-12 col-sm-4 wow animated fadeInUp" data-wow-delay="2.5s">
           <h3>2. Shortlist</h3>
         </div>
         <div class="col-12 col-sm-4 wow animated fadeInUp" data-wow-delay="3s">
           <h3>3. Apply</h3>
         </div>
       </div>-->
       
       <div class="row mrg150">
          <div class="col-6 col-md-3 wow animated fadeInUp" data-wow-delay="3s">
             <div class="cir first float1">
                <h4>100+</h4>
                <p>Institutions <br>UK</p>
             </div>
          </div>
          <div class="col-6 col-md-3 wow animated fadeInUp" data-wow-delay="3.5s">
             <div class="cir second float2">
                <h4>50+</h4>
                <p>Streams</p>
             </div>
          </div>
          
          <div class="col-6 col-md-3 wow animated fadeInUp" data-wow-delay="4s">
             <div class="cir first float3">
                <h4>40,000 +</h4>
                <p>Courses</p>
             </div>
          </div>
          <div class="col-6 col-md-3 wow animated fadeInUp" data-wow-delay="4.5s">
             <div class="cir second float2">
                <h4>1500 +</h4>
                <p>Scholarships </p>
             </div>
          </div>
          
       </div>
       
       <!--<h1>The Power <br>
       to be <strong>Customer-Obsessed</strong></h1>
       <div class="btns">
         <a href="contact.php" class="btn2"><span>Get a demo</span></a>
         <a href="about.php" class="btn3"><span>Learn More</span></a>
       </div>-->
    </div>
  </div>
  
  

  <main id="main">

   <!--==========================
      Span1 Section
    ============================-->
   
     <div class="span1">
       <div class="container">
       <div class="wow animated fadeInUp" data-wow-delay="1s">
         <div class="heading text-center"><h2>Welcome to <strong>Admit</strong> Offer</h2></div>
         <div class="row">
           <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">  
         <div class="row">
         <div class="col-4 col-sm-4 wow animated fadeInUp" data-wow-delay="2s">
          <div class="hom1 text-center">
           <img src="{{asset('admitoffer/img/icon/001-reference.png')}}">
           <h3>Discover Courses</h3>
           </div>
         </div>
         <div class="col-4 col-sm-4 wow animated fadeInUp" data-wow-delay="2.5s">
         <div class="hom1 hom2 text-center">
         <img src="{{asset('admitoffer/img/icon/003-course.png')}}">
           <h3>Shortlist</h3>
          </div>
         </div>
         <div class="col-4 col-sm-4 wow animated fadeInUp" data-wow-delay="3s">
         <div class="hom1 hom3 text-center">
           <img src="{{asset('admitoffer/img/icon/005-test.png')}}">
           <h3>Apply</h3>
          </div>
         </div>
       </div>
     </div>
     </div>
         
         
         <div class="row" style="margin-top:30px;">
           <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 text-center">
             <p>AdmitOffer.com is an AI powered online exchange uniquely designed for international students and student recruiters to apply to the best institutions from around the world in a simple, functional, seamless, and cashless manner.</p>
           </div>
           </div>
         </div>
         <div class="row mrg80">
           <div class="col-12 col-md-4 wow animated fadeInUp" data-wow-delay="1.5s">
             <div class="box1">
               <div class="box1_icon"><img src="{{asset('admitoffer/img/Group3.png')}}"></div>
               <h4>About us</h4>
               <p>AdmitOffer.com is an AI powered innovative B2B online exchange that simplifies college admissions for international students</p>
               <a href="about.php">read more</a>
             </div>
           </div>
           
           <div class="col-12 col-md-4 wow animated fadeInUp" data-wow-delay="2s">
             <div class="box1">
               <div class="box1_icon"><img src="{{asset('admitoffer/img/Group1.png')}}"></div>
               <h4>AI enabled Technology Platform</h4>
               <p>AdmitOffer.com is an AI powered online exchange uniquely designed for international students and student recruiters</p>
               <a href="{{route('solution')}}#ai">read more</a>
             </div>
           </div>
           
           
           <div class="col-12 col-md-4 wow animated fadeInUp" data-wow-delay="2.5s">
             <div class="box1">
               <div class="box1_icon"><img src="{{asset('admitoffer/img/Group2.png')}}"></div>
               <h4>Ensuring Quality Compliances</h4>
               <p>Supernova's AI technology based checklists, benchmarks and processes ensures transparency and clarity protecting</p>
               <a href="{{route('solution')}}#ensure">read more</a>
             </div>
           </div>
           
           <div class="col-12 text-center"><a href="{{route('solution')}}" class="btn2"><span>Learn More</span></a></div>
           
         </div>
       </div>
     </div>
    
    

    <!--==========================
      About span2
    ============================-->
    
    <div class="span2">
      <div class="container">
      <div class="row">
       <div class="col-12 col-md-8 offset-md-2">
        <div class="text-center wow animated fadeInUp" data-wow-delay="1.5s">
          <img src="{{asset('admitoffer/img/desktop.png')}}">
        </div>
       </div>
      </div>
      </div>
    </div>
    
    <div class="span3">
      <?php /*?><div class="container">
        <div class="text-center heading">
          <h2>Top Universities</h2>
         <p>Powered by Admission Overseas Limited, Hong Kong</p>
         <h4>Authorized Representative of 500+ Universities</h4>
        </div>
      </div><?php */?>
     <?php /*?> <div class="mrg100"></div><?php */?>
      
      <?php /*?><div class="box3 owl-carousel2">
      
        <div class="box3_logo float1">
           <img src="{{asset('admitoffer/img/uk/1.jpg')}}">
        </div>
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/uk/2.jpg')}}">
        </div>
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/uk/3.jpg')}}">
        </div>
        
        
        <div class="box3_logo float1">
           <img src="{{asset('admitoffer/img/uk/4.jpg')}}">
        </div>
        
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/uk/5.jpg')}}">
        </div>
        
         <div class="box3_logo float2">
           <img src="{{asset('admitoffer/img/uk/6.jpg')}}">
        </div>
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/uk/7.jpg')}}">
        </div>
        
        <div class="box3_logo float3">
           <img src="{{asset('admitoffer/img/uk/8.jpg')}}">
        </div>
        
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/uk/9.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/10.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/11.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/12.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/13.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/14.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/15.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/16.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/17.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/18.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/19.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/20.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/21.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/22.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/23.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/uk/24.jpg')}}">
        </div>
        
       
        
       
        
      </div><?php */?>
       
       
      
      <?php /*?><div class="box3 box31 owl-carousel3">
      
        <div class="box3_logo float2">
           <img src="{{asset('admitoffer/img/canada/1.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/2.jpg')}}">
        </div>
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/canada/3.jpg')}}">
        </div>
        
        <div class="box3_logo float3">
           <img src="{{asset('admitoffer/img/canada/4.jpg')}}">
        </div>
        
        
        <div class="box3_logo">
           <img src="{{asset('admitoffer/img/canada/5.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/6.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/7.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/8.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/9.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/10.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/11.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/12.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/13.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/14.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/15.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/16.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/17.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/18.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/19.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/20.jpg')}}">
        </div>
        
        
        
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/21.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/22.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/23.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/24.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/25.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/26.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/27.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/28.jpg')}}">
        </div>
        
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/29.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/30.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/31.jpg')}}">
        </div>
        
        <div class="box3_logo ">
           <img src="{{asset('admitoffer/img/canada/32.jpg')}}">
        </div>
        
        
      </div><?php */?>
      
      
      <div class="container">
        <?php /*?><div class="mrg100"></div><?php */?>
        <div class="wow animated fadeInUp" data-wow-delay="1s">
         <div class="heading text-center"><h2>Our Mission </h2></div>
         <div class="row">
           
           <div class="col-12 col-md-8 offset-md-2 text-center abt">
             <p>It is our mission under the Newfoundland and Labrador's flagship technology innovation hub to ensure all our stakeholders - institutions, students, and independent student recruiters under one digital platform facilitating seamless communication and collaboration through excellent customer services following institutional and relevant government quality compliances.</p>
           </div>
         </div>
      </div>
      </div>
      
      
    </div>
    
    
       
     
       
    <!--==========================
      span3 Section
    ============================-->
      

  </main>

  <!--==========================
    Footer
  ============================-->
  @include('admitoffer.footer') 

 
</body>
</html>