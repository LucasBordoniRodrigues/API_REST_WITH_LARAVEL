<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespesaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descricao' => 'required|string|max:191',
            'data' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'usuario_id' => 'nullable|integer|exists:users,id',
        ];
    }
}
