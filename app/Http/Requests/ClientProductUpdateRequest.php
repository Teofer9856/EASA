<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ClientProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'price' => str_replace(['.', ','], ['', '.'], $this->price),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => [
            'required',
            function ($attribute, $value, $fail) {
                $exists = DB::table('clients_products')
                    ->where('client_id', $value)
                    ->where('product_id', $this->input('product_id'))
                    ->where('id', '!=', $this->route('clients_product')) // Replace 'id' with your route parameter name
                    ->exists();

                if ($exists) {
                    $fail('The combination of client and product already exists.');
                }
            },
            ],
            'product_id' => 'required',
            'price' => 'required|decimal:0,2|min:20|max:99999',
        ];

    }
}
