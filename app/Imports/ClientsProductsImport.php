<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsProductsImport implements ToModel, WithHeadingRow, WithSkipDuplicates, WithValidation
{

    public $exist_composite_column;

    public function __construct()
    {
        $this->exist_composite_column = ClientProduct::get()->map(function ($models){
            return "{$models->client_id}_{$models->product_id}";
        })->toArray();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return ClientProduct::updateOrCreate([
            'client_id' => Client::where('name', 'like', $row['cliente'])->pluck('id')->first(),
            'product_id' => Product::where('name', 'like', $row['producto'])->pluck('id')->first(),
        ],[
            'price' => $row['precio']
        ]);
    }

    public function rules():array{
        return [
            'cliente' => [
                'required', function($attribute, $value, $onFailure){
                    $response = Client::where('name', 'like', $value)->pluck('id')->first();
                    if(!$response){
                        $onFailure("El cliente '$value' no existe");
                    } else {
                        return $response;
                    }
            },
                Rule::notIn($this->exist_composite_column)
            ],
            'producto' => ['required', function($attribute, $value, $onFailure){
                $response = Product::where('name', 'like', $value)->pluck('id')->first();
                if(!$response){
                    $onFailure("El producto '$value' no existe");
                } else {
                    return $response;
                }
            }],
            'precio' => 'required'
        ];
    }

    public function prepareForValidation($data, $index){
        $composite_column = "{$data['cliente']}_{$data['producto']}";
        $data['composite_column'] = $composite_column;

        return $data;
    }

    public function uniqueBy(): string
    {
        return 'composite_column';
    }
}
