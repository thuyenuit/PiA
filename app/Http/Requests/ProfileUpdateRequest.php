<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // checked by Admin middleware
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
            'name' => 'required|max:100',
            'phone' => 'max:20',
            'mobile_phone' => 'max:20',
            'address' => 'max:191',
            'zip_code' => 'max:191',
            'town' => 'max:191',
            'pilot_id' => 'max:191',
            'fai_no' => 'max:191',
            'fai_year' => 'max:191',
            'd_no' => 'max:191',
        ];
    }
}
