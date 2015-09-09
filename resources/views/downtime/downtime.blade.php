@extends('principal/simplelay')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <table class="table table-striped table-bordered warning" style="font-size:16px;">
                <tr>
                    <th class="col-md-1 warning">Tipo de paro</th>
                    <th class="col-md-1 warning">Fecha</th>
                    <th class="col-md-1 warning">Hora inicio</th>
                    <th class="col-md-1 warning">Hora fin</th>
                    <th class="col-md-1 warning">Tiempo muerto(min)</th>
                </tr>
                @foreach($downtimes as $downtime)
                <tr>
                	<td>{{ $downtime->razon }}</td>
                	<td>{{ $downtime->created_at->toDateString() }}</td>
                	<td>{{ $downtime->created_at->toTimeString() }}</td>
                	<td>{{ $downtime->updated_at->toTimeString() }}</td>
                	<td>{{ $downtime->tiempo }}</td>
                	
                </tr>
               @endforeach
            </table>
           </div>
       </div>
   </div>


@endsection