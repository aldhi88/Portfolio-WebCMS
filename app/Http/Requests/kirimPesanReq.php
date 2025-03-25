<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class kirimPesanReq extends FormRequest
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
            'email' => 'required',
            'phone' => 'required',
            'msg' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Input 'Nama' wajib diisi.",
            'email.required' => "Input 'Email' wajib diisi.",
            'phone.required' => "Input 'No Handphone' wajib diisi.",
            'msg.required' => "Input 'Isi Pesan' wajib diisi.",
        ];
    }
}