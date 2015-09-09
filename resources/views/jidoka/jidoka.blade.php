@extends('principal/simplelay')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 text-right">
            <a data-toggle="modal" href="#stop" class="btn btn-danger btn-lg" aria-label="Left Align"> Paro no programado<span class="glyphicon glyphicon-pause" aria-hidden="true"></span></a>
    	</div>
        
        <div class="col-md-8 text-center" style="border: 1px solid black;box-shadow: 5px 5px 5px #888888;">
            <img src="{{asset($triangulo)}}" id="triangulo" width="800" height="600"></img>
        </div>
        
        <div class="col-md-2 text-left">
            <a data-toggle="modal" href="#restart" class="btn btn-success btn-lg" aria-label="Left Align">Continuar
            <span class="glyphicon glyphicon-play" aria-hidden="true"></span></a>
        </div>
    </div>
</div>

<br/>
<div id="token" style="display:none">{{ csrf_token() }}</div>

<div class="modal fade" id="stop">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Paro no programado</h3>
                    <div class="modal-body">
                        <div class="form">
                        {!!Form::open(array('route'=>'jidoka.store','method'=>'post'))!!}
                        Se iniciara un paro no programado, A que tipo de problema se debe el paro?
                       </div>
                        {!! Form::select('tipo',config('downtime.types'),null,['class'=>'form-control']) !!}
                    </div>
                    <div class="modal-footer">
                    {!! Form::submit('Aceptar', array('class'=>'btn btn-info'))!!}
                    {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restart">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Restablecer</h3>
                    <div class="modal-body">
                        <div class="form">
                        {!!Form::open(array('route'=>'reset','method'=>'post'))!!}
                          El paro programado ha finalizado?
                       </div>
                    </div>
                    <div class="modal-footer">
                    {!! Form::submit('Aceptar', array('class'=>'btn btn-info'))!!}
                    {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 @section('scripts')
    <script type="text/javascript">
   
    
        $(document).ready(function(){

     
                

                setInterval(function(){
                       var token = $('#token').html();
               
                var datos = {};
                datos['_token'] = token;
                datos['nombre'] = 'diego';
                $.ajax({
                    type:'POST',
                    url:'../refresh',
                    data: datos,
                    success:function(triangle){
                        
                        var newSrc = "{{asset('')}}";
                        newSrc = newSrc + triangle.message
                       
                        $('#triangulo').attr('src',newSrc);
                        $('#triangles').html(newSrc);
                    }
                });
            },5000);
             
        
        });

    </script>   
     @endsection