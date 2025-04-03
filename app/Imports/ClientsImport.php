<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Province;
use App\Models\Seller;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsImport implements ToModel, WithHeadingRow, WithSkipDuplicates, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Client::updateOrCreate([
            'email' => $row['email'],
        ],[
            'name' => $row['nombre'],
            'zip_code' => $row['zip'],
            'province_id' => Province::where('name', 'like', $row['provincia'])->pluck('id')->first(),
            'seller_id' => Seller::where('name', 'like', $row['vendedor'])->pluck('id')->first()
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|min: 5|max: 50',
            'zip' => 'required|min:5|max:5',
            'provincia' => 'required',
            'vendedor' => 'required'
        ];
    }

}
