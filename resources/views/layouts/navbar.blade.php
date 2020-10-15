{{--  
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Product Library</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavAltMarkup">
      <div class="navbar-nav">
          <a class="nav-item nav-link nav-link__main" href="#">Home</a>
          <a class="nav-item nav-link nav-link__main {{in_array(Route::currentRouteName(),$productRoute) ? 'nav-link__active' : ''}}" href="{{ route('products.view') }}">Products</a>
          <a class="nav-item nav-link nav-link__main " href="#">Reports</a>
      </div>
     
      <div class="dropdown">
        <a class="nav-link nav-link__main dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->fname }}
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
         
           <a class="dropdown-item"  href="#" id="logoutMenu">{{ __('Logout') }}</a>
           <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="" method="POST" style="display: none;">
          @csrf
          </form>
        </div>
      </div>
     
    </div>
  </nav>    
  
  <div class="nav-scroller bg-white shadow-sm mb-5">
    <nav class="nav nav-underline">
      <a class="nav-link nav-link__sublink {{in_array(Route::currentRouteName(),$prodListRoute) ? 'nav-link__sublink--active' : ''}}  " href="{{ route('products.view') }}">Product List</a>
      <a class="nav-link nav-link__sublink dropdown-toggle {{in_array(Route::currentRouteName(),$manageProdRoute) ? 'nav-link__sublink--active' : ''}}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Manage Product
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="{{ route('addproduct.view') }}">Add New Product</a>
         <a class="dropdown-item" href="#">Update Product</a> 
      </div>
    </nav>
    
  </div>
   --}}

   <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            Product Library
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    {{-- <a class="nav-item nav-link nav-link__main" href="#">Home</a> --}}
                    <a class="nav-item nav-link nav-link__main {{in_array(Route::currentRouteName(),$productRoute) ? 'nav-link__active' : ''}}" href="{{ route('products.view') }}">Products</a>
                    <a class="nav-item nav-link nav-link__main {{in_array(Route::currentRouteName(),$reportsRoute) ? 'nav-link__active' : ''}}" href="{{ route('report.view') }}">Reports</a>
                     
                   @if (Auth::user()->role_id == 1)
                       <a class="nav-item nav-link nav-link__main {{in_array(Route::currentRouteName(),$registerRoute) ? 'nav-link__active' : ''}}" href="{{ route('register') }}">Registration</a>
                   @endif
                @endauth
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->uname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@auth
  @if (in_array(Route::currentRouteName(),$productRoute))
      <div class="container-fluid">
          <div class="nav-scroller bg-white shadow-sm mb-5">
              <nav class="nav nav-underline">
                <a class="nav-link nav-link__sublink {{in_array(Route::currentRouteName(),$prodListRoute) ? 'nav-link__sublink--active' : ''}}  " href="{{ route('products.view') }}">Product List</a>
                <a class="nav-link nav-link__sublink dropdown-toggle {{in_array(Route::currentRouteName(),$manageProdRoute) ? 'nav-link__sublink--active' : ''}}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Manage Product
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('addproduct.view') }}">Add New Product</a>
                  {{--  <a class="dropdown-item" href="#">Update Product</a>  --}}
                </div>
              </nav>
              
            </div>
      </div>
  @endif
@endauth