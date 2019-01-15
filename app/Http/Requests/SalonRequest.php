<?php

namespace App\Http\Requests;

class SalonRequest extends Request
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
            'name' => 'required',
            'phone' => 'required',
            'admin_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
        ];
    }
}
