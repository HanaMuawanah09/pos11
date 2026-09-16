<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('produk', 'nama')->ignore($this->route('produk')->id),
            ],
            'jenis_id'       => 'required|exists:jenis,id',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Maksimal panjang nama 100 karakter.',
            'name.unique' => 'Nama produk sudah digunakan.',
            'jenis_id.required' => 'Jenis produk wajib dipilih.',
            'jenis_id.exists' => 'Jenis produk yang dipilih tidak valid.',
            'purchase_price.required' => 'Harga beli wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
        ];
    }
}