<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\TipoTaller;
use App\Services\CicloHorarioService;
use App\Services\CiclosService;
use App\Services\InscripcionService;
use App\Services\PersonaService;
use App\Services\ProgramaService;
use App\Services\TalleresService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class InscripcionController extends Controller
{

    public function __construct(
        private PersonaService $personaService,
        private ProgramaService $programaService,
        private CiclosService $ciclosService,
        private CicloHorarioService $cicloHorarioService,
        private TalleresService $talleresService,
        private InscripcionService $inscripcionService,
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programas = $this->programaService->getProgramasAll();
        return Response::view('pages.inscripciones.index', ['programas'=>$programas]);
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

    public function getPersonaByDocumento($documento) {
        $persona = $this->personaService->getPersonas($documento);
        if(count($persona)>0)
            return Response::json($persona);
        else            
            return Response::json(['mensaje'=>'No se encontro al alumno con el documento ingresado']);
    }

    public function getProgramaByType($id){
        $programasAll = $this->programaService->getProgramas($id);  
        return Response::json($programasAll);
    }

    public function getTalleresByType($id){
        $talleresAll = $this->talleresService->getTalleres($id);
        return Response::json($talleresAll);
    }

    public function getCiclosByType($id){
        $ciclosAll = $this->ciclosService->getCiclos($id);
        return Response::json($ciclosAll);
    }

    public function getCiclosByHorarios($id){
        $ciclosHorariosAll = $this->cicloHorarioService->getHorarioCiclos($id);
        if(count($ciclosHorariosAll) > 0)
            return Response::json($ciclosHorariosAll);
        else
            return Response::json(['mensaje'=>'No hay días disponibles para el periodo elegido']);
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
