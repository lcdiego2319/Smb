@extends('principal/simplelay')
@section('content')
<div class="container-fluid">
	<div class="row" >
		<div class="col-md-12 " style="height:700px" id="temps_div" ></div>
	</div>
@linechart('Temps', 'temps_div')
	<div class="row">
				 
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-striped table-bordered warning">
				<tr>
					<th class="warning">Fecha</th>
					<th class="warning">Turno 1</th>
					<th class="warning">Turno 2</th> 
					<th class="warning">Turno 3</th>
					<th class="warning">Turno 4</th>
				</tr>
				
				@foreach($fpys as $fpy)
				<tr>
					<td class="warning">{{ $fpy->dia }}</td>
					<td>{{ $fpy->valor1 }}</td>
					<td>{{ $fpy->valor2 }}</td> 
					<td>{{ $fpy->valor3 }}</td>
					<td>{{ $fpy->valor4 }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>

	   
</div>
@endsection
