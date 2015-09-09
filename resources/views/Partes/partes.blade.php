@extends('principal/adminlay')

@section('content')
<div class="reporte responsive col-lg-10">
	<p>Existen {{$partes->total()}} registros</p>
	<table class=" table table-striped table-bordered reporte col-lg-8">
		<tr>
			<th class="col-md-1">Num. Parte</th>
			<th class="col-md-1">Linea</th>
			<th class="col-md-1">Bottle<br>Neck</th>
		</tr>
		@foreach($partes as $parte)
		<tr id="{{$parte->id_parte}}">
			<td>{{$parte->numparte}}</td>
			<td>{{$parte->linea}}</td>
			<td id="bn">{{$parte->bn}}	

			<a data-toggle="modal" href="#edit" class="btn btn-info nuevo" id="btln" data-id-action="{{$parte->id_parte}}" data-numparte="{{$parte->numparte}}">
  			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
			
			</td>
		</tr>	
		@endforeach
	</table>
	{!!$partes->setPath('')->render()!!}
	<a data-toggle="modal" href="#nuevo" class="btn btn-success btn-lg nuevo">Nueva
  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>	
</div>

<div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Editar</h3>
                    <div class="modal-body">
                        <div class="form">
                        {!!Form::open(array('route'=>'partes.admin.update','method'=>'patch'))!!}
                        <div class="form-group input-lg">
                        	{!!Form::label('Parte:')!!}
                        	{!!Form::text('npart','',array('id'=>'numparte','class'=>'form-control','readonly'=>'readonly'))!!}
                        	{!!Form::hidden('idparte','',array('id'=>'idparte','class'=>'form-control'))!!}
                        </div>
                        <br>
                        <div class="form-group input-lg">
                        {!!Form::label('Bottle neck:')!!}
                        {!!Form::text('bn','',array('class'=>'form-control'))!!}
                        
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

             $('tr #bn').on('click','#btln',function(e){
               
                var id=$(this).attr('data-id-action');
                var num=$(this).attr('data-numparte');
                $('#idparte').val(id);
                $('#numparte').val(num);
            });

            
		        });
   </script>
@endsection