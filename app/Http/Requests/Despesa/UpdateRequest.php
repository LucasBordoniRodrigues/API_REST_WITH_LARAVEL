<?php

namespace App\Http\Requests\Despesa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'descricao' => ['required', 'string', 'max:191'],
            'data' => ['required', 'date'],
            'valor' => ['required', 'numeric', 'min:0'],
        ];
    }
}
