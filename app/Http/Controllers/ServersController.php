<?php

namespace App\Http\Controllers;

use App\Models\servers;
use Illuminate\Http\Request;

class ServersController extends Controller
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
        return view('servers', ['server' => $servers, 'titulo'=>'Servidores']);
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
        $agrego = new servers();
        $agrego->marca = $request->marcaS;
        $agrego->ip = $request->ipS;
        $agrego->nombre = $request->nombreS;
        $agrego->cap = $request->capS;
        $agrego->save();
        return redirect()->route('servers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function show(servers $servers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function edit(servers $servers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, servers $server)
    {
        $update = servers::find($server->idServer);
        $update->marca = $request->marca;
        $update->ip = $request->ip;
        $update->nombre = $request->nombre;
        $update->cap = $request->cap;
        $update->save();
        return redirect()->route('servers.index')->with('mensajeOk', 'Server Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function destroy(servers $idServer)
    {
        $elimino=servers::find($idServer->idServer);
        $elimino->delete();
        return redirect()->route('servers.index')->with('mensajeOk', 'Server Eliminado');
    }
}
