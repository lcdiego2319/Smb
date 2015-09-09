@extends('principal/simplelay')

@section('content')
     <div class="general col-lg-5 form-group">

{!! Form::open(array('route'=> 'actionplan.store','method'=>'post'))!!}
  <br><br>
<!--{!! Form::label('Num. Ref' )!!}
{!! Form::text('nref')!!}
-->
{!! Form::label('Responsable:','',array('style'=>'margin-left:50%;'))!!}{!! Form::text('responsable')!!}
<br><br>
{!! Form::label('Problema:')!!}
             <br>
{!! Form::textarea('problema','',array('class'=>'responsive col-lg-12','rows'=>'2','maxlength'=>'250'))!!}
         <br><br><br>
{!! Form::label('Accion:')!!}
<br>
{!! Form::textarea('accion','',array('class'=>'responsive col-lg-12','rows'=>'2','maxlength'=>'250'))!!}
             <br><br><br>
{!! Form::label('Fecha de inicio:')!!}
{!! Form::text('fecha',\Carbon\Carbon::now())!!}

{!! Form::label('Status:','',array('style'=>'margin-left:10%;'))!!}

{!! Form::select('status',[
         'A'=>'A',
         'P'=>'P',
         'C'=>'C',
         'D'=>'D'])!!}
             <br><br>
{!! Form::submit('Guardar', array('class'=>'btn btn-primary'))!!}
             <br>
{!! Form::close()!!}
             <br>
     </div>
