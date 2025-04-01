<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::all();
    }

    public function headings():array{
        return [
            'Nª', 'Nombre', 'Email',
            'Cogido Zip', 'Provincia', 'Vendedor'
        ];
    }

    public function map($clients): array{
        return [
            $clients->id,
            $clients->name,
            $clients->email,
            $clients->zip_code,
            $clients->province->name,
            $clients->seller->name
        ];
    }
}
