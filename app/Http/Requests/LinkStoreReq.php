<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkStoreReq extends FormRequest
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
            'name' => 'required',
            'parent' => 'required',
            'link' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Input 'Label Link' wajib diisi.",
            'parent.required' => "Lokasi parent link navigasi wajib dipilih.",
            'link.required' => "Alamat link URL wajib diisi.",
        ];
    }
}