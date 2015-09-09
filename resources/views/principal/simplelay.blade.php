<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electronic Board</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/css/Popup-master/assets/css/popup.css')}}" rel="stylesheet">
    <script scr="{{asset('/css/Popup-master/assets/js/jquery.popup.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js" charset="utf-8"></script>
<!--Cambiar CSS de andon -->


    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body style="min-height: 100%; ">
    <div class="container-fluid">
        <br/>
        <div class="row">
            <div class="col-md-7  text-right">
                <img src="{{asset('/images/logo.png')}}" width="550px" height="90px"  >
            </div>
            <div class="col-md-3 text-left" style="font-size:70px"><b>{{Auth::user()->linea}} </b>
            </div>
            <div class="col-md-2 text-left" id="turno" style="font-size:40px;color:green">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <br/>
                <nav class="navbar navbar-default " style="background-color:#FFBF00; ">
                    <div class="container-fluid ">
                        <ul class="nav navbar-nav  navbar-center  ">
                            <li role="presentation"><a href="{{route('reporte.create')}}">Hora x Hora</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{route('dwcr.show')}}">Quejas de cliente</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{route('mccr.create')}}">MCCR</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{route('actionplan.show')}}">Plan de accion</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{route('jidoka.create')}}">Jidoka</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{route('fpy.create')}}">FPY</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{ route('oee.create') }}">OEE</a></li>
                            <li role="presentation"><a href="#">|</a></li>
                            <li role="presentation"><a href="{{ route('downtime.create') }}">Tiempos muertos</a></li>
                              <li role="presentation"><a href="{{route('excel.index')}}">Reportes</a></li>
                        </ul>
                        <ul class="nav navbar-nav  navbar-right">
                         <li role="presentation">  
                        <a data-toggle="modal" href="{{route('logout')}}"id="comments">Cerrar Sesion<span class="glyphicon glyphicon-off" aria-hidden="true">
                        </span></a>
                    </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div id="token" style="display:none">{{ csrf_token() }}</div>


@yield('content')

<!-- Scripts -->

@yield('scripts')
<script type="text/javascript">

/*FUNCTION: Para consultar en la BD de que color se debe mostrar el andon*/
    $(document).ready(function(){
        var token = $('#token').html();

        $.ajax({
            type: 'GET',
            url: '../getAndon',
            success:function(response){
                if(response.andon == 'green'){
                    $('body').css('border','30px solid #008000');
                }else if(response.andon == 'red')
                {
                    $('body').css('border','30px solid #FF0000');
                }else
                {
                    $('body').css('border','30px solid  #f4ea05');
                }
            }

        });

        $.ajax({
            type: 'GET',
            url: '../getTurno',
            success:function(response){
                $('#turno').html("Turno "+response.turno);
            }
        });

    });
</script>

</body>
</html>
