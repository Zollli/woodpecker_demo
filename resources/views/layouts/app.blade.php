<!DOCTYPE html>
<html lang="hu">

  <head>
    <meta charset="UTF-8">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Woodpicker_demo</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ filemtime('./css/main.css') }}">
  </head>

  <body>
    @yield('content')
  </body>

</html>
