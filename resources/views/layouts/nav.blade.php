
  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        @if(Auth::check())

        <a href="{{route('logout')}}"class="headerLink">تسجيل خروج</a>
        @else
        <a href="{{url('/ar/create_account')}}" class="headerLink">حساب جديد</a>
        <a href="{{url('/ar/login_account')}}"class="headerLink">تسجيل دخول</a>
        @endif
      </div>
      <div class="social-links d-none d-md-flex">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="">My<span>Store</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="/">My<span>Store</span></a> -->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{url('/')}}">الرئيسية</a></li>
          <!-- <li><a class="nav-link scrollto" href="#about">من نحن</a></li> -->
          <!-- <li><a class="nav-link scrollto" href="#services">الأنشطة التعليمية </a></li> -->
          <li><a class="nav-link scrollto " href="{{url('courses')}}">الدورات التدريبية</a></li>

          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a class="nav-link scrollto" href="#contact">اتصل بنا</a></li>
          @if(Auth::check())

          <li><a class="nav-link scrollto profileBtn" href="{{url('profile')}}">الملف الشخصي </a></li>
          @else
          <li><a class="nav-link scrollto profileBtn" href="{{url('create_account')}}">التحق بنا </a></li>
          @endif

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
