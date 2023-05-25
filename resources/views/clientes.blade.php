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
                    <th>ID</th><th>Nombre</th><th>Domicilio</th><th>Tel.</th><th>eMail</th><th>Plan</th><th>Server</th><th>Leer/Mod</th><th>Eliminar</th></thead>
                    <tbody>
                    @foreach ($clientes as $VAR)
                        <tr scope="row" class="align-middle"><td>{{$VAR->idCliente}}</td>
                        <td>{{$VAR->cn}}</td>
                        <td>{{$VAR->direccion}}</td>
                        <td>{{$VAR->telefono}}</td>
                        <td>{{$VAR->mail}}</td>
                        <td>{{$VAR->pn}}</td>
                        <td><{{$VAR->sn}}</td>
                        <td>

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$VAR->idCliente}}">{{$VAR->cn}}</button>

<!-- Modal -->
<div class="modal fade" id="m{{$VAR->idCliente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar {{$VAR->cn}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('clientes.update', $VAR->idCliente)}}" method="post">
       @csrf
       @method('put')
       <div class="modal-body">
        <div class="row">
                    <div class="col">
       Nombre
       <input type="text" name="nombreC" class="form-control form-control-sm" value="{{$VAR->cn}}"></div><div class="col">
       Domicilio
       <input type="text" name="direccionC" class="form-control form-control-sm" value="{{$VAR->direccion}}"></div>
        <div class="row">
                    <div class="col">
       Tel.
       <input type="text" name="telefonoC" class="form-control form-control-sm" value="{{$VAR->telefono}}"></div><div class="col">
       eMail.
       <input type="text" name="mailC" class="form-control form-control-sm" value="{{$VAR->mail}}"></div>
        <div class="row">
                    <div class="col">
       Plan
       <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idPlanC">
                @foreach ($planes as $pl)
                <option {{ ( $VAR->idPlan == $pl->idPlan) ? 'selected' : '' }} value="{{$pl->idPlan}}">{{$pl->nombre}}</option>
                @endforeach
            </select></div><div class="col">
       Server
       <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idServerC">
                @foreach ($servers as $sv)
                <option {{ ( $VAR->idServer == $sv->idServer) ? 'selected' : '' }} value="{{$sv->idServer}}">{{$sv->nombre}}</option>
                @endforeach
            </select></div>
            <div class="form-group mb-2">
                    Detalle
                    <textarea rows="4", cols="54" name="detalleC" class="form-control form-control-sm" style="resize:none, ">{{$VAR->detalle}}</textarea>

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
<form action="{{route('clientes.destroy', $VAR->idCliente)}}" method="post">
@csrf
@method('delete')
<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar al Cliente  {{$VAR->cn}}?')">{{$VAR->cn}}</button></form>
</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    </div>
        <div class="row align-middle">
          <div class="col-1"></div>
                    <div class="col-7 ml-2">
                    <form action="{{route('clientes.store')}}" method="post" class="form-inline">
                    @csrf
                    <div class="row">
                    <div class="col">
                    Nombre
                    <input type="text" name="nombreC" class="form-control form-control-sm"></div><div class="col">
                    Domicilio
                    <input type="text" name="direccionC" class="form-control form-control-sm"></div>
                    </div>
                    <div class="row">
                    <div class="col">
                    Tel.
                    <input type="text" name="telefonoC" class="form-control form-control-sm"></div><div class="col">
                    eMail.
                    <input type="text" name="mailC" class="form-control form-control-sm">
                    </div></div>
                    <div class="row">
                    <div class="col">
                    Plan
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idPlanC">
                                @foreach ($planes as $pl)
                              <option value="{{$pl->idPlan}}">{{$pl->nombre}}</option>
                                @endforeach
                            </select></div>
                            <div class="col">
                    Server
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idServerC">
                                @foreach ($servers as $sv)
                             <option value="{{$sv->idServer}}">{{$sv->nombre}}</option>
                                @endforeach
                            </select>
                            </div>
                  </div>
                    <div class="form-group mb-2">
                    Detalle
                    <textarea rows="4", cols="54" name="detalleC" class="form-control form-control-sm" style="resize:none, "></textarea>

                    <button type="button" class="btn btn-success btn-sm">Agregar</button>
                    </div>
                    </form>
                    </div>
                    
                    
                    <div class="col-3">
                    <table class="table table-sn table-hover">
                    <th>Server</th><th>Usado</th><th>Total</th>
                    @foreach ($totales as $tot)
                    @php($x=$tot->tot/$tot->cap)
                    <tr
                    {{($x >= 0.8)? 'class=table-danger': ''}}
                    ><td><a href="{{route('clientes.show', $tot->idServer)}}">{{$tot->nombre}}</a></td><td>{{$tot->tot}}</td><td>{{$tot->cap}}</td></tr>
                    @endforeach
                    </table>
                    </div>
                    <div class="col-1"></div>
        </div>
                <div class="card-footer fw-lighter text-black-50"></div>
            </div>
        </div>
    </div>
</div>
@endsection
