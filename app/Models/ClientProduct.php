<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    use HasFactory;

    protected $table = 'clients_products';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'update_at'];

    public static function fileteredNames(array $headers){
        $filteredColumns = array_filter($headers, function($column) {
           return !in_array($column, ['created_at', 'updated_at']);
        });
        return $filteredColumns;
    }
}
