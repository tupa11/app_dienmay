<?php

namespace App\Http\Requests;

class AdminRequest extends Request
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
        switch ($this->method()) {
            case "POST":
                return [
                    'name' => 'required|min:3|max:50|regex:/^[\pL\s\-]+$/u',
                    'group' => 'required|min:4|max:8|alpha',
                    'area_id' => 'required',
                    'password' => 'required|string|min:3|confirm',
                    'password_confirmation' => 'required_with:password|same:password',
                    'phone' => 'required|regex:/^\d{7,15}?$/',
                ];
                break;
            case "PUT":
                return [
                    'name' => 'required|min:3|max:50|regex:/^[\pL\s\-]+$/u',
                    'group' => 'required|min:4|max:8|alpha',
                    'area_id' => 'required',
//                    'password' => 'min:3|confirm',
//                    'password_confirmation' => 'required_with:password|same:password',
                    'phone' => 'required|regex:/^\d{7,15}?$/',
                ];
                break;
        }

    }

    public function messages()
    {
        return [
            'phone.regex' => 'Phone number can be only numbers',
        ];
    }
}
