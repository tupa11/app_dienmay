<?php

namespace App\Http\Requests;

class SettingRequest extends Request
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
            'site_logo_file' => 'image|max:2000',
            'site_name' => 'required',
            'hotline' => 'required',
            'address' => 'required',
        ];
    }

    public function convertNumber($number)
    {
        $number = (float)str_replace(",", "", $number);
        return $number > 0 ? $number : 0;
    }
}
