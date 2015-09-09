<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body style="border:none;">
 <div class="container-fluid">
        <br/>
       <div class="row">    
            <div class="col-md-10  text-left">
                <img src="{{asset('/images/logo.png')}}" width="550px" height="90px"  >
            </div>
            <div class="col-md-2" style="font-size:12px;"> 
                <br><br><br><br>
                <a data-toggle="modal" href="#nuevo" class="btn btn-warning">
                    Registrate <span class="glyphicon glyphicon-edit" aria-hidden="true">
                    </span>
                </a>
            </div>
        </div>
        <br>
        <div class="row" style="background-color:black; height:20px; border-bottom: 5px solid #FFBF00;">
            <div class="col-md-12"></div>
        </div>
    <br><br>
</div>

@yield('content')


</div>
<!-- Scripts -->

<div class="modal fade" id="prodreal">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Editar</h3>
                    <div class="modal-body">
                        <div class="form">
                        {!!Form::open(array('route'=>'updateproduction','method'=>'post'))!!}
                        {!! Form::label('user','Usuario:')!!}
                        <br>
                        {!! Form::text('username','',array('class'=>'form-control','required'=>'required'))!!}
                        <br><br>
                        {!! Form::label('pass','Contraseña:')!!}
                        <br>
                        {!! Form::password('pass',['class'=>'form-control','required'=>'required'])!!}
                       </div>
                    </div>
                    <div class="modal-footer">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-info'))!!}
                    {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
