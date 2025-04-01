<?php

namespace App\Exports;

use App\Models\ClientProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientsProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ClientProduct::all();
    }

    public function headings():array{
        return [
            'Cliente', 'Producto', 'Precio'
        ];
    }

    public function map($client_product): array{
        return [
            $client_product->client->name,
            $client_product->product->name,
            $client_product->price
        ];
    }
}
