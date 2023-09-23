<?php

namespace App\Services;

use App\Models\Despesa;

class DespesaService
{
    public function getById($id)
    {
        return Despesa::find($id);
    }

    public function createDespesa(array $data)
    {
        return Despesa::create($data);
    }

    public function updateDespesa(Despesa $despesa, array $data)
    {
        $despesa->update($data);

        return $despesa;
    }

    public function deleteDespesa(Despesa $despesa)
    {
        $despesa->delete();

        return 'Despesa excluída com sucesso.';
    }
}

