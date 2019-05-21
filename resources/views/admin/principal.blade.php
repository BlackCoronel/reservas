<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Area Privada - VISERAS SAKALI</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/adm/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/adm/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adm/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/adm/dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="/img/logo_vectorizado.png" width="35px"
                                         alt="logo vectorizado sakali"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">VISERAS<b> SAKALI</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fas fa-bars"></i>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/adm/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/adm/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }} - {{ Auth::user()->cargo }}
                                    <small>Miembro desde {{date('d-m-Y', strtotime(Auth::user()->created_at))}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/perfil" class="btn btn-default btn-flat">
                                        <i class="fas fa-user"></i> Perfil
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-default btn-flat">
                                            <i class="fa fa-sign-out-alt"></i> Cerrrar sesión
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/adm/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">ACCIONES</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="/register">
                        <i class="fa fa-user-plus"></i>
                        <span> Registrar Empresa</span>
                    </a>
                </li>
                <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            @if(Request::path() == '/admin' || Request::path() == 'panel')
            <div class="container" style="background-color: white;">
                <h1 class="text-center">TODAS LAS RESERVAS</h1>
                <button type="button" id="filtrar" class="btn btn-primary pull-right" style="margin: 10px 0px 10px 10px;">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                @if(count($reservas) > 0)
                    <table class="table table-bordered table-hover dataTable" style="border: 2px solid #000000">
                        <thead class="bg-primary">
                        <tr style="border: 2px solid #000000">
                            <th scope="col" style="border: 2px solid #000000">REFERENCIA</th>
                            <th scope="col" style="border: 2px solid #000000">FECHA</th>
                            <th scope="col" style="border: 2px solid #000000">HORA</th>
                            <th scope="col" style="border: 2px solid #000000">NOMBRE</th>
                            <th scope="col" style="border: 2px solid #000000">TELÉFONO</th>
                            <th scope="col" style="border: 2px solid #000000">PRODUCTO</th>
                            <th scope="col" style="border: 2px solid #000000">ESTADO</th>
                            <th scope="col" style="border: 2px solid #000000">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservas as $reserva)
                            <tr style="border: 2px solid #000000">
                                <th style="border: 2px solid #000000">{{ $reserva->referencia }}</th>
                                <th style="border: 2px solid #000000">{{ date('d-m-Y',strtotime($reserva->dia)) }}</th>
                                <th style="border: 2px solid #000000">{{ $reserva->hora }}</th>
                                <th style="border: 2px solid #000000">{{ $reserva->nombre }}</th>
                                <th style="border: 2px solid #000000">{{ $reserva->telefono }}</th>
                                <th style="border: 2px solid #000000">{{ $reserva->modelo }}</th>
                                <th style="border: 2px solid #000000">
                            @if($reserva->estado == "CONFIRMADO")
                                <span class="label label-success" style="padding:8px 15px;">
                                    <i class="fas fa-check-circle"></i> {{ $reserva->estado }}
                                </span>
                                @elseif($reserva->estado == "ESPERANDO CONFIRMACIÓN")
                                        <span class="label label-primary" style="padding:8px 15px;">
                                    <i class="fas fa-hourglass-half"></i> {{ $reserva->estado }}
                                </span>
                                @elseif($reserva->estado == "PRODUCTO SIN STOCK")
                                        <span class="label label-danger" style="padding:8px 15px;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $reserva->estado }}
                                </span>
                                @elseif($reserva->estado == "ESPERANDO FECHA CLIENTE")
                                        <span class="label label-warning" style="padding:8px 15px;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $reserva->estado }}
                                </span>
                            @endif
                                </th>
                                <th style="border: 2px solid #000000;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-cogs"></i>
                                            <i class="fas fa-caret-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" x-placement="top-start">
          @if(Auth::user()->rol == 'admin') <li><a href="#" class="text-blue actualizar" producto="{{ $reserva->id }}"><i class="fas fa-sync-alt"></i> Actualizar Estado</a></li> @endif
                                            <li><a href="#" class="text-yellow editar" producto="{{ $reserva->id }}"><i class="fas fa-edit"></i> Editar Reserva</a></li>
                                            <li><a href="/eliminarReserva/{{ $reserva->id }}" class="text-red"><i class="fas fa-trash"></i> Eliminar Reserva</a></li>
          @if(Auth::user()->rol == 'admin') <li class="divider"></li> @endif
          @if(Auth::user()->rol == 'admin') <li><a href="#" class="asignar" producto="{{ $reserva->id }}"><i class="fas fa-calendar"></i> Asignar fecha</a></li> @endif
                                        </ul>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                @endif
            </div>

            <div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="" method="POST" id="actualizarForm">
                    @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h4 class="modal-title text-center" id="exampleModalLabel">
                                <i class="fas fa-sync-alt"></i> <b>ACTUALIZAR ESTADO</b>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form group">
                                    <label for="estado">Cambiar estado a: </label>
                                    <select name="estado" class="form-control">
                                        @foreach($estados as $estado)
                                            <option>{{ $estado->estado }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <div class="modal fade" id="fechas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-gray-light">
                                <h4 class="modal-title text-center" id="exampleModalLabel">
                                    <i class="fas fa-calendar"></i> <b>ASIGNAR FECHAS</b>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form group row" id="hide">
                                    <div class="col-md-3">
                                        <label for="estado">Nº DE FECHAS: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" id="cantidad" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" id="crear" class="btn btn-success">crear</button>
                                    </div>
                                </div>
                                <div class="form-group" id="fech"></div>
                            </div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
            </div>

            <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="" method="POST" id="editarForm">
                    @csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-yellow">
                                <h4 class="modal-title text-center" id="exampleModalLabel">
                                    <i class="fas fa-edit"></i> <b>EDITAR RESERVA</b>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="model">Modelo: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select type="text" name="modelo" id="modelo" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="model">Dia: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" name="dia" id="dia" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="model">Hora: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select type="text" name="hora" id="hor" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6" style="margin-top: 5px;">
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre*" class="form-control @error('nombre') is-invalid @enderror">
                                        @error('nombre') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6" style="margin-top: 5px;">
                                        <input type="text" name="telefono" id="telefono"placeholder="Telefono*" class="form-control @error('telefono') is-invalid @enderror">
                                        @error('telefono') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6" style="margin-top: 5px;">
                                        <input type="text" name="sociedad" id="sociedad" placeholder="Compañia/Sociedad*" class="form-control @error('sociedad') is-invalid @enderror">
                                        @error('sociedad') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6" style="margin-top: 5px;">
                                        <input type="text" name="cargo" id="cargo" placeholder="Cargo*" class="form-control @error('cargo') is-invalid @enderror">
                                        @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="text" name="email" id="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror">
                                        @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                @else
                    @yield('content')
                @endif
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            APOSTAMOS POR FUTURO
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="/">VISERAS SAKALI S.L</a>.</strong> Todos los derechos
        reservados.
    </footer>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/adm/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adm/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/adm/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function(){
        $('.actualizar').click(function(){
            $('#actualizarForm').attr('action','/actualizarReserva/' + $(this).attr('producto'));
            $('#actualizar').modal();
        });

        $('.editar').click(function(){
            $('#editarForm').attr('action','/editarReserva/' + $(this).attr('producto'));
            $.ajax({
                url: '/cargarReserva/' + $(this).attr('producto'),
                method: 'GET',
                success: function(data){
                    console.log(data);
                    $('#dia').val(data[0][0].dia);
                    $('#nombre').val(data[0][0].nombre);
                    $('#email').val(data[0][0].email);
                    $('#telefono').val(data[0][0].telefono);
                    $('#cargo').val(data[0][0].cargo);
                    $('#sociedad').val(data[0][0].sociedad);
                    var salida = "";
                    for(i = 0; i < data[1].length; i++){
                        if(data[1][i].submodelo == data[0][0].modelo){
                            salida += "<option selected>" + data[1][i].submodelo + "</option>";
                        } else {
                            salida += "<option>" + data[1][i].submodelo + "</option>";
                        }
                    }
                    var aux ="";
                    for(j = 0; j < data[2].length; j++){
                        if(data[2][j].reservada == 'reservada' && data[2][j].hora != data[0][0].hora){
                            aux+= "<option disabled>"+ data[2][j].hora +"❌</option>"
                        } else if(data[2][j].reservada == 'reservada' && data[2][j].hora == data[0][0].hora){
                            aux+= "<option disabled selected>"+ data[2][j].hora +"👈</option>"
                        } else {
                            aux += "<option  style='color:green;font-weight: bold;'>" + data[2][j].hora +"</option>";
                        }
                    }
                    $('#hor').html(aux);
                    $('#modelo').html(salida);
                    $('#editar').modal();

                    $('#dia').change(function(){
                        $.ajax({
                            url: '/cargarHoras/'+ $('#dia').val(),
                            type: 'GET',
                            success: function(data){
                                var aux1="";
                                for(i = 0; i < data.length; i++){
                                    if(data[i].reservada == 'reservada'){
                                        aux1+= "<option disabled>"+ data[i].hora +"❌</option>"
                                    } else {
                                        aux1 += "<option  style='color:green;font-weight: bold;' value='"+ data[i].id+"'>" + data[i].hora +"</option>";
                                    }
                                }
                                $('#hor').html(aux1);
                            }
                        });
                    });
                }
            });
        });

        $('.asignar').click(function(){
            var producto = $(this).attr('producto');
           $('#fechas').modal();
           $('#crear').click(function(){
               if($('#cantidad').val() > 0){
                var salida = "";
                salida+="<form action='/crearFechas/" + producto + "' method='POST'>";
                salida += '@csrf';
                $('#hide').hide();
                 for(i = 0; i < $('#cantidad').val(); i++){
                     salida += "<div class='form-group'><label>Fecha " + (i + 1) +": </label><input class='form-control dia' type='date' name='fecha[]'>"+
                     "<label>Hora "+ (i + 1) +":</label><select name='hora[]' class='form-control f_hora'><option>Seleccione primero una fecha...</option></select><div>";
                 }
                 salida+= '<div class="form-group" style="margin-top:15px;"><button type="button" id="cancelar" class="btn btn-danger pull-left"><i class="fas fa-trash"></i> Borrar fechas</button><button type="submit" class="btn btn-primary pull-right"><i class="fas fa-paper-plane"></i> Asignar Fechas</button></div></form>';
                 $('#fech').html(salida);
                 $('#cancelar').click(function(){
                    $('#fech').html('');
                     $('#hide').show();
                 });

                   $('.dia').change(function(){
                       var esc = $(this).parent();
                       $.ajax({
                           url: '/cargarHoras/'+ $(this).val(),
                           type: 'GET',
                           success: function(data){
                               var aux1="";
                               for(i = 0; i < data.length; i++){
                                   if(data[i].reservada == 'reservada'){
                                       aux1+= "<option disabled>"+ data[i].hora +"❌</option>"
                                   } else {
                                       aux1 += "<option  style='color:green;font-weight: bold;'>" + data[i].hora +"</option>";
                                   }
                               }
                            esc[0].children[3].innerHTML = aux1;
                           }
                       });
                   });


               }
           });
        });
    });
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>