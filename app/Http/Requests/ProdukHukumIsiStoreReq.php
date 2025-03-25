<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class ProdukHukumIsiStoreReq extends FormRequest
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
            'file' => 'required|max:'.$fileSize.'|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => "Format 'File' harus jenis PDF.",
        ];
    }
}