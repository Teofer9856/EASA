<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Provinces extends Model
{
    public function apiToArray(){
        $response = json_decode(Http::get('https://servicios.ine.es/wstempus/js/ES/VALORES_VARIABLE/70'));

        $lista = [];

        foreach($response as $element){
            if(intval($element->Codigo) > 0 && $element->Codigo != ""){
                $lista[] = str_replace(" - ", " ",implode(" ", array_reverse(explode(", ", $element->Nombre))));
            }
        }

        return $lista;
    }
}
