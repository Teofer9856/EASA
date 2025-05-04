<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required',
            'product_id' => 'required',
            'price' => 'required|decimal:0,2|min:20|max:99999',
            'client_id' => ['required', \Illuminate\Validation\Rule::unique('clients_products')->where(function ($query) {
                return $query->where('product_id', $this->product_id);
            })]
        ];

    }

    /* public function rules(): array
    {
        return [
            'client_id' => 'required',
            'product_id' => 'required',
            'price' => 'required',
            'client_id' => [
                'required',
                \Illuminate\Validation\Rule::unique('tu_tabla')->where(function ($query) {
                    return $query->where('product_id', $this->product_id);
                })
            ],
        ];
    } */

/*     public function rules(): array
    {
        $id = $this->route('id'); // Asumiendo que el ID del registro se pasa en la ruta

        return [
            'client_id' => [
                'required',
                \Illuminate\Validation\Rule::unique('tu_tabla')->where(function ($query) {
                    return $query->where('product_id', $this->product_id);
                })->ignore($id), // Ignora el registro actual
            ],
            'product_id' => 'required',
            'price' => 'required',
        ];
    } */
}
