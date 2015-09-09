@extends('principal/simplelay')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <table class="table table-striped table-bordered warning" style="font-size:16px;">
                <tr>
                    <th class="col-md-1 warning">Hora</th>
                    <th class="col-md-1 warning"> Produccion<br>programada </th>
                    <th class="col-md-1 warning">Produccion <br> Real</th>
                    <th class="col-md-1 warning">Produccion <br>acumulada</th>
                    <th class="col-md-1 warning">Rechazadas </th>
                    <th class="col-md-3 warning">Comentarios</th>
                </tr>
                @if(count($partescol) > 0)
                
                @foreach($partescol as $partes)
                <tr id="{{$partes->id_reporte}}">
                    <td>{{substr($partes->horai, 0, 5)}}-{{substr($partes->horaf, 0, 5)}}</td>
                    <td>{{$partes->pzsprog}}</td>
                    <td id="producidas">{{$partes->pzsprod}}<a data-toggle="modal" href="#prodreal" class="btn btn-default  btn-xs" id="real"
                         data-id-action="{{$partes->id_reporte}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        </td>
                    <td>{{$partes->pzsacum}}</td>
                    <td id="malas">{{$partes->pzsmalas}}<a data-toggle="modal" href="#pzsmalas" class="btn btn-default  btn-xs" id="malas" data-id-action="{{$partes->id_reporte}}">
                         <span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span></a>
                        </td>
                    <td id="comentarios">{{$partes->comentarios}}<a data-toggle="modal" href="#coment" class="btn btn-default  btn-xs" id="comments"
                         data-id-action="{{$partes->id_reporte}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    </td>
                </tr>
                @endforeach
           
          @else
           <tr>
                <td class="alert alert-success" colspan="6">No se encuentra ningun reporte de produccion</td>
            </tr>
          @endif    
           </table>
            <a data-toggle="modal" href="#nuevo" class="btn btn-warning btn-lg">Nuevo Registro 
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        </div>
    </div>
</div>

<div class="modal fade " id="nuevo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#FFBF00">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h2 class="modal-tittle">Nuevo registro</h2>
                </div>
                
                <div class="modal-body">  
                     {!! Form::open(array('route'=> 'reporte.store','class'=>'form','method'=>'post','id'=>'formNuevo'))!!}
                    <div class="form-group input-lg">
                        {!! Form::label('Hora')!!}
                        <br>
                        {!! Form::text('hora',date("H:i"),array('class'=>'responsive form-control','id'=>'inputHora'))!!}
                        <div class="alert alert-danger" id="alert" style="display:none" role="alert">Este campo es obligatorio.</div>
                    </div>

                     <br><br>
                    <div class="form-group input-lg">
                         {!! Form::label('Num.Parte')!!}
                        <br>
                        <select class="form-control" name="numparte">
                        @foreach($npartes as $nparte)
                            <option value="{{$nparte->numparte}}">{{$nparte->numparte}}</option>
                        @endforeach
                        </select>
                    </div>
                  {!! Form::hidden('programadas','valor')!!}
                    <br><br>
                </div>
            
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 text-center" >
                            {!! Form::submit('Guardar', array('class'=>'btn btn-warning'))!!}
                            {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="prodreal">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header" style="background-color:#FFBF00">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Editar</h3>
                </div>
                
                <div class="modal-body">
                    <div class="form">
                        {!!Form::open(array('route'=>'updateproduction','method'=>'post','id'=>'formProduccion'))!!}
                        <div class="form-group input-lg">
                        {!!Form::label('Produccion real:')!!}
                        {!!Form::input('number','nuevo',null,array('class'=>'form-control','id'=>'numero'))!!}
                         <div class="alert alert-danger" id="alertProduccionReal" style="display:none" role="alert">Este campo es obligatorio.</div>
                         {!! Form::hidden('idlinea',Auth::user()->linea) !!}
                        {!!Form::hidden('idp','',array('id'=>'idp'))!!}
                        {!! Form::hidden('hora',date("H:i"))!!}
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 text-center" >
                            {!! Form::submit('Guardar', array('class'=>'btn btn-warning'))!!}
                            {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    
    <div class="modal fade" id="pzsmalas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"  style="background-color:#FFBF00">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Editar</h3>
                </div>
                
                <div class="modal-body">
                    <div class="form">
                        {!!Form::open(array('route'=>'updatefails','method'=>'post','id'=>'formRechazadas'))!!}
                        <div class="form-group input-lg">
                            {!!Form::label('Piezas Rechazadas:')!!}
                            {!!Form::input('number','nuevo',null,array('class'=>'form-control', 'id'=>'numberoRechazadas'))!!}
                            <div class="alert alert-danger" id="alertPiezasRechazadas" style="display:none" role="alert">Este campo es obligatorio.</div>
                            {!!Form::hidden('idm','',array('id'=>'idm'))!!}
                            {!!Form::hidden('col','pzsmalas')!!}
                        </div>
                    </div>
                </div>
                    
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 text-center" >
                            {!! Form::submit('Guardar', array('class'=>'btn btn-warning','id'=>'btnGuardar'))!!}
                            {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="coment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#FFBF00">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Editar</h3>
                </div>
                
                <div class="modal-body">
                    <div class="form">
                        {!!Form::open(array('route'=>'updatecomments','method'=>'post'))!!}
                        <div class="form-group">
                            {!!Form::label('Comentarios:')!!}
                            {!!Form::textarea('nuevo','',array('class'=>'form-control','rows'=>'3'))!!}
                            {!!Form::hidden('idc','',array('id'=>'idc'))!!}
                            {!!Form::hidden('col','comentarios')!!}
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 text-center" >
                            {!! Form::submit('Guardar', array('class'=>'btn btn-warning'))!!}
                            {!! Form::close()!!}        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    @section('scripts')
    <script type="text/javascript">
         $(document).ready(function (){
            //Funcion para produccion real
            $('tr #producidas').on('click','#real',function(e){
                var id=$(this).attr('data-id-action');
                $('#idp').val(id);
            });
                //funcion para piezas malas
            $('tr #malas').on('click','#malas',function(e){
                var id=$(this).attr('data-id-action');
                $('#idm').val(id); 
            });
             //funcion para comentarios
            $('tr #comentarios').on('click','#comments',function(e){
                var id=$(this).attr('data-id-action');
                $('#idc').val(id);
            });

            $('#formNuevo').submit(function(event) {
                 var hora = $('#inputHora').val();
                if(hora == "")
                {
                    $('.alert').show(500);
                    return false;
                }else{
                     $('.alert').hide(500);
                    return true;
                }
         });

         //FUNCTION: Para validar que los campos en la produccion programada no se encuentren vacios
         $('#formProduccion').submit(function(event) {

            var numero = $('#numero').val();
            if(numero == "")
            {
                 $('#alertProduccionReal').show(500);
                return false;
            }else{
                 $('#alertProduccionReal').hide(500);
                return true;
             }
         });
         //FUNCTION: Para validar que los campos en la forma de piezas rechazadas no se encuentren vacios
          $('#formRechazadas').submit(function(event) {

            var numero = $('#numberoRechazadas').val();
            if(numero == "")
            {
                 $('#alertPiezasRechazadas').show(500);
                return false;
            }else{
                 $('#alertPiezasRechazadas').hide(500);
                return true;
             }
         });
        //FUNCTION: Para quitar las alertas una vez que se este escribiendo en el campo detectado como vacio
         $('input').keypress(function(){
            $('.alert').hide(500);
            $('.alertProduccionReal').hide(500);
             $('.alertPiezasRechazadas').hide(500);
         });
    });
    </script>
    
    @endsection