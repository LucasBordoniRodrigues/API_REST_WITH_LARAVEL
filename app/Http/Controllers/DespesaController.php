<?php

namespace App\Http\Controllers;


use App\Http\Requests\DespesaRequest;
use App\Models\Despesa;
use App\Services\DespesaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DespesaController extends Controller
{
    private $despesaService;

    public function __construct(DespesaService $despesaService)
    {
        $this->despesaService = $despesaService;
    }

    public function index()
    {
        $despesas = Despesa::all();
        return response()->json($despesas, 200);
    }

    public function store(DespesaRequest $request): JsonResponse
    {
        $despesa = $this->despesaService->createDespesa($request->all());

        return response()->json($despesa, 201);
    }

    public function show($id): JsonResponse
    {
        $despesa = $this->despesaService->getById($id);

        if (!$despesa) {
            return response()->json(['error' => 'Despesa não encontrada'], 404);
        }

        return response()->json($despesa, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = $this->validateUpdateRequest($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $despesa = $this->despesaService->getById($id);

        if (!$despesa) {
            return response()->json(['error' => 'Despesa não encontrada'], 404);
        }

        $despesa = $this->despesaService->updateDespesa($despesa, $request->all());

        return response()->json($despesa, 200);
    }

    private function validateUpdateRequest(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'descricao' => 'required|string|max:191',
            'data' => 'required|date',
            'valor' => 'required|numeric|min:0',
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $despesa = $this->despesaService->getById($id);

        if (!$despesa) {
            return response()->json(['error' => 'Despesa não encontrada'], 404);
        }

        $this->despesaService->deleteDespesa($despesa);

        return response()->json(['message' => 'Despesa excluída com sucesso.'], 200);
    }
}
