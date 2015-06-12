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
<body class="user-login">

@if(!isset($error))
@endif

   <div class="login-form">
      <div class="container">
         <div class="col-md-4 col-md-offset-4">
            <div class="row">
               <div class="col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                  <div class="row">
                     <h4><i class="glyphicon glyphicon-log-in"></i> LOG IN</h4>
                     <hr>
                     {{ Form::open(["url" => route("users.postlogin"), 'method' => 'post', 'class' => 'form-vertical']) }}

                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fi-at-sign"></i></span>
                           {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) }}
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fi-key"></i></span>
                           {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                     </div>
                     <div class="form-group text-right">
                        <button class="btn btn-success" type="submit">
                           <i class="glyphicon glyphicon-log-in"></i>
                           <i class="hidden fa fa-gear fa-spin"></i>
                           <i class="hidden fa fa-check"></i> Log In
                        </button>
                     </div>
                     {{ Form::close() }}

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

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


   <script type="text/javascript">
      $(function(){
         $("form button").on('click', function(ev){
            ev.preventDefault(true);

            $.ajax({
               url: '{{ route('users.postlogin') }}',
               data: $('form').serialize(),
               dataType: 'jsonp',
               type: 'post',
               beforeSend: function(){
                  $('form i.glyphicon-log-in').addClass('hidden');
                  $('form i.fa-gear').removeClass('hidden');
               }
            })
            .fail(function(xhr, textStatus, thrownError){
               console.log(xhr);
               console.log(textStatus);
               console.log(thrownError);
            })
            .done(function(data, xhr, textStatus){
               $('form i.glyphicon-log-in').addClass('hidden');
               $('form i.fa-gear').addClass('hidden');
               console.log(data.status);
               if(data.status == 'success') {
                  $('form i.fa-check').removeClass('hidden');
                  window.location.reload();
               } else {
                  $('form i.fa-gear').addClass('hidden');
                  $('form i.fa-check').addClass('hidden');
                  $('form i.glyphicon-log-in').removeClass('hidden');
               }
            });
         });
});
</script>
</body>
</html>
