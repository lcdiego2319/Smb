@extends('principal/simplelay')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			{!! Form::model(Request::all(),['route'=>'excel.show','method'=>'GET','class'=>'form-group']) !!}
			{!! Form::label('tipo','Seleccionar el reporte') !!}
			{!! Form::select('tipo',config('reportes.types'),null,['class'=>'form-control']) !!}
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<button type="submit" class="btn btn-warning">Generar reporte</button>
			{!! Form::close() !!}
		</div>
	</div>
	<br/>
</div>

@if(count($rows) > 0)
	<div class="row">
		<div class="col-md-10">
		</div>
		
			<div class="col-md-2">
				{!! Form::model(Request::all(),['route'=>'excel.create','method'=>'GET','class'=>'form-group']) !!}
				<button type="submit" id="btnNewRow" onClick="newRow()" class="btn btn-success" > <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Excel</button>
				{!! Form::close() !!}
				
			</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<table class="table table-bordered">
			<tr>
				
				<td class="warning">Fecha</td>
			
				<td class="warning">Hora</td>
				
				<td class="warning">NumParte</td>
				<td class="warning">Piezas Programadas</td>
				<td class="warning">Piezas Producidas</td>
				<td class="warning">Piezas Acumuladas</td>
				<td class="warning">Piezas Malas</td>
			</tr>

		@foreach($rows as $row)
			<tr>
				
				<td>{{$row->fecha}}</td>
				
				<td>{{$row->horai}} - {{$row->horaf}}</td>
			
				<td>{{$row->numparte}}</td>
				<td>{{$row->pzsprog}}</td>
				<td>{{$row->pzsprod}}</td>
				<td>{{$row->pzsacum}}</td>
				<td>{{$row->pzsmalas}}</td>
			</tr>
		@endforeach
	</table>
	</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
	
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			{!!$rows->setPath('')->render()!!}
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
		No records
		</div>
	</div>


	@endif
@endsection