<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electronic Board</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/css/Popup-master/assets/css/popup.css')}}" rel="stylesheet">
    <script scr="{{asset('/css/Popup-master/assets/js/jquery.popup.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js" charset="utf-8"></script>


    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body style="min-height: 100%; ">
   <div class="container-fluid">
        <br/>
          <div class="row">
            <div class="col-md-7  text-right">
                <img src="{{asset('/images/logo.png')}}" width="550px" height="90px"  >
            </div>
            <div class="col-md-3 text-left" style="font-size:70px"><b>{{Auth::user()->linea}} </b>
            </div>
            <div class="col-md-2 text-left" id="turno" style="font-size:40px;color:green">
            </div>
        </div>

        <br>
        <div class="row" style="background-color:black; height:15px; border-bottom: 5px solid #FFBF00;">
            <div class="col-md-12"></div>
        </div>
    <br>
    </div>

@yield('content')

@yield('scripts')
<script type="text/javascript">

/*FUNCTION: Para consultar en la BD de que color se debe mostrar el andon*/
    $(document).ready(function()
    {
        getAndon();
        getTurno();

        setInterval(function()
        {
            getAndon();
           getTurno();
        },10000);
    });
    /*FUNCTION: AJAX call to LineasController to get the color for andon and show it in View*/
    function getAndon()
    {
        var token = $('#token').html();
        $.ajax({
                type: 'GET',
                url: '../public/getAndon',
                success:function(response)
                {
                    if(response.andon == 'green')
                    {
                        $('body').css('border','30px solid #008000');
                    }else if(response.andon == 'red')
                    {
                        $('body').css('border','30px solid #FF0000');
                    }else
                    {
                        $('body').css('border','30px solid  #f4ea05');                        
                    }
                }
            });
    }

    /*FUNCTION: AJAX call to TurnoController to get the current shift and show it in View*/
      function getTurno(){
            $.ajax({
            type: 'GET',
            url: '../public/getTurno',
            success:function(response){
                $('#turno').html("Turno "+response.turno);
            }
        });
      }
</script>
</body>
</html>
