@extends('principal/simplelay')


@section('content')
	<div class="container-fluid">
		<div class="row" >
		<div class="col-md-12 " style="height:700px" id="temps_div" ></div>
	</div>
@linechart('Temps', 'temps_div')
	

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-striped table-bordered warning">
				<tr>
					<th class="warning">Fecha</th>
					<th class="warning">Eficiencia (95%)</th>
					<th class="warning">Calidad (99%)</th> 
					<th class="warning">Disponibilidad (98%)</th>
					<th class="warning">OEE</th>
				</tr>
				
				@foreach($oee as $item)
				<tr>
					<td class="warning">{{ $item->fecha }}%</td>
					@if($item->eficiencia < 95)
						<td style="background-color:red;">{{ $item->eficiencia }}%</td>
					@else
						<td>{{ $item->eficiencia }}%</td>
					@endif
					@if($item->calidad < 98)
					<td style="background-color:red;">{{ $item->calidad}}%</td> 
					@else
						<td>{{ $item->calidad}}%</td>
					@endif
					@if($item->disponibilidad < 99)
					<td style="background-color:red">{{ $item->disponibilidad}}%</td>
					@else
						<td>{{ $item->disponibilidad}}%</td>
					@endif

					<td>{{ $item->oee }}%</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
		</div>

@endsection