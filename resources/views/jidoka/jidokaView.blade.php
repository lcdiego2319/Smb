@extends('principal/subprincipalView')


@section('content')
<div class="container-fluid">
		<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center" style="font-size:30px"><b>JIDOKA</b></div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-2 text-right">
		
		</div>
		
		<div class="col-md-8 text-center" style="border: 1px solid black;box-shadow: 5px 5px 5px #888888;">
			<img src="{{asset($triangulo)}}" id="triangulo" width="1000" height="750"></img>
		</div>
		
		<div class="col-md-2 text-left">
		
		</div>
	</div>
</div>

<br/>
<div id="token" style="display:none">{{ csrf_token() }}</div>



@endsection
 @section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				var token = $('#token').html();
				var datos = {};
				datos['_token'] = token;
				datos['nombre'] = 'diego';
				$.ajax({
					type:'POST',
					url:'../public/refresh',
					data: datos,
					success:function(triangle){
						var newSrc = "{{asset('')}}";
						newSrc = newSrc + triangle.message					
						$('#triangulo').attr('src',newSrc);
						$('#triangles').html(newSrc);
					}
				});
			},5000);			
		});

	</script>   
	 @endsection