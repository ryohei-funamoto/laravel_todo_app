<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'completed'])]
class Todo extends Model
{
    protected function casts(): array
    {
        return [
            'completed' => 'boolean',
        ];
    }
}
