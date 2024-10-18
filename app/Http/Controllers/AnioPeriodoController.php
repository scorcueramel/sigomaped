<?php

namespace App\Http\Controllers;


use App\Models\AnioPeriodo;
use Illuminate\Http\Request;
use App\Http\Requests\AnioPeriodoNuevoRequest;
use App\Services\AnioPeriodoService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class AnioPeriodoController extends Controller
{
    public function __construct(
        private AnioPeriodoService $anioPeriodoService,
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $anioPeriodo = $this->anioPeriodoService->getAnioPeriodosAll();
        return view('pages.anio-periodo.index', ['anioPeriodo'=>$anioPeriodo]);
    }

    public function getAnioPeriodo(): JsonResponse{
        $anioPeriodo = $this->anioPeriodoService->getAnioPeriodosAll();
        return Response::json($anioPeriodo);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        return view('pages.anio-periodo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnioPeriodoNuevoRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $anioPeriodo = $this->anioPeriodoService->crearAnioPeriodo($data);
            return Response::json(['mensaje' => 'Periodo creado correctamente', 'anioPeriodo' => $anioPeriodo], 201);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnioPeriodo  $anioperiodo
     * @return \Illuminate\Http\Response
     */
    public function show(AnioPeriodo $anioPeriodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnioPeriodo  $anioPeriodo
     * @return \Illuminate\Http\Response
     */
    public function edit(anioPeriodo $anioPeriodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnioPeriodo  $anioPeriodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, anioPeriodo $anioPeriodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnioPeriodo  $anioPeriodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnioPeriodo $anioPeriodo)
    {
        //
    }
}
