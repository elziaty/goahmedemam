<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'   => 'required|max:60|unique:roles,name,'.Request::input('id')
        ];
    }

    // public function attributes()
    // {
    //     return [
    //             'name.required'       => __('validation.required',['attribute',__('levels.name')]),
    //             'name.unique'         => __('validation.unique',  ['attribute',__('levels.name')])
    //           ];
    // }
}
