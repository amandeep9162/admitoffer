@include('admitoffer/_head')
<style>
  #about
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
       <div class="text-center"><h1>About us</h1></div>
       
    </div>
  </div>
  
  

  <main id="main">

   <!--==========================
      Span1 Section
    ============================-->
   
     <div class="span1">
       <div class="container">
         
         <div class="row">
           <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 text-center">
             <p>AdmitOffer.com is an AI powered innovative B2B online exchange that simplifies college admissions for international students and student recruitment agents to post-secondary institutions in UK.</p>
           </div>
         </div>
         <div class="row mrg80">
           <?php /*?><div class="col-12 col-md-6">
             <div class="box1">
               <div class="box1_icon"><img src="{{asset('admitoffer/img/Group4.png')}}"></div>
               <h4>Designed & Developed </h4>
               <p>Admit Offer.com is owned, designed and developed by Supernova Edu Technologies Inc., incorporated in Canada and powered by Admission Overseas Ltd, Hong Kong, India a leading international student recruitment organization with affiliation of more than 200 + Universities and Colleges worldwide.</p>
               
             </div>
           </div><?php */?>
           
           <div class="col-12 col-md-6 offset-md-3">
             <div class="box1">
               <div class="box1_icon"><img src="{{asset('admitoffer/img/Group1.png')}}"></div>
               <h4>Supernova Edu Technologies Inc</h4>
               <p>Supernova Edu Technologies Inc. is an edutech startup company incubated out of the Genesis Centre based in St. John's, Province of Newfoundland and Labrador, Canada.  Genesis Centre is Memorial University's award-winning pre-eminent innovation hub for technology in the Atlantic region of Canada  supported by the Federal Government of Canada towards the Atlantic Growth Strategy, which was first announced in 2017 and is the Memorial University's support network for tech-based businesses. </p>
              
             </div>
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
          <img src="{{asset('admitoffer/img/desktop.png')}}">
        </div>
       </div>
      </div>
      </div>
    </div>
    
    <div class="span3">
      <div class="container">
         <div class="row">
           <div class="col-12 col-md-12 abt">
             <p>The Genesis Centre accelerate start-ups through all stages of idea development - from pre-incubation and business model development, to investor readiness.  They connect portfolio companies with top mentors and advisors, along with marketing, funding, office space and technical resources to help them succeed.  The goal of the Genesis Centre is to help entrepreneurs commercialize their ideas and to help build amazing companies in Newfoundland and Labrador.</p>
             
             <p>Admission to the Genesis Centre is competitive and focuses on entrepreneurs who are pursuing technology-based businesses with high growth potential. The Centre is not just for students. It's a vibrant community of entrepreneurs who have demonstrated that they can drive a venture in its early stages. Admission to the Genesis Centre is based on an assessment of the entrepreneur, the technology, and the growth potential of the proposed venture.</p>
             
             <p>Since the Genesis Centre was founded in 1997, the Centre's flagship incubation program, Enterprise, has helped over 70 start-ups raise over $90 million in private equity. Genesis alumni are among some of the top companies in Canada including, Verafin, Rutter Technologies, Avalon Microelectronics (acquired by Altera), Solace Power, EMSAT, ClearRisk, Genoa Design and Virtual Marine Technology.</p>
             
           </div>
         </div>
         
         <div class="mrg100" id="mission"></div>
         <div class="heading text-center"><h2>Our Mission </h2></div>
         <div class="row">
           
           <div class="col-12 col-md-8 offset-md-2 text-center abt">
             <p>It is our mission under the Newfoundland and Labrador's flagship technology innovation hub to ensure all our stakeholders - institutions, students, and independent student recruiters under one digital platform facilitating seamless communication and collaboration through excellent customer services following institutional and relevant government quality compliances.</p>
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
