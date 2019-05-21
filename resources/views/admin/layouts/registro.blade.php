@extends('admin.principal')

@section('content')
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-industry"></i> REGISTRAR EMPRESA</h3>
            </div>
            <form role="form" action="/registroEmpresa" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control"  placeholder="Nombre/Empresa">
                        </div>
                        <div class="col-md-6">
                            <input type="email"  name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" name="cargo" class="form-control"  placeholder="Cargo">
                        </div>
                        <div class="col-md-6">
                            <input type="text"  name="telefono" class="form-control" placeholder="Telefono">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection