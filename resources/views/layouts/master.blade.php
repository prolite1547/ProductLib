<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
   
</head>
<body>
    {{-- <div class="popup">
        <div class="popup__content">
             <h1>LOADING</h1>
        </div>
    </div> --}}
  <div class="loading">Loading</div>
   @include('layouts.modal')
   @include('layouts.navbar')
  
   
  
    <main role="main" class="container-fluid">
      
        @yield('main_content')
    </main>
    {{-- @include('sweet::alert') --}}
   <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>