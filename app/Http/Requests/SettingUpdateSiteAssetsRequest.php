<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateSiteAssetsRequest extends FormRequest
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
            'site_logo' => 'nullable|image|max:500',
            'site_favicon' => 'nullable|image|max:500',
            'login_image' => 'nullable|image|max:500',
            'default_avatar_image' => 'nullable|image|max:500',
        ];
    }
}
