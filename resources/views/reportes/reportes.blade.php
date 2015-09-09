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
	@if(Session::has('message'))
	<div class="row">
		<div  class="col-md-3"></div>
		<div  class="col-md-6 alert alert-success">{{ Session::get('message') }}</div>
		<div  class="col-md-3"></div>
	@endif
	<br/>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">
			<button type="submit" class="btn btn-warning">Generar reporte</button>
			{!! Form::close() !!}
		</div>
	</div>
	<br/>
</div>
@endsection