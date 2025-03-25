<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class SlideshowStoreReq extends FormRequest
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
            'slug' => 'required|unique:pages,slug,NULL',
            'summary' => 'required',
            'image' => 'max:'.$fileSize.'|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Input 'Judul Slide' wajib diisi.",
            'slug.required' => "Input 'Permalink' wajib diisi.",
            'slug.unique' => "'Permalink' sudah ada.",
            'summary.required' => "Input 'Ringkasan/Deskripsi' wajib diisi.",
            'image.max' => "'Ukuran Gambar' melebihi batas.",
            'image.mimes' => "'Jenis Gambar' tidak sesuai.",
        ];
    }
}