@extends('principal/subprincipalView')

@section('content')

<div class="container-fluid">
	<div class="row">
    	<div class="col-md-10 col-md-offset-1 text-center" style="font-size:30px"><b>MCCR</b></div>
    </div>
    <hr>
	<div class="row">
 		<div class="col-md-10 col-md-offset-1">
			<table class=" table table-bordered"  style="font-size:20px">
				<tr style="background-color:#FFBF00; font-size:26px">
					<th colspan="2"  style="text-align:center;">Manufactoring Caused Customer Reject</th>
				</tr>
				<tr>
					<td>
						<table class="table table-striped col-lg-2">
							<tr>
								<th   style="font-size:26px">Problema</th>
							</tr>
							
							<tr>
								<td> {{$mccr->problema}}</td>
							</tr>
							<tr  style="font-size:12px; text-align:right">
								<td><b> {{$mccr->updated_at}}</b></td>
							</tr>
							
						</table>
					</td>
					<td>
						<table class="table table-striped col-lg-2">
							<tr>
								<th  style="font-size:26px">Causa raíz</th>
							</tr>
						
							<tr>
								<td>{{$mccr->causaraiz}}</td>
							</tr>
								<tr  style="font-size:12px; text-align:right">
								<td> <b>{{$mccr->updated_at}}</b></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-striped col-lg-2">
							<tr>
								<th  style="font-size:26px">Aprendizaje</th>
							</tr>
							
							<tr>
								<td>{{$mccr->aprendizaje}}</td>
							</tr>
								<tr  style="font-size:12px; text-align:right">
								<td><b> {{$mccr->updated_at}}</b></td>
							</tr>
						
						</table>
					</td>
					<td>
						<table class="table table-striped col-lg-2">
							<tr>
								<th  style="font-size:26px">Soluciones</th>
							</tr>
					
							<tr>
								<td>{{$mccr->soluciones}}</td>
							</tr>
								<tr  style="font-size:12px; text-align:right">
								<td><b> {{$mccr->updated_at}}</b></td>
							</tr>
			
						</table>
					</td>
				</tr>
			</table>
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