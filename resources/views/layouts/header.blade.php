<header class="container-fluid px-0">
    <!-- Logo and Title Row -->
    <div class="d-flex align-items-center" style="background-color: #FFFFF0; padding: 10px 0;">
      <!-- Logo on the far left -->
      <div class="ms-3 me-3">
        <a href="{{route('home')}}"><img src="{{ asset('images/stsmflogo.png') }}" alt="STSMF Logo" 
             style="height: 130px; min-height: 70px; object-fit: contain;"></a>
      </div>
      <!-- Title -->
      <h1 class="text-center flex-grow-1 mb-0" 
          style="font-family: 'Playfair Display', serif; color: #002366; padding-right: 90px;">
        Syedna Taher Saifuddin Memorial Foundation
      </h1>
    </div>
    
    <!-- Original Navbar (unchanged) -->
    <nav class="navbar navbar-expand-lg" style="background-color: #FFFFF0; border-bottom: 2px solid #D4AF37;">
        <div class="container-fluid">
            <!-- Empty left space -->
            <div class="navbar-brand d-none d-lg-block"></div>
            
            <!-- Hamburger menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    style="border-color: #002366;">
                <span class="navbar-toggler-icon" style="color: #002366;"></span>
            </button>
            
            <!-- Nav content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Centered links -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{route('home')}}" 
                           style="color: #002366; font-weight: bold;"
                           onmouseover="this.style.color='#50C878'" 
                           onmouseout="this.style.color='#002366'">Home</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{route('loginForm')}}" 
                           style="color: #002366; font-weight: bold;"
                           onmouseover="this.style.color='#50C878'" 
                           onmouseout="this.style.color='#002366'">Login</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{route('registerForm')}}" 
                           style="color: #002366; font-weight: bold;"
                           onmouseover="this.style.color='#50C878'" 
                           onmouseout="this.style.color='#002366'">Register</a>
                    </li>
                </ul>
                
                <!-- Right-aligned button -->
                <div class="d-flex my-2 my-lg-0">
                    <a href="{{route('submit')}}" class="btn" 
                       style="background-color: #D4AF37; color: #FFFFF0; font-weight: bold; text-transform: uppercase;"
                       onmouseover="this.style.backgroundColor='#50C878'; this.style.transform='scale(1.05)'" 
                      onmouseout="this.style.backgroundColor='#D4AF37'; this.style.transform='scale(1)'">Submit Result</a>
                </div>
            </div>
        </div>
    </nav>
  </header>