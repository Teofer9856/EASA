<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    /**
     * Esconde campos de la tabla
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function province():BelongsTo{
        return $this->belongsTo(Province::class);
    }

    public function seller():BelongsTo{
        return $this->belongsTo(Seller::class);
    }

    public static function namesChange($clients_list){
        foreach($clients_list as $object){
            $name_province = $object->province['name'];
            $name_seller = $object->seller['name'];

            $object->province_id = $name_province;
            $object->seller_id = $name_seller;
        }
        return $clients_list;
    }
}
