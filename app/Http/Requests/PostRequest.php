<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|min:'.env('MIN_TITLE_LENGTH').'|max:'.env('MAX_TITLE_LENGTH'),
            'description' => 'required|min:'.env('MIN_TEXT_LENGTH').'|max:'.env('MAX_TEXT_LENGTH'),
            'content' => 'required|min:'.env('MIN_TEXT_LENGTH').'|max:'.env('MAX_TEXT_LENGTH'),
            'category_id' => 'required:integer',
            'thumbnail' => 'nullable|image',
            'status' => 'required:integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'category_id' => 'Category',
            'tags' => 'Tags',
            'thumbnail' => 'Image',
            'status' => 'Status',
        ];
    }
}
