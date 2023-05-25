<?php

namespace App\Http\Controllers;

use App\Models\planes;
use Illuminate\Http\Request;

class PlanesController extends Controller
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
        $plan=planes::all();
        return view('planes', ['plan' => $plan, 'titulo'=>'Planes']);
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
        $agrego = new planes();
        $agrego->nombre = $request->nombreP;
        $agrego->capacidad = $request->capacidadP;
        $agrego->precio = $request->precioP;
        $agrego->save();
        return redirect()->route('planes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function show(planes $planes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function edit(planes $planes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, planes $plan)
    {
        $update = planes::find($plan->idPlan);
        $update->nombre = $request->nombre;
        $update->capacidad = $request->capacidad;
        $update->precio = $request->precio;
        $update->save();
        return redirect()->route('planes.index')->with('mensajeOk', 'Plan Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function destroy(planes $idPlan)
    {
        $elimino=planes::find($idPlan->idPlan);
        $elimino->delete();
        return redirect()->route('planes.index')->with('mensajeOk', 'Plan Eliminado');
    }
}
