<?php

namespace App\Http\Controllers;


use App\Events\CreatedExpenseEvent;
use App\Http\Requests\Despesa\UpdateRequest;
use App\Http\Requests\DespesaRequest;
use App\Models\Despesa;
use App\Services\DespesaService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/** @TODO: não misture idiomas decida entre português e inglês, sabendo que inglês é a lingua universal dos dias de hoje */
class DespesaController extends Controller
{
    public function index()
    {
        return response()->json(Despesa::all());
    }

    public function store(DespesaRequest $request): JsonResponse
    {
        $expense = Despesa::create($request->validated());
        event(new CreatedExpenseEvent($expense));

        return response()->json($expense, Response::HTTP_OK);
    }

    public function show(Despesa $despesa): JsonResponse
    {
        $this->authorize('view', $despesa);
        return response()->json($despesa);
    }

    public function update(UpdateRequest $request, Despesa $despesa): JsonResponse
    {
        $despesa->update($request->validated());

        return response()->json(['message' =>  __('expense.updated')]);
    }

    public function destroy(Despesa $despesa): JsonResponse
    {
        $despesa->delete();
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}
