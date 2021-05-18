<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:4', 'max:50'],
            'body' => ['required', 'string', 'min:1', 'max:200'],
            'tags' => ['array'],
            'files.*.photo' => ['file', 'image', 'mimes:jpeg,png,jpg,gif,svg,bmp'],
        ];
    }
}
