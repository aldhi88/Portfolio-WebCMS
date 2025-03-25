<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KirimWbsReq extends FormRequest
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
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'ktp' => 'required|max:512|mimes:jpg,jpeg,png',
            'aduan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => "Input 'Nama' wajib diisi.",
            'alamat.required' => "Input 'Alamat' wajib diisi.",
            'email.required' => "Input 'Email' wajib diisi.",
            'hp.required' => "Input 'Telepon' wajib diisi.",
            'ktp.required' => "Upload 'KTP' wajib diisi.",
            'ktp.max' => "Upload 'KTP' maksimal 512KB.",
            'ktp.mimes' => "Upload 'KTP' harus format JPG/PNG.",
            'aduan.required' => "Input 'Aduan' wajib diisi.",
        ];
    }
}