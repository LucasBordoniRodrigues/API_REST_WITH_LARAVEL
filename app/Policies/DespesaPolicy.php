<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DespesaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->usuario_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Despesa $despesa): bool
    {
        return $user->id === $despesa->usuario_id;
    }

    public function delete(User $user, Despesa $despesa): bool
    {
        return $user->id === $despesa->usuario_id;
    }

    public function restore(): bool
    {
        return false;
    }

    public function forceDelete(User $user, Despesa $despesa): bool
    {
        return false;
    }
}
