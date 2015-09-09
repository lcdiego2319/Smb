<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('/css/admin.css')}}" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->

    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
        <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if  you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="border:none;">
<div class="banner col-lg-12 responsive">
    <div class="linename col-md-5"></div>
    <img src="{{asset('/images/logo.png')}}" class="col-lg-4 nuevo">
</div>
<div class="container col-lg-12 responsive">
<ul class="nav nav-tabs nav-justified">
    <li role="presentation"><a href="{{route('lineas.admin.create')}}">Lineas</a></li>
    <li role="presentation"><a href="{{route('partes.admin.create')}}">Partes</a></li>

</ul>
<a data-toggle="modal" href="{{route('logout')}}" class="btn btn-danger  nuevo" id="comments">
    Cerrar Sesion<span class="glyphicon glyphicon-off" aria-hidden="true">
             </span></a>
</div>

@section('content')

@stop

@yield('scripts')
</body>
</html>
