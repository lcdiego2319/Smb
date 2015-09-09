@extends('principal/adminlay')

@section('content')
    <div class="general inicio col-lg-2">
       
            {!! Form::open(array('route'=> 'register','method'=>'post'))!!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {!! Form::label('user','UID:')!!}
            <br>
            {!! Form::text('username','',array('class'=>'form-control','required'=>'required'))!!}
            <br><br>
            {!! Form::label('pass','Contraseña:')!!}
            <br>
            {!! Form::password('pass',['class'=>'form-control','required'=>'required'])!!}
            <br><br>
            {!! Form::label('pass','Confirmar Contraseña:')!!}
            <br>
            {!! Form::password('repeatpass',['class'=>'form-control','required'=>'required'])!!}
            <br>
            {!! Form::submit('Entrar', array('class'=>'btn btn-primary'))!!}
            {!! Form::close()!!}

    </div>

