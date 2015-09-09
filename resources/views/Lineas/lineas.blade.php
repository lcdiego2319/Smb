@extends('principal/adminlay')

@section('content')
<div class="reporte responsive col-lg-10">
	<p>Existen {{$lineas->total()}} registros</p>
	<table class=" table table-striped table-bordered reporte col-lg-8">
		<tr>
			<th class="col-md-1">Linea</th>
			<th class="col-md-1">Nombre</th>
		</tr>
		@foreach($lineas as $linea)
		<tr id="linea" data-id-action="{{$linea->idlinea}}">
			<td  >{{$linea->idlinea}}</td>
			<td>{{$linea->nombre}}</td>
		</tr>	
		@endforeach
	</table>
	{!!$lineas->setPath('')->render()!!}
	<a data-toggle="modal" href="#nuevo" class="btn btn-success btn-lg nuevo">Nueva
  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>	
</div>

<!--FORMULARIOS MODALES-->
<div class="modal fade" id="nuevo">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Nueva Linea</h3>
                    <div class="modal-body">
                        <div class="form">
                        {!!Form::open(array('route'=>'lineas.admin.store','method'=>'post'))!!}
                      <div class="form-group input-lg">
                        {!!Form::label('Linea:')!!}
                        {!!Form::text('idlinea','',array('class'=>'form-control'))!!}
                    </div>
                    <br><br>
                      <div class="form-group input-lg">
                         {!!Form::label('Nombre:')!!}
                        {!!Form::text('nombre','',array('class'=>'form-control'))!!}</div>
                        <br><br>
            
                        </div>
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


        @section('scripts')
   <script type="text/javascript">
		$(document).ready(function (){

             $('tr #linea').on('click','#name',function(e){
                
                var id=$(this).attr('data-id-action');
                alert(id);
                $('#idlin').val(id);
            });

            
		        });
   </script>
