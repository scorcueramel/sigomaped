<?php

namespace App\Http\Controllers;

use App\Models\EsperaPersonaTaller;
use App\Services\EsperaPersonaService;
use App\Services\InscripcionEsperaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class EsperaPersonaTallerController extends Controller
{
    public function __construct(
        private InscripcionEsperaService $inscripcionEsperaService,
        private EsperaPersonaService $esperaPersonaService,
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $preLista = [];
        $listaActual = [];

        $listaService = $this->inscripcionEsperaService->getListaEspera();

        foreach ($listaService as $ls) {
            array_push($preLista, ['taller_id' => $ls->tallerid, 'taller_nombre' => $ls->tallernombre]);
        }

        $listaActual = array_unique($preLista, SORT_ASC);
        $listaFinal = Arr::sort($listaActual);

        return view("pages.lista-espera.index", compact("listaFinal"));
    }

    public function getPersonasByTypeTaller($id): JsonResponse
    {
        $preLista = [];
        $listaActual = [];

        $listaPersonasEspera = $this->esperaPersonaService->getListaEsperaPersonasByTallerId($id);

        foreach ($listaPersonasEspera as $ls) {
            array_push($preLista, [
                'persona_id' => $ls->personaid,
                'taller_id' => $ls->tallerid,
                'documento' => $ls->documento,
                'nombres' => $ls->nombres,
                'apellidos' => $ls->apellidos,
            ]);
        }

        $listaActual = array_unique($preLista, SORT_ASC);
        $listaFinal = Arr::sort($listaActual);

        return Response::json($listaFinal);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $personaid, int $tallerid): View
    {
        $data = $this->esperaPersonaService->getListaEsperaDetalle($personaid, $tallerid)[0];

        return view('pages.lista-espera.create', compact('data'));
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
     * @param  \App\Models\EsperaPersonaTaller  $esperaPersonaTaller
     * @return \Illuminate\Http\Response
     */
    public function show(EsperaPersonaTaller $esperaPersonaTaller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EsperaPersonaTaller  $esperaPersonaTaller
     * @return \Illuminate\Http\Response
     */
    public function edit(EsperaPersonaTaller $esperaPersonaTaller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EsperaPersonaTaller  $esperaPersonaTaller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EsperaPersonaTaller $esperaPersonaTaller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EsperaPersonaTaller  $esperaPersonaTaller
     * @return \Illuminate\Http\Response
     */
    public function destroy(EsperaPersonaTaller $esperaPersonaTaller)
    {
        //
    }
}
