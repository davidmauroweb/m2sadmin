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
                    <th>ID</th><th>Contacto</th><th>Estado</th><th>Precio</th><th>Fecha</th><th>Modificar</th><th>Eliminar</th></thead>
                    <tbody>
                    @foreach ($presupuesto as $VAR)
                        <tr class="align-middle {{($VAR->ok == '0') ? 'table-warning' : '' }}"><td>{{$VAR->idPresupuesto}}</td>
                        <td>{{$VAR->nom}}</td>
                        <td>
                            @if ($VAR->ok =='1')
                            Cerrado
                            @else
                            <div class="text-warning">Pendiente</div>
                            @endif
                        </td>
                        <td>
                            @if ($VAR->valor != '')
                            {{ $VAR->valor }}
                            @else
                            'No Definido'
                            @endif
                        </td>
                        <td>@php
                        $date = Carbon\Carbon::parse($VAR->updated_at)->format('d-m-Y');
                        @endphp
                        {{$date}}
                    </td>
                        <td>
                        <a href="{{route('presupuestos.show', $VAR->idPresupuesto)}}"><button type="submit" class="btn btn-warning btn-sm">{{$VAR->nom}}</button></a>
                        </td>
                        
                        <td>
                        <form action="{{route('presupuestos.destroy', $VAR->idPresupuesto)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar el Presupuesto de {{$VAR->nom}}?')">{{$VAR->nom}}</button>
                        </form>
                        </td>

                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <form action="{{route('presupuestos.store')}}" method="post" class="form-inline">
                    @csrf
                    <div class="row">
                    <div class="form-group">
                    Nombre y Telefono : <input type="text" name="nomP" class="form-control form-control-sm">
                    Escenario : <textarea rows="4", cols="54" name="escP" class="form-control form-control-sm" style="resize:none, "></textarea>
                    Solicita : <textarea rows="4", cols="54" name="solP" class="form-control form-control-sm" style="resize:none, "></textarea>
                    </div>
                    <div class="row">
                    <div class="form-group mb-2 col-1">
                    <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                    </div></div></div>
                    </form>
                </div>
                <div class="card-footer fw-lighter text-black-50"></div>
            </div>
        </div>
    </div>
</div>
@endsection
