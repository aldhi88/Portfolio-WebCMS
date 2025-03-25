<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryStoreReq extends FormRequest
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
            'name' => 'required|unique:post_categories,name,NULL',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Input 'Nama Kategori' wajib diisi.",
            'name.unique' => "'Nama Kategori' sudah ada.",
        ];
    }
}