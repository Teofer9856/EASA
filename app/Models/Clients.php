<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    /**
     * Esconde campos de la tabla
     */
    protected $hidden = ['created_at', 'updated_at'];
}
