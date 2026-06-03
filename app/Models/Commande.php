<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'total',
        'date_commande',
    ];

    protected function casts(): array
    {
        return [
            'date_commande' => 'date:Y-m-d',
        ];
    }
}
