<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class DpoStoreReq extends FormRequest
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
        $fileSize = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return [
            'title' => 'required',
            'summary' => 'required',
            'image' => 'max:'.$fileSize.'|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Input 'Judul Halaman' wajib diisi.",
            'summary.required' => "Input 'Ringkasan/Deskripsi' wajib diisi.",
            'image.max' => "'Ukuran Gambar' melebihi batas.",
            'image.mimes' => "'Jenis Gambar' tidak sesuai.",
        ];
    }
}