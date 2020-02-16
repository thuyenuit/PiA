<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Request;

    class ServiceSaveRequest extends FormRequest
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
                'name' => 'required|max:191|unique:services,name,' . $id . ',id',
                'locale_key' => 'required|max:191|unique:services,locale_key,' . $id . ',id',
            ];
        }
    }
