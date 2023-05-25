@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{$titulo}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-sn table-hover">
                    <thead>
                    <th>ID</th><th>Marca **</th><th>IP</th><th>Nombre</th><th>Capacidad</th><th>Modificar</th><th>Eliminar</th></thead>
                    <tbody>
                    @foreach ($server as $VAR)
                    <tr class="align-middle"><td>{{$VAR->idServer}}</td>
                        <td>{{$VAR->marca}}</td>
                        <td>{{$VAR->ip}}</td>
                        <td>{{$VAR->nombre}}</td>
                        <td>{{$VAR->cap}}</td>
                        <td>

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$VAR->idServer}}">{{$VAR->nombre}}</button>

<!-- Modal -->
<div class="modal fade" id="m{{$VAR->idServer}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar {{$VAR->nombre}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('servers.update', $VAR->idServer)}}" method="post">
       @csrf
       @method('put')
       <div class="modal-body">
        Nombre
       <input type="text" name="nombre" class="form-control form-control-sm" value="{{$VAR->nombre}}">
       Marca **
       <input type="text" name="marca" class="form-control form-control-sm" value="{{$VAR->marca}}">
       IP
       <input type="text" name="ip" class="form-control form-control-sm" value="{{$VAR->ip}}">
       Capacidad
       <input type="text" name="cap" class="form-control form-control-sm" value="{{$VAR->cap}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
      </div>
</form>
    </div>
  </div>
</div>
</td>


                        <td>
                        <form action="{{route('servers.destroy', $VAR->idServer)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar el Server  {{$VAR->nombre}}?')">{{$VAR->nombre}}</button>
                        </form>
                        </td>

                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <form action="{{route('servers.store')}}" method="post" class="form-inline">
                    @csrf
                    <div class="row">
                    <div class="form-group mb-2 col-3">
                    Marca ** : <input type="text" name="marcaS" class="form-control form-control-sm">
                    ip : <input type="text" name="ipS" class="form-control form-control-sm">
                    Nombre : <input type="text" name="nombreS" class="form-control form-control-sm">
                    Capacidad : <input type="text" name="capS" class="form-control form-control-sm">
                    </div> <div class="form-group mb-2 col-1">
                    <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                    </div></div>
                    </form>
                </div>
                <div class="card-footer fw-lighter text-black-50">** Marca Modelo Procesador Ram</div>
            </div>
        </div>
    </div>
</div>
@endsection
