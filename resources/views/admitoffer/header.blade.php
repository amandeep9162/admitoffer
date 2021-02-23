<header id="header">
    <div class="container">
      <div id="logo" class="pull-left">
        <!--<h1><a href="#intro" class="scrollto">Yazu</a></h1>-->
        <!-- Uncomment below if you prefer to use an image logo -->
         <a href="{{route('home')}}"><img src="{{asset('admitoffer/img/logo_light.png')}}" alt="Logo" title="" class="logo1" /></a>
         <a href="{{route('home')}}"><img src="{{asset('admitoffer/img/logo.png')}}" alt="Logo" title="" class="logo2" /></a>
      </div>

      <nav id="nav-menu-container" class="main-nav float-right">
        <ul class="nav-menu">
          <li><a href="{{route('home')}}" id="home">Home</a></li>
         <!-- <li class="menu-has-children"><a href="">About us</a>
            <ul>
              <li><a href="#">About us</a></li>
              <li><a href="#">Our Boats</a></li>
              <li><a href="#">Our Team</a></li>
              <li><a href="#">Our Office</a></li>
              
            </ul>
          </li>-->
          
          <li><a href="{{route('aboutus')}}" id="about">About</a></li>
          
          <li><a href="{{route('solution')}}" id="solutions">Solutions</a></li>
          <li><a href="{{route('gallery')}}" id="gallery">Gallery</a></li>
          <li><a href="{{route('contactus')}}" id="contact">Contact</a></li>
          <li><a href="{{route('webinars')}}" id="webinars">Webinars</a></li>
            <li class="last"><a href="{{route('applicant.login')}}" target="_blank"> <span>Student Login</span></a></li>
          <li class="last"><a href="{{route('agent.login')}}" target="_blank"> <span>Agent Login</span></a></li
          
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>