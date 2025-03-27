<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClientProduct extends Model
{
    use HasFactory;

    protected $table = 'clients_products';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'update_at'];

    public function client():HasOne {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function product():HasOne {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function fileteredNames(array $headers){
        $filteredColumns = array_filter($headers, function($column) {
           return !in_array($column, ['created_at', 'updated_at']);
        });
        return $filteredColumns;
    }

    public static function namesChange($clients_list){
        foreach($clients_list as $object){
                $name_client_id = $object->client['name'];
                $name_product_id = $object->product['name'];

                $object->client_id = $name_client_id;
                $object->product_id = $name_product_id;
        }
        return $clients_list;
    }
}
