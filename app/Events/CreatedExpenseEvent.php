<?php

namespace App\Events;

use App\Models\Despesa;
use Illuminate\Foundation\Events\Dispatchable;

class CreatedExpenseEvent
{
    use Dispatchable;

    public function __construct(public Despesa $expense)
    {
    }
}
