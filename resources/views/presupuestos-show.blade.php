@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$titulo}}{{$presupuesto->nom}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                <div class="card-body">
                    <form action="{{route('presupuestos.update', $presupuesto->idPresupuesto)}}" method="post" class="form-inline">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="form-group col-8">
                        Nombre y Telefono : <input type="text" name="nomP" class="form-control form-control-sm" value="{{$presupuesto->nom}}"></div>
                        <div class="col-2"> Cerrado? <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="okP">
                        <option value="0" {{($presupuesto->ok == "0") ? 'selected' : '' }}>NO</option>
                        <option value="1"{{($presupuesto->ok == "1") ? 'selected' : '' }}>SI</option>
                        </select></div>
                </div>
                    <div class="form-group row">
                    Escenario : <textarea rows="4", cols="54" name="escP" class="form-control form-control-sm" style="resize:none, ">{{$presupuesto->esc}}</textarea>
                    Solicita : <textarea rows="4", cols="54" name="solP" class="form-control form-control-sm" style="resize:none, ">{{$presupuesto->sol}}</textarea>
                    Propuesta : <textarea rows="4", cols="54" name="proP" class="form-control form-control-sm" style="resize:none, ">{{$presupuesto->pro}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            Precio: <input type="text" name="valorP" class="form-control form-control-sm" value="{{$presupuesto->valor}}">
                        </div>
                    <div class="form-group mt-3 col-1">
                    <button type="submit" class="btn btn-warning btn-sm">Modificar</button>
                    </div></div></div>
                    </form>
                </div>
</div>
                <div class="card-footer fw-lighter text-black-50"></div>
            </div>
        </div>
    </div>
</div>
@endsection
