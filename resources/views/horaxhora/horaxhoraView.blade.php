@extends('principal/subprincipalView')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center" style="font-size:30px"><b>REPORTE DIARIO DE PRODUCCION</b></div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <table class="table table-striped table-bordered warning" style="font-size:24px" >
                <tr style="background-color:#FFBF00">
                    <th class="col-md-1">Hora</th>
                    <th class="col-md-1"> Produccion<br>programada </th>
                    <th class="col-md-1">Produccion <br> Real</th>
                    <th class="col-md-1">Produccion <br>acumulada</th>
                    <th class="col-md-1">Rechazadas </th>
                    <th class="col-md-3">Comentarios</th>
                </tr>
                
                @foreach($partescol as $partes)
                <tr id="{{$partes->id_reporte}}">
                    <td>{{substr($partes->horai, 0, 5)}}-{{substr($partes->horaf, 0, 5)}}</td>
                    <td>{{$partes->pzsprog}}</td>
                    <td>{{$partes->pzsprod}}</td>
                    <td>{{$partes->pzsacum}}</td>
                    <td>{{$partes->pzsmalas}}</td>
                    <td>{{$partes->comentarios}}</td>
                </tr>
                @endforeach
            </table>
        
           
        </div>
    </div>
</div>


    @endsection
    @section('scripts')
    <script type="text/javascript">
         $(document).ready(function (){
            
          
        });
    </script>
    
    @endsection