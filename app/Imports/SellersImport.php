<?php

namespace App\Imports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithValidation;

class SellersImport implements ToModel, WithSkipDuplicates, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Seller([
            'name' => $row['nombre']
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|unique:sellers,name|string|min:1|max:50'
        ];
    }
}
