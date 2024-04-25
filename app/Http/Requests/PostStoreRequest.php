<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    $rules = [
        'title' => ["required", "min:3", Rule::unique('posts', 'title')],
        "body" => ["required", "min:10"],
        'image' => ['image', 'mimes:jpg,png'],
        ];

    if ($this->isMethod('PUT')) {
        $rules['title'][] = Rule::unique('posts')->ignore($this->route('post'));
    }

    return $rules;
}
     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(){
        return[
            "title.required"=>'you should enter value in title section',
            "body.required"=>'you should enter value in body section'
        ];
    }
}
