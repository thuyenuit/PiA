<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class FieldGroupSaveRequest extends FormRequest
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
            'label_locale' => 'required|max:191|unique:field_groups,label_locale,' . $id . ',id',
            'sequence' => 'required|integer|min:0',
        ];
    }
}
