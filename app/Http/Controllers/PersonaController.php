<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonaNuevoRequest;
use App\Services\GeneroService;
use App\Services\PersonaService;
use App\Services\TipoPersonaService;
use App\Services\TipoSeguroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonaController extends Controller
{
    public function __construct(
        private TipoPersonaService $tipoPersonaService,
        private GeneroService $generoService,
        private TipoSeguroService $tipoSeguroService,
        private PersonaService $personaService,
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $tipospersonas = $this->tipoPersonaService->getTiposPersonasServicios();
        return view("pages.personas.index", compact("tipospersonas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $tipospersonas = $this->tipoPersonaService->getTiposPersonasServicios();
        $generos = $this->generoService->getGeneros();
        $seguros = $this->tipoSeguroService->getTipoSerguro();

        return view("pages.personas.create", compact("tipospersonas", "generos", "seguros"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaNuevoRequest $request):JsonResponse
    {
        $tipopersona = $request->input('tipopersonaid');

        if ($tipopersona == 1 || $tipopersona == 2)
            $registerCode = $this->personaService->registerDatosGenerales($request->usuario);

        if ($tipopersona == 3 || $tipopersona == 4)
            $registerCode = $this->personaService->registerDatosGenerales($request->padre);

        if ($registerCode === 200)
            return Response::json(['code' => $registerCode, 'mensaje' => 'Se registro la nueva persona correctamente.']);
        elseif($registerCode === 500)
            return Response::json(['code' => $registerCode, 'mensaje' => 'Error en el servicio "App\Services\PersonaService", comuniquese con GTI.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
