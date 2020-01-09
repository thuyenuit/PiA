<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class GroupUserStoreRequest extends FormRequest
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
        // TODO: check unique user_id & group_id
//        $group_id = Request::instance()->group_id;
//        $user_id = Request::instance()->user_id;
//        $club_id = Request::instance()->club_id;
        return [
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'club_id' => 'nullable|exists:clubs,id',
        ];
    }
}
