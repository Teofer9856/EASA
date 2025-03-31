<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

class ClientProduct extends Model
{
    use HasFactory, Sortable;

    protected $table = 'clients_products';

    protected $fillable = ['client_id', 'product_id', 'price'];

    protected $hidden = ['created_at', 'updated_at'];

    public $sortable = ['client_id', 'product_id', 'price'];

    public function client():HasOne {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function product():HasOne {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function clientSortable($query, $client)
    {
        return $query->join('clients', 'clients_products.client_id', '=', 'clients.id')
            ->orderBy('clients.name', $client)
            ->select('clients_products.*');
    }

    public function productSortable($query, $client)
    {
        return $query->join('products', 'clients_products.product_id', '=', 'products.id')
            ->orderBy('products.name', $client)
            ->select('clients_products.*');
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
