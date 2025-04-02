<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, WithSkipDuplicates
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Product::create([
            'name' => $row['nombre'],
            'reference' => $row['referencia'],
            'stock' => $row['stock']
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|min: 5|max: 50',
            'referencia' => 'required|min: 5|max: 5',
            'stock' => 'required|integer|min:1|max:999',
        ];
    }
}
