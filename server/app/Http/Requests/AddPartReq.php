<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPartReq extends FormRequest
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
            'model'=>'required',
            'make'=>'required',
            'year'=>'required',
            'partnumber'=>'required',
            'name'=>'required',
        ];
    }
}
