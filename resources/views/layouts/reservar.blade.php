@extends('welcome')

@section('content')
    <div class="container rounded" style="background-color: white; padding: 15px;">
        @isset($msg)
            <div class="alert alert-success text-center">
                {{ $msg }}
            </div>
        @endisset
        <div class="form-group row">
            <div class="col-md-4">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" class="form-control">
                    <option>seleccionar marca...</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ strtoupper($marca->marca) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="modelo">Modelo</label>
                <select name="modelo" id="modelo" class="form-control">
                    <option>seleccionar modelo...</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="carroceria">Año y Carrocería</label>
                <select name="carroceria" id="carroceria" class="form-control">
                    <option>seleccionar año y carroceria...</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="fecha">Horas Disponibles</label>
                <select name="hora" id="hora" class="form-control"></select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" style="padding: 10px; margin-left: 100px; margin-top: 25px;"
                        id="reservar">
                    <i class="fas fa-calendar"></i> RESERVAR
                </button>
            </div>
        </div>
            <div class="form-group">
                <ul class="list-group list-group-horizontal-xl">
                    <li class="list-group-item" style="border: 1px solid black;">LEYENDA: </li>
                    <li class="list-group-item" style="border: 1px solid black;">Reserva Disponible: <span style="color:green;font-weight: bold;"> 00:00:00</span></li>
                    <li class="list-group-item" style="border: 1px solid black;">Reserva Provisional: <span style="color:orangered;font-weight: bold;"> 00:00:00 🎫</span></li>
                    <li class="list-group-item" style="border: 1px solid black;">Reserva ocupada: <span style="color:rgb(128, 128, 128);"> 00:00:00 ❌</span></li>
                </ul>
            </div>
    </div>
    <!-- Modal -->
    @if(Auth::check())
    <form action="/reservar" method="POST">
        <div class="modal fade" id="aviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar"></i> DATOS DE LA RESERVA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <h5 style="margin-bottom: 20px;" class="text-center">¡ COMPRUEBE SUS DATOS !</h5>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="model">Modelo: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="modelo" id="mod" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="model">Dia: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" name="dia" id="dia" class="form-control" value="{{old('dia')}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="model">Hora: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="hora" id="hor" class="form-control" value="{{old('hora')}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6" style="margin-top: 5px;">
                                <input type="text" name="nombre" placeholder="Nombre*" class="form-control @error('nombre') is-invalid @enderror" value="{{ Auth::user()->name }}">
                                @error('nombre') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6" style="margin-top: 5px;">
                                <input type="text" name="telefono" placeholder="Telefono*" class="form-control @error('telefono') is-invalid @enderror" value="{{ Auth::user()->telefono }}">
                                @error('telefono') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6" style="margin-top: 5px;">
                                <input type="text" name="sociedad" placeholder="Compañia/Sociedad*" class="form-control @error('sociedad') is-invalid @enderror" value="{{ Auth::user()->name }}">
                                @error('sociedad') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6" style="margin-top: 5px;">
                                <input type="text" name="cargo" placeholder="Cargo*" class="form-control @error('cargo') is-invalid @enderror" value="{{ Auth::user()->cargo }}">
                                @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" name="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
                                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px;">Cerrar</button>
                        <button type="submit" class="btn btn-primary" style="padding: 10px;" id="dis"><i class="fas fa-check"></i>Confirmar Reserva</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
        <form action="/reservar" method="POST">
            <div class="modal fade" id="aviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar"></i> DATOS DE LA RESERVA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <h5 style="margin-bottom: 20px;" class="text-center">¡ COMPRUEBE SUS DATOS !</h5>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="model">Modelo: </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="modelo" id="mod" class="form-control" value="{{old('modelo')}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="model">Dia: </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="dia" id="dia" class="form-control" value="{{old('dia')}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="model">Hora: </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="hora" id="hor" class="form-control" value="{{old('hora')}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6" style="margin-top: 5px;">
                                    <input type="text" name="nombre" placeholder="Nombre*" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">
                                    @error('nombre') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 5px;">
                                    <input type="text" name="telefono" placeholder="Telefono*" class="form-control @error('telefono') is-invalid @enderror" value="{{old('telefono')}}">
                                    @error('telefono') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6" style="margin-top: 5px;">
                                    <input type="text" name="sociedad" placeholder="Compañia/Sociedad*" class="form-control @error('sociedad') is-invalid @enderror" value="{{old('sociedad')}}">
                                    @error('sociedad') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 5px;">
                                    <input type="text" name="cargo" placeholder="Cargo*" class="form-control @error('cargo') is-invalid @enderror" value="{{old('cargo')}}">
                                    @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" name="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                    @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p>
                                        <input type="checkbox" name="politicas" id="politicas" value="1" @if(old('politicas') == 1) checked @endif> He leído y acepto el Aviso Legal y la Política de Privacidad
                                        @error('politicas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px;">Cerrar</button>
                            <button type="submit" class="btn btn-primary" style="padding: 10px;" id="dis"><i class="fas fa-check"></i>Confirmar Reserva</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection