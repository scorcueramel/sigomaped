<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\Request;
use App\Http\Requests\TallerNuevoRequest;
use App\Services\ProgramaService;
use App\Services\TallerService;
use Illuminate\Http\JsonResponse;
use App\Services\TipoTallerService;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class TallerController extends Controller
{    
    public function __construct(
        private TallerService $tallerService,
        private ProgramaService $programaService,
        private TipoTallerService $tipoTallerService,
    ){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $talleres = $this->tallerService->getTalleresAll();
        return view('pages.talleres.index', ['talleres'=>$talleres]);
    }

    public function getTalleres(): JsonResponse{
        $talleres = $this->tallerService->getTalleresAll();
        return Response::json($talleres);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $tipostalleres = $this->tipoTallerService->getTiposTalleres();
        $programas = $this->programaService->getProgramasAll();

        return view("pages.talleres.create", compact("tipostalleres","programas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TallerNuevoRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $taller = $this->tallerService->crearTaller($data);
            return Response::json(['mensaje' => 'Taller creado correctamente', 'taller' => $taller], 201);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taller  $taller
     * @return \Illuminate\Http\Response
     */
    public function show(Taller $taller)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taller  $taller
     * @return \Illuminate\Http\Response
     */
    public function edit(Taller $taller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taller  $taller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taller $taller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taller  $taller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taller $taller)
    {
        //
    }
}
