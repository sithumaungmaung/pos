<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ Config::get('app.sitetitle') }} : Login</title>

   <link rel="icon" type="image/png" href="{{ asset("assets/image/favicon.png") }}">
   <link href="{{ asset("bootstrap-3.1.1-dist/css/bootstrap.min.css") }}"  rel="stylesheet">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->
   <link href="{{ asset("foundation-icons/foundation-icons.css") }}"  rel="stylesheet">
   <link href="{{ asset("font-awesome-4.1.0/css/font-awesome.min.css") }}" rel="stylesheet" />
   <link href="{{ asset("bootstrap-3.1.1-dist/css/off-canvas.css") }}"  rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="{{ asset('pick-a-color/pick-a-color-1.2.3.min.css') }}">
   <link href="{{ asset("jquery/select2/select2.css") }}"  rel="stylesheet">
   <link href="{{ asset("jquery/pickadate/themes/classic.css") }}"  rel="stylesheet">
   <link href="{{ asset("jquery/pickadate/themes/classic.date.css") }}"  rel="stylesheet">
   <link href="{{ asset("jquery/pickadate/themes/classic.time.css") }}"  rel="stylesheet">

   @yield('style')

   <link href="{{ asset("assets/css/app.css") }}"  rel="stylesheet">


</head>
<body>
   @include('partials.topbar')

   <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">
         <div class="col-xs-12">


            @yield('content')
         </div>

         
      </div>
   </div>
   @include('partials.footer')
   
   
   <script src="{{ asset("jquery/jquery-1.11.0.min.js") }}"></script>
   <script src="{{ asset("bootstrap-3.1.1-dist/js/bootstrap.min.js") }}"></script>
   <script src="{{ asset("bootstrap-3.1.1-dist/js/html5shiv-3.7.0.js") }}"></script>
   <script src="{{ asset("bootstrap-3.1.1-dist/js/respond-1.4.2.min.js") }}"></script>
   <script type="text/javascript" src="{{ asset('pick-a-color/tinycolor-0.9.15.min.js')}}"></script>
   <script type="text/javascript" src="{{ asset('pick-a-color/pick-a-color-1.2.3.min.js')}}"></script>
   <script src="{{ asset("jquery/select2/select2.min.js") }}"></script>
   <script src="{{ asset("jquery/pickadate/picker.js") }}"></script>
   <script src="{{ asset("jquery/pickadate/picker.date.js") }}"></script>
   <script src="{{ asset("jquery/pickadate/picker.time.js") }}"></script>

   @yield('script')

   <script src="{{ asset("assets/js/app.js") }}"></script>
   
</body>
</html>
