@extends('principal/subprincipalView')

@section('content')

<br/>
<div class="container-fluid">
 <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center" style="font-size:30px"><b>QUEJAS DE CLIENTE</b></div>
    </div>
    <br>
<div class="dwcr col-md-5 responsive">	 
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

</div>
<br/><br/>

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