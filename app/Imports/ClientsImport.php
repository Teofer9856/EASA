<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Province;
use App\Models\Seller;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'name' => $row['nombre'],
            'email' => $row['email'],
            'zip_code' => $row['zip'],
            'province_id' => Province::where('name', 'like', $row['provincia'])->pluck('id')->first(),
            'seller_id' => Seller::where('name', 'like', $row['vendedor'])->pluck('id')->first()
        ]);
    }

}
