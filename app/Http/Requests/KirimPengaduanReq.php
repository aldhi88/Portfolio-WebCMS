<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KirimPengaduanReq extends FormRequest
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
            'terlapor' => 'required',
            'bukti' => 'required|max:512|mimes:pdf',
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
            'terlapor.required' => "Input 'Terlapor' wajib diisi.",
            'bukti.required' => "Upload 'Bukti' wajib diisi.",
            'bukti.max' => "Upload 'Bukti' maksimal 512KB.",
            'bukti.mimes' => "Upload 'Bukti' harus format PDF.",
            'aduan.required' => "Input 'Aduan' wajib diisi.",
        ];
    }
}