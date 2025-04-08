<?php

namespace App\Exports;

use App\Models\ClientProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClientsProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            str_replace(".", "", explode(" €", $client_product->price)[0])
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]]
        ];
    }
}
