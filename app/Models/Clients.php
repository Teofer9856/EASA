<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clients extends Model
{
    use HasFactory;

    protected $table = 'clients';

    /**
     * Esconde campos de la tabla
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function province():BelongsTo{
        return $this->belongsTo(Provinces::class);
    }

    public function seller():BelongsTo{
        return $this->belongsTo(Sellers::class);
    }
}
