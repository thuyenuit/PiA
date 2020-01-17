<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Field;

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
        /**
         * invalid basic field
         */
        $rules = [
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

        /**
         * invalid custom field
         */
        $fields = Field::select('locale_key', 'field_type', 'setting')
                        ->whereIn('locale_key', array_keys($this->all()))
                        ->where('mandatory', true)
                        ->get();
                        
        foreach($fields as $field)
        {         
            if($field['field_type'] == (config('constants.FIELD_TYPE')['string']))
            {
                $rules[$field['locale_key']] = 'required|max:'.  json_decode($field['setting'])->max_length;
            }
            else
            {
                $rules[$field['locale_key']] = 'required';
            } 
        }
        return $rules;
        //$fieldTemp = $fields_all->map->only(['locale_key', 'setting']); OK
        //dd($fieldTemp->where('locale_key','home_town')->first()['locale_key']); OK  
    }
}
