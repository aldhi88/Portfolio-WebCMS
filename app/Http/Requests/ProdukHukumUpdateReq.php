<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukHukumUpdateReq extends FormRequest
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
            'name' => 'required|unique:produk_hukum,name,'.$this->id.',id',
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