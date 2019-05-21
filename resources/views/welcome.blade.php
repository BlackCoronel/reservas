
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MONTA TU BACA - SAKALI</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/grayscale.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">
            <img src="/img/logo_vectorizado.png" alt="logo sakali vectorizado" style="width: 120px;">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/ayuda">¿Como reservar?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/reservas">¡Haz tu reserva!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/estado"><i class="fas fa-eye"></i> Estado Reserva</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/contacta"><i class="fas fa-phone"></i> Contacta</a>
                </li>
                @if(!Auth::check())
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/login">
                        <i class="fas fa-lock"></i> Area Privada
                    </a>
                </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-lock"></i> Area Privada
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/admin"><i class="fas fa-lock"></i > Area Privada</a>
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </div>
                    </li>
                    @endif

            </ul>
        </div>
    </div>
</nav>
<!-- Header -->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        @if(Request::path() == '/')
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">HAZ TU RESERVA</h1>
            <h2 class="mx-auto mt-2 mb-5" style="color:white;">Aquí puedes hacer la reserva para el montaje de tu baca.</h2>
            <a href='/reservas' class="btn btn-primary js-scroll-trigger"><i class="fas fa-calendar"></i> RESERVAR</a>
        </div>
        @else
            @yield('content')
        @endif
    </div>
</header>

<footer class="bg-black small text-center text-white-50">
    <div class="container">
        Copyright &copy; {{ date('Y') }} Viseras SAKALI S.L
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    //AQUI VAN LOS SCRIPTS QUE CARGAN TODO POR AJAX
    $('#marca').change(function(){
        $('#carroceria').html("<option>seleccionar año y carrocería...</option>");
        $.ajax({
            type: 'GET',
            url: '/cargarModelos/' + $(this).val(),
            success: function (result) {
                var salida = "<option>seleccionar modelo...</option>";
                for(i = 0; i < result.length; i++){
                    salida += "<option value='"+ result[i].id+"'>" + result[i].modelo +"</option>";
                }
                $('#modelo').html(salida);
            },
        });
    });

    $('#modelo').change(function(){
        $.ajax({
            type: 'GET',
            url: '/cargarCarrocerias/' + $(this).val(),
            success: function(modelos){
                var salida = "<option>seleccionar año y carrocería...</option>";
                for(i = 0; i < modelos.length; i++){
                    salida += "<option value='"+ modelos[i].id+"'>" + modelos[i].submodelo +"</option>";
                }
                $('#carroceria').html(salida);
            },
        });
    });

    $('#fecha').change(function(){
        $.ajax({
            url: '/cargarHoras/'+ $('#fecha').val(),
            type: 'GET',
            success: function(data){
                var salida="";
                for(i = 0; i < data.length; i++){
                    if(data[i].reservada == 'reservada'){
                        salida+= "<option disabled>"+ data[i].hora +"❌</option>"
                    }else if(data[i].reservada == 'provisional'){
                        salida+= "<option style='color:orangered;font-weight: bold;' disabled>"+ data[i].hora +"🎫</option>"
                    } else {
                        salida += "<option  style='color:green;font-weight: bold;' value='"+ data[i].id+"'>" + data[i].hora +"</option>";
                    }
                }
                $('#hora').html(salida);
            }
        })
    });
</script>

<script>
    $('#reservar').click(function(){
        $('#aviso').modal();
        $('#mod').val($('#carroceria option:selected').text());
        $('#dia').val($('#fecha').val());
        $('#hor').val($('#hora option:selected').text());
    });

    $('#buscar').click(function(){
       $.ajax({
           url: '/estado/' + $('#referencia').val(),
           method: 'GET',
           success: function (data) {
               if(data.length > 0){
                    var salida = '<table class="table table-responsive-lg">' +
                        '  <thead class="bg-info">' +
                        '    <tr>' +
                        '      <th scope="col">FECHA</th>' +
                        '      <th scope="col">HORA</th>' +
                        '      <th scope="col">PRODUCTO</th>' +
                        '      <th scope="col">ESTADO</th>' +
                        '    </tr>' +
                        '  </thead>' +
                        '  <tbody>' +
                        '    <tr>' +
                        '      <th>'+ data[0].dia+'</th>' +
                        '      <td>'+ data[0].hora +'</td>' +
                        '      <td>'+ data[0].modelo +'</td>';

                    switch (data[0].estado){

                        case 'ESPERANDO CONFIRMACIÓN':
                             salida += '<td><span class="badge badge-primary" style="padding:10px 15px;"><i class="fas fa-hourglass-half"></i> '+ data[0].estado +'</span></td>';
                        break;

                        case 'PRODUCTO SIN STOCK':
                            salida += '<td><span class="badge badge-danger" style="padding:10px 15px;"><i class="fas fa-exclamation-circle"></i> '+ data[0].estado +'</span></td>';
                            break;

                        case 'CONFIRMADO':
                            salida += '<td><span class="badge badge-success" style="padding:10px 15px;"><i class="fas fa-check-circle"></i> '+ data[0].estado +'</span></td>';
                            break;
                        case 'ESPERANDO FECHA CLIENTE':
                            salida += '<td><span class="badge badge-warning" style="padding:10px 15px;"><i class="fas fa-user-clock"></i> '+ data[0].estado +'</span> <a href="/asignarPlazos/'+ data[0].token +'" class="btn btn-primary" style="padding:7px 15px;"><i class="fas fa-caret-right"></i> Asignar Plazo</a></td>';
                            break;
                    }

                   salida+= '</tr></tbody></table>';

                    $('#resultado').html(salida);
               } else {
                   $('#resultado').html('<p class="alert alert-danger">Lo sentimos, pero la referencia introducida es incorrecta o no existe.</p>');
               }
           }
       })
    });
</script>
<script>
    $(document).ready(function(){
        $('.dif').click(function(){
            $('#diferente').modal();
            $('#dia_dif').change(function(){
                $.ajax({
                    url: '/cargarHoras/'+ $('#dia_dif').val(),
                    type: 'GET',
                    success: function(data){
                        var salida="";
                        for(i = 0; i < data.length; i++){
                            if(data[i].reservada == 'reservada'){
                                salida+= "<option disabled>"+ data[i].hora +"❌</option>"
                            }else if(data[i].reservada == 'provisional'){
                                salida+= "<option style='color:orangered;font-weight: bold;' disabled>"+ data[i].hora +"🎫</option>"
                            } else {
                                salida += "<option  style='color:green;font-weight: bold;'>" + data[i].hora +"</option>";
                            }
                        }
                        $('#hora_dif').html(salida);
                    }
                })
            });
        });
    });
</script>
<script>
    @if($errors->any())
        $('#aviso').modal();
    @endif
</script>

<!-- Plugin JavaScript -->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="/js/grayscale.min.js"></script>

</body>

</html>
