@extends('principal/principalView')
@section('content')
<div class="container-fluid">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="box-shadow: 5px 5px 5px #888888; border:none">
  	<ol class="carousel-indicators">
    	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    	<li data-target="#carousel-example-generic" data-slide-to="1"></li>
    	<li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>
  
  <div class="carousel-inner" role="listbox">
    <div class="item active" style="height:1000px">
      <iframe src="{{route('reporte.index')}}" frameBorder="0" height="100%" width="100%"></iframe>
        <div class="carousel-caption">
        </div>
    </div>
      
    <div class="item" style="height:1000px">
      <iframe src="{{route('fpy.index')}}" frameBorder="0" height="100%" width="100%"></iframe>
      <div class="carousel-caption">
      </div>
    </div>
    
    <div class="item" style="height:1000px">
      <iframe src="{{route('actionplan.index')}}" frameBorder="0" height="100%" width="100%"></iframe>
      <div class="carousel-caption">
      </div>
    </div>

    <div class="item" style="height:1000px">
      <iframe src="{{route('jidoka.index')}}" frameBorder="0" height="100%" width="100%"></iframe>
      <div class="carousel-caption">
      </div>
    </div>

    <div class="item" style="height:1000px">
      <iframe src="{{route('mccr.index')}}"  frameBorder="0" height="100%" width="100%"></iframe>
      <div class="carousel-caption">
      </div>
    </div>

    <div class="item" style="height:1000px">
        <iframe src="{{route('dwcr.index')}}"  frameBorder="0" height="100%" width="100%"></iframe>
        <div class="carousel-caption">
        </div>
    </div>


    <div class="item" style="height:1000px">
      <iframe src="{{route('oee.index')}}"  frameBorder="0" height="100%" width="100%"></iframe>
      <div class="carousel-caption">
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@endsection
