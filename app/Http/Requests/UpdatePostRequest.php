<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        $id = $this->post_id;
        return [
            'title'         => ['required' ,'min:3', 'exists:posts,title','unique:posts,title,'.$id],
            'description'   => ['required' ,'min:5'],
            'image'         => ['image']
        ];
    }
}
