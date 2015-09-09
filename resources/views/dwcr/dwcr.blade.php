@extends('principal/simplelay')

@section('content')

<br/>
<div class="container-fluid">
	
<div class="dwcr col-md-12 responsive">	 
	 {!! Form::text('fecha',date('Y-m-d'),array('class'=>'data col-lg-10 responsive','readonly'=>'readonly'))!!}
	 @if(($target->target)>$dwcr)
	 {!! Form::text('now',$dwcr,array('class'=>'nowr col-lg-6 responsive','readonly'=>'readonly'))!!}
	 @else
	 {!! Form::text('now',$dwcr,array('class'=>'now col-lg-6 responsive','readonly'=>'readonly'))!!}
	 @endif
	 {!! Form::text('best',$target->best,array('class'=>'best col-lg-3 responsive','readonly'=>'readonly'))!!}
	 {!! Form::text('target',$target->target,array('class'=>'target col-lg-3 responsive','readonly'=>'readonly'))!!}
	<p class="dias">Días sin quejas de cliente</p>

</div>

<div class="row">
<div class="col-md-4 col-md-offset-4" style="font-size:18px;">
	<br/><br/>
	 <a data-toggle="modal" href="#nueva" class="btn btn-danger btn-block">
  <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Nueva Queja
</a>
</div>
</div>
</div>

 <div class="modal fade" id="nueva">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:#FFBF00">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
					<h2 class="modal-tittle" >Nuevo registro</h2>
				</div>
				<div class="modal-body">
					{!! Form::open(array('url'=> 'dwcr/update','method'=>'put'))!!}
					<p>Esta a punto de registrar una nueva queja de cliente. ¿Desea continuar?</p>
				</div>
					<div class="modal-footer">
						<div class="row">
						<div class="col-md-10 col-md-offset-1 text-center" >
					 {!! Form::submit('Aceptar', array('class'=>'btn btn-warning'))!!}
				   
					{!! Form::close()!!}
				</div>
			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
@section('scripts')
<script type="text/javascript">
/*
	$(document).ready(function(){
		$('#nueva').on('click',function(){
				alert('Funcion javascript');
		});
});*/
</script>
@endsection