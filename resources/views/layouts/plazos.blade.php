@extends('welcome')

@section('content')
    <div class="container rounded" style="background-color: white; padding: 5px;">
        <div class="alert alert-info">
            <p>Aquí encontrarás diferentes fechas propuestas para el montaje de tu pedido. En el caso de que dichas fechas le vengan mal, simplemente pinche en
                <button class="btn btn-danger dif" style="padding: 8px 15px;"><i class="fas fa-calendar"></i> Diferente Fecha</button> y seleccione la fecha y hora que mejor le convenga.
            </p>
        </div>
    @isset($fechas)
        @if(count($fechas) > 0)
        <table class="table table-bordered table-hover" style="border: 2px solid #000000">
            <thead class="bg-primary">
            <tr style="border: 2px solid #000000">
                <th scope="col" style="border: 2px solid #000000">FECHA</th>
                <th scope="col" style="border: 2px solid #000000">HORA</th>
                <th scope="col" style="border: 2px solid #000000">RESERVAR</th>
            </tr>
            </thead>
            <tbody>
            @foreach($fechas as $fecha)
                <tr style="border: 2px solid #000000">
                    <th style="border: 2px solid #000000">{{ date('d-m-Y',strtotime($fecha->fecha)) }}</th>
                    <th style="border: 2px solid #000000">{{ $fecha->hora }}</th>
                    <th style="border: 2px solid #000000" class="text-center">
                        <a href="/asignarPlazos/{{ $fecha->token }}/{{ $fecha->fecha }}/{{ $fecha->hora }}" class="btn btn-secondary" style="padding:10px 15px;">
                            <i class="fas fa-hand-pointer"></i> ASIGNAR PLAZO
                        </a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="diferente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="/diferentePlazo/{{$fecha->token}}" method="POST">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title text-center" id="exampleModalLabel" style="color: white;">
                                <i class="fas fa-calendar-check"></i><b> ASIGNAR UN PLAZO PERSONALIZADO</b>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form group row">
                                <div class="col-md-4">
                                    <label for="estado">Fecha:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="fecha" id="dia_dif" class="form-control" min="{{ $fechas[0]->fecha }}">
                                </div>
                            </div>
                            <div class="form group row" style="margin-top: 15px;">
                                <div class="col-md-4">
                                    <label for="estado">Hora:</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="hora" id="hora_dif" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 8px 15px;">Cerrar</button>
                            <button type="submit" class="btn btn-danger" style="padding: 8px 15px;">Asignar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif
    @endisset
    </div>
@endsection