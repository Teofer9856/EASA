<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory, Sortable;

    protected $table = 'clients';

    protected $fillable = ['name', 'email', 'zip_code', 'province_id', 'seller_id'];

    public $sortable = ['name', 'email', 'zip_code', 'province_id', 'seller_id'];

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

    public function provinceSortable($query, $province)
    {
        return $query->join('provinces', 'clients.province_id', '=', 'provinces.id')
            ->orderBy('provinces.name', $province)
            ->select('clients.*');
    }

    public function sellerSortable($query, $province)
    {
        return $query->join('sellers', 'clients.seller_id', '=', 'sellers.id')
            ->orderBy('sellers.name', $province)
            ->select('clients.*');
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
