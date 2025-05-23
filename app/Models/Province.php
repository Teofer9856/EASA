<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;

class Province extends Model
{

    use HasFactory;

    protected $table = 'provinces';

    /**
     * Esconde campos de la tabla
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['name'];

    public static function apiToArray()
    {
        $response = Http::get('https://servicios.ine.es/wstempus/js/ES/VALORES_VARIABLEOPERACION/115/22');

        if (!$response->ok()) {
            return [];
        }

        $data = $response->json();
        $provincesList = [];

        foreach ($data as $item) {
            $province = $item['Nombre'];

            if (str_contains($province, ', ')) {
                $province = implode(' ', array_reverse(explode(', ', $province)));
            }

            if (str_contains($province, '/')) {
                $province = explode('/', $province)[1];
            }

            array_push($provincesList, $province);
        }

        return $provincesList;
    }

    public function client(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
