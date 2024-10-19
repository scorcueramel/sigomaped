<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscripcionNuevoRequest;
use App\Models\Inscripcion;
use App\Models\TipoTaller;
use App\Services\CicloHorarioService;
use App\Services\CiclosService;
use App\Services\InscripcionEsperaService;
use App\Services\InscripcionService;
use App\Services\PersonaService;
use App\Services\ProgramaService;
use App\Services\TalleresService;
use App\Services\TipoTallerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class InscripcionController extends Controller
{

    public function __construct(
        private PersonaService $personaService,
        private ProgramaService $programaService,
        private CiclosService $ciclosService,
        private CicloHorarioService $cicloHorarioService,
        private TalleresService $talleresService,
        private InscripcionService $inscripcionService,
        private InscripcionEsperaService $inscripcionEsperaService,
        private TipoTallerService $tipoTallerService,
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $programas = $this->programaService->getProgramasAll();
        $listaEspera = $this->inscripcionEsperaService->getListaEspera();
        return view('pages.inscripciones.index', ['programas'=>$programas,'listaEspera'=>$listaEspera]);
    }

    public function calendar():View{
        $tiposProgramas = $this->tipoTallerService->getTiposTalleres();
        $listaEspera = $this->inscripcionEsperaService->getListaEspera();
        return view('pages.inscripciones.calendario', ['listaEspera'=>$listaEspera,'tiposPorgramas'=>$tiposProgramas]);
    }

    public function getAnioPeriodoByTaller($id): JsonResponse{
        $ciclosByTaller = $this->ciclosService->getCiclosBytaller($id);
        return Response::json($ciclosByTaller);
    }

    public function getDiasByPeriodAndYear($id): JsonResponse{
        $inscritosCiclo = $this->inscripcionService->getDiasInscritos($id);
        return Response::json($inscritosCiclo);
    }

    public function getInscritoToCicle($id): JsonResponse{
        $inscritosCiclo = $this->inscripcionService->getInscritos($id);
        return Response::json($inscritosCiclo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $tiposTalleres = $this->tipoTallerService->getTiposTalleres();
        return view('pages.inscripciones.create', compact('tiposTalleres'));
    }

    public function validateAlumnoInscription($tipo_programa,$alumno_id){
        $validatation = $this->programaService->getValidateInscriptionUser($tipo_programa,$alumno_id);
        return Response::json($validatation);
    }

    public function getPersonaByDocument($documento): JsonResponse {
        $persona = $this->personaService->getPersonas($documento);
        if(count($persona)>0)
            return Response::json($persona);
        else
            return Response::json(['mensaje'=>'No se encontro al alumno con el documento ingresado']);
    }

    public function getProgramaByType($id): JsonResponse{
        $programasAll = $this->programaService->getProgramas($id);
        return Response::json($programasAll);
    }

    public function getTalleresByType($id): JsonResponse{
        $talleresAll = $this->talleresService->getTalleres($id);
        return Response::json($talleresAll);
    }

    public function getCiclosByType($id): JsonResponse{
        $ciclosAll = $this->ciclosService->getCiclosBytaller($id);
        return Response::json($ciclosAll);
    }

    public function getCiclosByHorarios($id): JsonResponse{
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
    public function store(InscripcionNuevoRequest $request):JsonResponse
    {
        $request->input('alumnoId');
        $request->input('horarioId');
        $enEspera = $request->input('listaEspera');
        $request->input('tallerId');

        if($enEspera == 0 || $enEspera == 2)
            $registerCode = $this->inscripcionService->inscribirAlumno($request->inscripcion);
        elseif($enEspera == 1)
            $registerCode = $this->inscripcionEsperaService->inscribirEspera($request->personaespera);

        if($registerCode === 100)
            return Response::json(['code'=>$registerCode,'mensaje'=>'El alumno ya encuenta inscrito al taller seleccionado, puedes verificarlo en la sección de inscritos.']);
        elseif($registerCode === 200)
            return Response::json(['code'=>$registerCode,'mensaje'=>'Alumno inscrito correctamente!']);
        elseif($registerCode === 300)
            return Response::json(['code'=>$registerCode,'mensaje'=> 'El alumno ya se encuentra en lista de espera para el taller seleccionado.']);
        elseif($registerCode === 400)
            return Response::json(['code'=>$registerCode,'mensaje'=> 'Ya no quedan cupos en este periodo para el taller elejido, te recomendamos inscribirlo en la lista de espera para la apertura de un nuevo ciclo.']);
        else
            return Response::json(['code'=>500,'mensaje'=> 'Algo sucedio al intentar inscribir al alumno, comuniquese con sistemas porfavor.']);
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
