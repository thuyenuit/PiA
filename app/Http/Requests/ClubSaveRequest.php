<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClubSaveRequest extends FormRequest
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
            'name' => 'required|max:191',
            'region' => 'required|max:191',
            'address' => 'required|max:191',
            'zip_code' => 'nullable|max:191',
            'town' => 'nullable|max:191',
            'email' => 'required|max:191|email',
            'internet' => 'nullable|max:191|url',
            'monthly_payment' => 'nullable|numeric',
        ];
    }
}
