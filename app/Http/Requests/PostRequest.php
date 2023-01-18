<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'postImg' => 'required|mimes:jpg,png'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Tile is required!!',
            'postImg.required' => 'Post image is required!!',
            'postImg.mimes' => 'Post image must be jpg or png type!!' 
        ];
    }
}
