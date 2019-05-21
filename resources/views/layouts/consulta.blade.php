@extends('welcome')

@section('content')
    <div class="container rounded" style="background-color: white; padding: 25px;">
        <h4 class="text-center"><i class="fas fa-eye"></i> ESTADO DE LA RESERVA</h4>
        <div class="alert alert-info">
            <p>Para consultar el estado de la reserva, introduzca la referencia que encontrará en su email o teléfono de contacto facilitado.</p>
            <p><i class="fas fa-asterisk"></i> <b>Puede consultar varias reservas, separandolas con comas ej. Referencia1,Referencia2,Referencia3...</b></p>
        </div>
        <div class="form-group row">
            <div class="col-md-10">
                <input type="search" id="referencia" class="form-control" placeholder="Buscar por referencia...🔎 Ref1,Ref2,Ref3...">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-secondary btn-secondary" style="padding:10px 15px;" id="buscar">Buscar</button>
            </div>
        </div>
        <div class="col-md-12" id="resultado"></div>
    </div>
@endsection