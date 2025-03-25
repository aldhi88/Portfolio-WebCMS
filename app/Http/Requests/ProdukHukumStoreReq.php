<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukHukumStoreReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:produk_hukum,name,NULL',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Input 'Nama Produk Hukum' wajib diisi.",
            'name.unique' => "'Nama Produk Hukum' sudah ada.",
        ];
    }
}