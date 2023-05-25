@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <th>ID</th><th>Plan **</th><th>Capacidad</th><th>Precio</th><th>Modificar</th><th>Eliminar</th></thead>
                    <tbody>
                    @foreach ($plan as $VAR)
                        <tr class="align-middle"><td>{{$VAR->idPlan}}</td>
                        <td>{{$VAR->nombre}}</td>
                        <td>{{$VAR->capacidad}} G</td>
                        <td>{{$VAR->precio}}</td>
                    
                        <td>

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$VAR->idPlan}}">{{$VAR->nombre}}</button>

<!-- Modal -->
<div class="modal fade" id="m{{$VAR->idPlan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar {{$VAR->nombre}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('planes.update', $VAR->idPlan)}}" method="post">
       @csrf
       @method('put')
       <div class="modal-body">
        Nombre
       <input type="text" name="nombre" class="form-control form-control-sm" value="{{$VAR->nombre}}">
        Capacidad
       <input type="text" name="capacidad" class="form-control form-control-sm" value="{{$VAR->capacidad}}">
        Precio
       <input type="text" name="precio" class="form-control form-control-sm" value="{{$VAR->precio}}">
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
                        <form action="{{route('planes.destroy', $VAR->idPlan)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar el Plan  {{$VAR->idPlan}}?')">{{$VAR->nombre}}</button>
                        </form>
                        </td>

                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <form action="{{route('planes.store')}}" method="post" class="form-inline">
                    @csrf
                    <div class="row">
                    <div class="form-group mb-2 col-3">
                    Nombre : <input type="text" name="nombreP" class="form-control form-control-sm">
                    Capacidad en Gigas : <input type="text" name="capacidadP" class="form-control form-control-sm">
                    Precio en Pesos : <input type="text" name="precioP" class="form-control form-control-sm">
                    </div> <div class="form-group mb-2 col-1">
                    <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                    </div></div>
                    </form>
                </div>
                <div class="card-footer fw-lighter text-black-50">** N:NextCoud</div>
            </div>
        </div>
    </div>
</div>
@endsection
