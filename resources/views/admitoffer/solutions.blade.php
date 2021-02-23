@include('admitoffer/_head')
<style>
  #solutions
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
     <div class="row">
      <div class="col-12 col-md-10 offset-md-1 abt">
       <div class="text-center"><h1>Solutions</h1>
       <p>AdmitOffer.com aims to streamline the market for International Student Admission through its AI enabled platform and following quality ensured compliances.  Our solution improves the admission process for our stakeholders including students and student recruiters and quality of applications and conversions for institutions.</p>
       </div>
     </div>
   </div>
    </div>
  </div>
  
  

  <main id="main">

   <!--==========================
      Span1 Section
    ============================-->
   
     <div class="span1" id="ai">
       <div class="container">
         
         <div class="row">
           <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 text-center">
             <div class="heading"><h2>AI enabled <strong>Technology</strong> Platform</h2></div>
             <p>AdmitOffer.com is an AI powered online exchange uniquely designed for international students and student recruiters to apply to the best institutions from around the world in a simple, functional, seamless, and cashless manner. </p>
             <p>Supernova's AI-based technology serves two objectives – automate the end to end process and develop system intelligence.</p>
           </div>
         </div>
         
         <div class="mrg80"></div>
         
         <div class="row">
           <div class="col-12 col-md-5">
              <img src="{{asset('admitoffer/img/Data_Management_Icon.svg')}}">
           </div>
           
           <div class="col-12 col-md-6 offset-md-1 abt">
              <div style="margin-top:30%"></div>
             <p><strong>Automation</strong>  will bring all stakeholders - institutions, students, and independent student recruiters under one digital platform facilitating seamless communication and collaboration. It will automate the end to end process.</p>
           </div>
           
         </div>
         
         <div class="mrg80"></div>
         
         
         <div class="row">
           <div class="col-12 col-md-5 order-md-2">
              <img src="{{asset('admitoffer/img/Artificial_Intelligence.svg')}}">
           </div>
           
           <div class="col-12 col-md-6 offset-md-1 abt order-md-1">
              <div style="margin-top:30%"></div>
             <p><strong>Artificial Intelligence</strong> algorithms creates a highly efficient and effective application solution for students, student recruiters and education providers which makes the student admission application process more accurate, consistent and less human dependent.</p>
           </div>
           
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
        <div class="text-center">
          <img src="{{asset('admitoffer/img/artificial-intelligence.png')}}">
        </div>
       </div>
      </div>
      </div>
    </div>
    
    <div class="span3" id="ensure">
      <div class="container">
         
         
        
         <div class="heading text-center"><h2>Ensuring Quality Compliances </h2></div>
         <div class="row">
           
           <div class="col-12 col-md-8 offset-md-2 text-center abt">
             <p>Supernova's AI technology based checklists, benchmarks and processes ensures transparency and clarity protecting institutions compliances increasing quality applications and conversions.</p>
           </div>
         </div>
         
      </div>
   
      
      <div class="left_pattern">
        <img src="{{asset('admitoffer/img/teal_right_pattern.png')}}">
      </div>
      
      <div class="right_pattern">
        <img src="{{asset('admitoffer/img/teal_left_pattern.png')}}">
      </div>
      
    </div>
    
    
       
     
       
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
