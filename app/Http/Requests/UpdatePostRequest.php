<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Post;
use App\User;

class UpdatePostRequest extends Request
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
        $id = $this->route('post');
        //dd($id);
        return [
            'title' => 'required|min:3|unique:posts,id,'.$id ,
            'description' => 'required|min:10',  
            'user_id' => 'exists:users,id',
            'photo' => 'mimes:jpeg,png'
            
        ];
    }
}
