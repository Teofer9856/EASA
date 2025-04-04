<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        $id = $this->client->id;

        return [
            'name' => 'required|min: 5|max: 50',
            'email' => "required|unique:clients,email,{$id}",
            'zip_code' => 'required|min:5|max:5',
            'province_id' => 'required|exists:provinces,id',
            'seller_id' => 'required|exists:sellers,id'
        ];
    }
}
