@extends('principal/simplelay')

@section('content')
    <div class="general reporte col-lg-8 form-group">

{!!Form::open(array('url'=> 'mccr/save'))!!}
        <div class=" col-lg-5">
{!!Form::label('Descripcion:')!!}
<br>
{!!Form::textarea('descrip')!!}
    </div>

    <div class="col-lg-5">
{!!Form::label('Causa raiz:')!!}
<br>
{!!Form::textarea('causa')!!}

    </div>

        <div class=" col-lg-5">

    {!!Form::label('Aprendizaje:')!!}
  <br>
{!!Form::textarea('aprendizaje')!!}

    </div>
        <div class="col-lg-5">
{!!Form::label('Soluciones:')!!}
<br>
{!!Form::textarea('soluciones')!!}
    </div>



{!!Form::submit('Guardar', array('class'=>'btn btn-primary col-lg-4', 'style'=>'margin-top:2%;margin-bottom:2%;margin-left:47%;'))!!}
{!!Form::close()!!}

</div>