<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Http\Requests\ProgramaNuevoRequest;
use App\Services\ProgramaService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ProgramaController extends Controller
{

    public function __construct(
        private ProgramaService $programaService,
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $programas = $this->programaService->getProgramasAll();
        return view('pages.programas.index', ['programas'=>$programas]);
    }

    public function getProgramas(): JsonResponse{
        $programas = $this->programaService->getProgramasAll();
        return Response::json($programas);
    }

    public function getProgramasByTypeTaller(int $id): JsonResponse{
        $programas = $this->programaService->getProgramasByTipoTaller($id);
        return Response::json($programas);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        return view('pages.programas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramaNuevoRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $programa = $this->programaService->crearPrograma($data);
            return Response::json(['mensaje' => 'Programa creado correctamente', 'programa' => $programa], 201);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function show(Programa $programa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programa $programa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programa $programa)
    {
        //
    }
}
