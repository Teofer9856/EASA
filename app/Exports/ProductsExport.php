<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function headings():array{
        return [
            'Nombre', 'Referencia', 'Stock'
        ];
    }

    public function map($products): array{
        return [
            $products->name,
            $products->reference,
            $products->stock,
        ];
    }
}
