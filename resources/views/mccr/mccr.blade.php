@extends('principal/simplelay')

@section('content')
<div class="container-fluid">
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table class=" table table-bordered">
		{!! Form::open(array('route'=> 'mccr.store','class'=>'form','method'=>'post', 'id'=>'formMccr'))!!}
		<tr>
			<th colspan="2" class="info" style="text-align:center;">Manufactoring Caused Customer Reject</th>
		</tr>
		<tr>
			<td>
				<table class="table table-striped col-lg-2">
					<tr>
						<th class="warning">Problema</th>
					</tr>
					<tr>
						<td>{!! Form::textarea('problema','',array('class'=>'responsive form-control', 'rows'=>'3','id'=>'textProblema'))!!}
						</td>
					</tr>
				</table>
			</td>
		
			<td>
				<table class="table table-striped col-lg-2">
					<tr>
						<th class="warning">Causa raíz</th>
					</tr>	
					<tr>
						<td> {!! Form::textarea('causa','',array('class'=>'responsive form-control', 'rows'=>'3','id'=>'textCausa'))!!}
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td>
				<table class="table table-striped col-lg-2">
					<tr>
						<th class="warning">Aprendizaje</th>
					</tr>			
						<tr>
							<td> {!! Form::textarea('aprendizaje','',array('class'=>'responsive form-control', 'rows'=>'3','id'=>'textAprendizaje'))!!}
							</td>
						</tr>
				</table>
			</td>
			<td>
				<table class="table table-striped col-lg-2">
					<tr>
						<th class="warning">Soluciones</th>
					</tr>
					<tr>
						<td> {!! Form::textarea('soluciones','',array('class'=>'responsive form-control', 'rows'=>'3','id'=>'textSoluciones'))!!}
						</td>
					</tr>
				</table>
			</td>
		</tr>
		</table>	
	</div>
</div>

<div class="alert alert-danger" id="alert" style="display:none" role="alert">Favor de llenar el formulario.</div>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		{!! Form::submit('Publicar', array('class'=>'btn btn-warning btn-block'))!!}
		{!! Form::close()!!}
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		 <div class="panel panel-info"  >
            <div class="panel-heading" style="color:black;font-size:18px;">Publicaciones</div>
               <div class="panel-body">
					<table class=" table table-bordered" style="font-size:14px; font-style: normal;">
						<tr>
							<th class="warning">Problema</th>
							<th class="warning">Causa Raiz</th>
							<th class="warning">Aprendizaje</th>
							<th class="warning">Soluciones</th>
							<th class="warning">Fecha</th>
						</tr>

						@foreach($mccr as $mc)
						<tr>
							<td>{{ $mc->problema }}</td>
							<td>{{ $mc->causaraiz }}</td>
							<td>{{ $mc->aprendizaje }}</td>
							<td>{{ $mc->soluciones }}</td>
							<td>{{ $mc->fecha }}</td>
						</tr>
						@endforeach
					</table>
				</div>
		</div>	
	</div>
</div>
 
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function (){
		
		$('#formMccr').submit(function(event) {
			var problema = $('#textProblema').val();
			var causa = $('#textCausa').val();
			var aprendizaje = $('#textAprendizaje').val();
			var soluciones = $('#textSoluciones').val();
			if(problema == "" && causa == "" && aprendizaje == "" && soluciones == "")
			{
				$('.alert').show(500);
				return false;
			}
			else
			{
				$('.alert').hide(500);
				return true;
			}
			alert(problema);			
		});				

		$('textarea').keypress(function(){
			$('.alert').hide(500);
		});		
	});
</script>

@endsection