<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\{clientes,servers,planes};
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers=servers::all();
        $planes=planes::all();
        $clientes=clientes::select('idCliente','clientes.nombre as cn','direccion','telefono','mail','detalle','clientes.idPlan','planes.idPlan','planes.nombre as pn','planes.capacidad as cp','servers.idServer','servers.nombre as sn')
         ->join('planes','planes.idPlan', 'clientes.idPlan')
         ->join('servers','servers.idServer', 'clientes.idServer')
         ->orderby('idCliente')
         ->get();
        $totales=clientes::select(DB::raw('servers.nombre,servers.cap,servers.idServer,sum(planes.capacidad) as tot'))
            ->join('planes','planes.idPlan','=','clientes.idPlan')
            ->join('servers','servers.idServer','=','clientes.idServer')
            ->groupBy('clientes.idServer')
            ->get();
            return view('clientes', [
            'clientes' => $clientes,
            'planes' => $planes,
            'servers' => $servers,
            'totales'=> $totales,
            'titulo'=>'Clientes']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agrego = new clientes();
        $agrego->nombre = $request->nombreC;
        $agrego->direccion = $request->direccionC;
        $agrego->telefono = $request->telefonoC;
        $agrego->mail = $request->mailC;
        $agrego->idPlan = $request->idPlanC;
        $agrego->idServer = $request->idServerC;
        $agrego->detalle = $request->detalleC;
        $agrego->save();
        return redirect()->route('clientes.index')->with('mensajeOk', 'Cliente Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(servers $idServer)
    {
        $servers=servers::all();
        $planes=planes::all();
        $clientes=clientes::select('idCliente','clientes.nombre as cn','direccion','telefono','mail','detalle','clientes.idPlan','planes.idPlan','planes.nombre as pn','planes.capacidad as cp','servers.idServer','servers.nombre as sn')
         ->where('clientes.idServer','=', $idServer->idServer)
         ->join('planes','planes.idPlan', 'clientes.idPlan')
         ->join('servers','servers.idServer', 'clientes.idServer')
         ->orderby('idCliente')
         ->get();
        $totales=clientes::select(DB::raw('servers.nombre,servers.cap,servers.idServer,sum(planes.capacidad) as tot'))
            ->where('clientes.idServer','=', $idServer->idServer)
            ->join('planes','planes.idPlan','=','clientes.idPlan')
            ->join('servers','servers.idServer','=','clientes.idServer')
            ->groupBy('clientes.idServer')
            ->get();
            return view('clientes', [
            'clientes' => $clientes,
            'planes' => $planes,
            'servers' => $servers,
            'totales'=> $totales,
            'titulo'=>'Clientes']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clientes $cliente)
    {
        $update = clientes::find($cliente->idCliente);
        $update->nombre = $request->nombreC;
        $update->direccion = $request->direccionC;
        $update->telefono = $request->telefonoC;
        $update->mail = $request->mailC;
        $update->idPlan = $request->idPlanC;
        $update->idServer = $request->idServerC;
        $update->detalle = $request->detalleC;
        $update->save();
        return redirect()->route('clientes.index')->with('mensajeOk', 'Cliente Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientes $idCliente)
    {
        $elimino=clientes::find($idCliente->idCliente);
        $elimino->delete();
        return redirect()->route('clientes.index')->with('mensajeOk', 'Cliente Eliminado');
    }
}