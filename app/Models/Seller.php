<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class Seller extends Model
{
    use HasFactory, Sortable;

    protected $table = 'sellers';

    protected $fillable = ['name'];

    public $sortable = ['name'];

    /**
     * Esconde campos de la tabla
     */
    protected $hidden = ['created_at', 'updated_at'];

    public static function fileteredNames(array $headers){
        $filteredColumns = array_filter($headers, function($column) {
           return !in_array($column, ['created_at', 'updated_at']);
        });
        return $filteredColumns;
    }

    public function client():HasMany{
        return $this->hasMany(Client::class);
    }
}
