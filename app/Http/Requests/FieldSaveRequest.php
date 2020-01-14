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
            'label_locale' => 'required|max:191|unique:fields,label_locale,' . $id . ',id',
            'field_group' => 'required|integer',
            'field_type' => 'required|integer',
            'sequence' => 'required|integer|min:0',
        ];
    }
}
