@extends('principal/subprincipalView')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center" style="font-size:30px"><b>PLAN DE ACCION</b>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class=" table table-striped table-bordered responsive reporte" style="font-size:24px">
				<tr style="background-color:#FFBF00">
					<th class="col-lg-1" >Ref.Nr.</th>
					<th class="col-lg-2" >Problema</th>
					<th class="col-lg-2" >Acción</th>
					<th class="col-lg-1">Responsable</th>
					<th class="col-lg-1" >Fecha de vencimiento</th>
					<th class="col-lg-1" >Status</th>
				</tr>
				
				@foreach($apreport as $aprep)
				    @if($aprep->color == "red")
            			<tr data-id="{{$aprep->numref}}" style="background-color:red">  
        			@elseif($aprep->color == "yellow")
            			<tr data-id="{{$aprep->numref}}" style="background-color:yellow">
        			@else
        				<tr data-id="{{$aprep->numref}}">
        			@endif
        			<td>{{$aprep->numref}}</td>
					<td>{{$aprep->problema}}</td>
					<td>{{$aprep->accion}}</td>
					<td>{{$aprep->responsable}}</td>
					<td>{{$aprep->vencimiento}}</td>
					<td>{{$aprep->problemstatus}}</td>
				</tr>
				@endforeach
			</table>
 		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
   $(document).ready(function (){
		$('.cambiar').on('click',function(e){
			var id=$(this).attr('data-id-action');
			$('#idac').val(id);
		});

		$(function() {$( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"}); });

		//FUNCTION: Para validad que los campos para crear un plan de accion no esten vacios
		$('#formActionPlan').submit(function(event) {
			var problema = $('#textProblema').val();
			var responsable = $('#textResponsable').val();
			var accion = $('#textAccion').val();
			var fecha = $('#datepicker').val();

			if(problema == "" && responsable == "" && accion == "" && fecha == "")
			{
				$('.alert').show(500);
				return false;
			}else{
					$('.alert').hide(500);
					return true;
				}
		});
		//FUNCTION: Para quitar las alertas cuando el usuario ingresa valores en los campos que fueron detectados como vacios.
		$('input').keypress(function(){
			$('.alert').hide(500);
		});
	});
</script>

@endsection

