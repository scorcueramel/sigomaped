<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscripcionNuevoRequest;
use App\Models\Inscripcion;
use App\Models\TipoTaller;
use App\Services\CalendarioService;
use App\Services\CicloHorarioService;
use App\Services\CiclosService;
use App\Services\DiaService;
use App\Services\InscripcionEsperaService;
use App\Services\InscripcionService;
use App\Services\PersonaService;
use App\Services\ProgramaService;
use App\Services\TallerService;
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
        private TallerService $TallerService,
        private InscripcionService $inscripcionService,
        private InscripcionEsperaService $inscripcionEsperaService,
        private TipoTallerService $tipoTallerService,
        private CalendarioService $calendarioService,
        private DiaService $diaService,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $programas = $this->programaService->getProgramasWithInscritos();
        $listaEspera = $this->inscripcionEsperaService->getListaEspera();
        return view('pages.inscripciones.index', ['programas' => $programas, 'listaEspera' => $listaEspera]);
    }

    public function calendar(): View
    {
        $tiposProgramas = $this->tipoTallerService->getTiposTalleres();
        $listaEspera = $this->inscripcionEsperaService->getListaEspera();
        return view('pages.inscripciones.calendario', ['listaEspera' => $listaEspera, 'tiposPorgramas' => $tiposProgramas]);
    }

    public function getCalendarByParams(int $tipoTallerid, int $porgramaid, int $tallerid): JsonResponse
    {

        $cargaCalendario = $this->calendarioService->getCalendarioLista($tipoTallerid, $porgramaid, $tallerid);
        $listaCalendario = [];


        foreach ($cargaCalendario as $carga) {
            $listaCalendario[] = [
                'title' => $carga['title'],
                'start' =>  $carga['start'],
                'end' => $carga['end'],
                'backgroundColor' =>  $this->colorsCalendar()[$carga['tallerid']],
                'borderColor' =>  $this->colorsCalendar()[$carga['tallerid']],
                // 'extendedProps' => [
                //     'sede' => $sede->descripcion,
                //     'lugar' => $lugar->descripcion,
                //     'categoria_id' => $inscrito->categoria_id,
                //     'categoria' => $inscrito->categoria,
                //     'fecha' => $fecha,
                //     'inicio' => $inicio,
                //     'fin' => $fin,
                //     'correo' => $inscrito->email,
                //     'movil' => $inscrito->movil,
                //     'color' =>  $colores[$inscrito->categoria_id],
                //     'servicioinscripcion' => $inscrito->servicioinscripcion_id
                // ],
            ];
        }
        dd();
        return Response::json($listaCalendario);
    }

    private function colorsCalendar():array{
        return [
            1=>'#1A5319',
            2=>'#FABC3F',
            3=>'#E85C0D',
            4=>'#C7253E',
            5=>'#0D7C66',
            6=>'#3A1078',
            7=>'#41B3A2',
            8=>'#BDE8CA',
            9=>'#821131',
            10=>'#4E31AA',
            11=>'#800000',
            12=>'#5B99C2',
            13=>'#1A4870',
            14=>'#674188',
            15=>'#4158A6',
            16=>'#7C00FE',
            17=>'#C63C51',
            18=>'#FF8225',
            19=>'#F6FB7A',
            20=>'#399918',
            21=>'#3FA2F6',
        ];
    }

    public function getDiaByTaller($id): JsonResponse
    {
        $ciclosByTaller = $this->diaService->getDiasBytaller($id);
        return Response::json($ciclosByTaller);
    }

    public function getInscritosByTallerDia(int $taller, int $dia): JsonResponse
    {
        $inscritosCiclo = $this->inscripcionService->getInscripcionesByTallerDia($taller,$dia);
        return Response::json($inscritosCiclo);
    }

    public function getInscritoToCicle($id): JsonResponse
    {
        $inscritosCiclo = $this->inscripcionService->getInscritos($id);
        return Response::json($inscritosCiclo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $tiposTalleres = $this->tipoTallerService->getTiposTalleres();
        return view('pages.inscripciones.create', compact('tiposTalleres'));
    }

    public function validateAlumnoInscription($tipo_programa, $alumno_id)
    {
        $validatation = $this->programaService->getValidateInscriptionUser($tipo_programa, $alumno_id);
        return Response::json($validatation);
    }

    public function getPersonaByDocument($documento): JsonResponse
    {
        $persona = $this->personaService->getPersonas($documento);
        if (count($persona) > 0)
            return Response::json($persona);
        else
            return Response::json(['mensaje' => 'No se encontro al alumno con el documento ingresado']);
    }

    public function getProgramaByType($id): JsonResponse
    {
        $programasAll = $this->programaService->getProgramas($id);
        return Response::json($programasAll);
    }

    public function getTalleresByType($id): JsonResponse
    {
        $talleresAll = $this->TallerService->getTalleresByProgramas($id);
        return Response::json($talleresAll);
    }

    public function getTalleresWithInscripcions(int $id): JsonResponse
    {
        $talleresinscripcions = $this->TallerService->getTalleresWithInscripciones($id);
        return Response::json($talleresinscripcions);
    }

    public function getCiclosByType($id): JsonResponse
    {
        $ciclosAll = $this->ciclosService->getCiclosBytaller($id);
        return Response::json($ciclosAll);
    }

    public function getCiclosByHorarios($id): JsonResponse
    {
        $ciclosHorariosAll = $this->cicloHorarioService->getHorarioCiclos($id);
        if (count($ciclosHorariosAll) > 0)
            return Response::json($ciclosHorariosAll);
        else
            return Response::json(['mensaje' => 'No hay días disponibles para el periodo elegido']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InscripcionNuevoRequest $request): JsonResponse
    {
        $request->input('alumnoId');
        $request->input('horarioId');
        $enEspera = $request->input('listaEspera');
        $request->input('tallerId');

        if ($enEspera == 0 || $enEspera == 2)
            $registerCode = $this->inscripcionService->inscribirAlumno($request->inscripcion);
        elseif ($enEspera == 1)
            $registerCode = $this->inscripcionEsperaService->inscribirEspera($request->personaespera);

        if ($registerCode === 100)
            return Response::json(['code' => $registerCode, 'mensaje' => 'El alumno ya encuenta inscrito al taller seleccionado, puedes verificarlo en la sección de inscritos.']);
        elseif ($registerCode === 200)
            return Response::json(['code' => $registerCode, 'mensaje' => 'Alumno inscrito correctamente!']);
        elseif ($registerCode === 300)
            return Response::json(['code' => $registerCode, 'mensaje' => 'El alumno ya se encuentra en lista de espera para el taller seleccionado.']);
        elseif ($registerCode === 400)
            return Response::json(['code' => $registerCode, 'mensaje' => 'Ya no quedan cupos en este periodo para el taller elejido, te recomendamos inscribirlo en la lista de espera para la apertura de un nuevo ciclo.']);
        else
            return Response::json(['code' => 500, 'mensaje' => 'Algo sucedio al intentar inscribir al alumno, comuniquese con sistemas porfavor.']);
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
