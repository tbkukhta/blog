<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|min:'.env('MIN_TEXT_LENGTH').'|max:'.env('MAX_TEXT_LENGTH'),
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'content' => 'Content',
            'post_id' => 'Post',
            'user_id' => 'Author',
            'status' => 'Status',
        ];
    }
}
