@extends('principal/simplelay')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
<table class=" table table-striped table-bordered responsive reporte">
    <tr>
        <th class="col-lg-1 warning" >Ref.Nr.</th>
        <th class="col-lg-2 warning" >Problema</th>
        <th class="col-lg-2 warning" >Acción</th>
        <th class="col-lg-1 warning">Responsable</th>
        <th class="col-lg-1 warning" >Fecha de vencimiento</th>
        <th class="col-lg-1 warning" >Status</th>
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
            <td>
                {{$aprep->problemstatus}}
                <a data-toggle="modal" href="#cambiar" class="btn btn-default  btn-xs"
                 data-id-action="{{$aprep->numref}}">
                   <span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span>
                </a>
            </td>
        </tr>
    @endforeach
</table>
  <a data-toggle="modal" href="#nuevo" class="btn btn-success btn-lg nuevo">
  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Nuevo
</a>
    </div>
    </div>
    <div class="modal fade" id="cambiar">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h4 class="modal-tittle">Editar</h4>
                    <div class="modal-body">
                        <div class="form">
                        {!!Form::open(array('route'=>'actionplan.update','method'=>'patch'))!!}
                        <div class="form-group input-lg">
                        {!!Form::label('No.Ref:')!!}
                        {!!Form::text('idac','',array('id'=>'idac','readonly'=>'readonly','class'=>'form-control'))!!}
                        </div>
                        <br>
                        <div class="form-group input-lg">
                        {!!Form::label('Status:')!!}
                        {!! Form::select('stat',array('Plan'=>'Plan','Do'=>'Do','Act'=>'Act','Check'=>'Check'),array('class'=>'form-control'))!!}
                       </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                            {!! Form::submit('Guardar', array('class'=>'btn btn-info'))!!}
                    {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="nuevo">
        <div class="modal-dialog">
            <div class="modal-content hxh">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 class="modal-tittle">Nuevo Registro</h3>
                    <div class="modal-body">
                            {!! Form::open(array('route'=> 'actionplan.store','method'=>'post','id'=>'formActionPlan'))!!}
                            {!! Form::label('Responsable:')!!}
                            {!! Form::text('responsable','',array('class'=>'form-control','id'=>'textResponsable'))!!}
                                <br><br>
                            {!! Form::label('Problema:')!!}
                                         <br>
                            {!! Form::textarea('problema','',array('class'=>'responsive col-lg-12','rows'=>'2','maxlength'=>'250','id'=>'textProblema'))!!}
                                     <br><br><br>
                            {!! Form::label('Accion:')!!}
                            <br>
                            {!! Form::textarea('accion','',array('class'=>'responsive col-lg-12','rows'=>'2','maxlength'=>'250','id'=>'textAccion'))!!}
                                         <br><br><br>
                           
                             <div class="form-group">
                            {!! Form::label('Fecha de vencimiento:')!!}
                            {!! Form::text('fecha','',array('class'=>'form-control','id'=>'datepicker'))!!}     
                                </div>
                                     <div class="form-group">
                            {!! Form::label('Status:','',array('style'=>'margin-left:10%;'))!!}

                            {!! Form::select('status',array('Plan'=>'Plan','Do'=>'Do','Act'=>'Act','Check'=>'Check'),array('class'=>'form-control'))!!}
                                         <br><br></div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-danger" id="alert" style="display:none" role="alert">Favor de llenar el formulario.</div>
                    {!! Form::submit('Guardar', array('class'=>'btn btn-info'))!!}
                    {!! Form::close()!!}
                    </div>
                </div>
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

