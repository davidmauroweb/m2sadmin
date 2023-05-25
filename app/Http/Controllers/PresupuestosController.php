<?php

namespace App\Http\Controllers;

use App\Models\presupuestos;
use Illuminate\Http\Request;

class PresupuestosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $presupuesto=presupuestos::all('idPresupuesto','nom','ok','valor','updated_at');
        return view('presupuestos', ['presupuesto' => $presupuesto, 'titulo'=>'Prespuestos']);
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
        $agrego = new presupuestos();
        $agrego->nom = $request->nomP;
        $agrego->esc = $request->escP;
        $agrego->sol = $request->solP;
        $agrego->save();
        return redirect()->route('presupuestos.index')->with('mensajeOk', 'Presupuesto Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function show(presupuestos $idPresupuesto)
    {
        $show = presupuestos::find($idPresupuesto->idPresupuesto);
        return view('presupuestos-show', ['presupuesto'=>$show, 'titulo'=>'Presupuesto de ']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function edit(presupuestos $presupuestos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, presupuestos $pre)
    {
        $update = presupuestos::find($pre->idPresupuesto);
        $update->nom = $request->nomP;
        $update->esc = $request->escP;
        $update->sol = $request->solP;
        $update->pro = $request->proP;
        $update->valor = $request->valorP;
        $update->ok = $request->okP;
        $update->save();
        return redirect()->route('presupuestos.index')->with('mensajeOk','Presupuesto Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function destroy(presupuestos $pre)
    {
        $elimino=presupuestos::find($pre->idPresupuesto);
        $elimino->delete();
        return redirect()->route('presupuestos.index')->with('mensajeOk', 'Presupuesto Eliminado');
    }
}
