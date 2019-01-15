<?php

namespace App\Http\Requests;

class VoucherRequest extends Request
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
            'name' => 'required|min:3',
            'title' => 'required|min:3',
            'detail' => 'required|min:10',
//            'img' => 'required|min:2',
            'number_code' => 'required|min:1',
            'timerange' => 'required|min:22',
        ];

    }

    public function messages()
    {
        return [

        ];
    }
}
