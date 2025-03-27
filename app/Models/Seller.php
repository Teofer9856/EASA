<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';

    protected $fillable = ['name'];

    /**
     * Esconde campos de la tabla
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function client():HasMany{
        return $this->hasMany(Client::class);
    }
}
