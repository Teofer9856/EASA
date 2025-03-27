<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'reference', 'stock'];

    protected function reference(): Attribute{
        return Attribute::make(
            set: function($txt){
                return strtoupper($txt);
            },
            get: function($txt){
                return strtoupper($txt);
            }
        );
    }

    public static function fileteredNames(array $headers){
        $filteredColumns = array_filter($headers, function($column) {
           return !in_array($column, ['created_at', 'updated_at']);
        });
        return $filteredColumns;
    }
}
