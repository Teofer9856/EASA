<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SellersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Seller::all();
    }

    public function headings():array{
        return [
            'Nombre'
        ];
    }

    public function map($products): array{
        return [
            $products->name
        ];
    }
}
