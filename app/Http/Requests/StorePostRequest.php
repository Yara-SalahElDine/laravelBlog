<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class StorePostRequest extends Request
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
            'title' => 'required|min:3|unique:posts',
            'description' => 'required|min:10',
            'photo' => 'mimes:jpeg,png'
        ];
    }
    //how to override message
}
