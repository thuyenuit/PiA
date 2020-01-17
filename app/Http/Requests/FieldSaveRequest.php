<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class FieldSaveRequest extends FormRequest
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
        $id = Request::instance()->id;
        return [
            'name' => 'required|max:191|unique:fields,name,' . $id . ',id',
            'locale_key' => 'required|max:191|unique:fields,locale_key,' . $id . ',id',
            'field_group' => 'required|integer',
            'field_type' => 'required|integer',
            'sequence' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A title is required',
            'locale_key.required'  => 'A message is required',
        ];
    }
}
