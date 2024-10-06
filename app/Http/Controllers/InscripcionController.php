<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\TipoTaller;
use App\Services\TalleresService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InscripcionController extends Controller
{

    public function __construct(
        private TalleresService $talleresService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::view('pages.inscripciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposTalleres = TipoTaller::all();
        return Response::view('pages.inscripciones.create', compact('tiposTalleres'));
    }

    public function getProgramaByType($id){
        $programasAll = $this->talleresService->getProgramas($id);  
        return Response::json($programasAll);
    }

    public function getTalleresByType($id){
        $talleresAll = $this->talleresService->getTalleres($id);
        return Response::json($talleresAll);
    }

    public function getCiclosByType($id){
        $ciclosAll = $this->talleresService->getCiclos($id);
        return Response::json($ciclosAll);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcion)
    {
        //
    }
}
