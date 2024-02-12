<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertRequest extends FormRequest
{
    public static function getRules()
    {
        return [
            'title' => 'nullable|required_without_all:description,link,image|min:'.env('MIN_TITLE_LENGTH').'|max:'.env('MAX_TITLE_LENGTH'),
            'description' => 'nullable|required_without_all:title,link,image|min:'.env('MIN_STRING_LENGTH').'|max:'.env('MAX_STRING_LENGTH'),
            'link' => 'nullable|url|required_without_all:title,description,image|max:'.env('MAX_STRING_LENGTH'),
            'block' => 'required|integer',
            'status' => 'required|integer',
            'image' => 'nullable|image|required_without_all:title,description,link',
        ];
    }

    public static function getAttributes()
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'block' => 'Block',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }
    public static function getMessages()
    {
        $message = 'At least one of the fields Title/Description/Link/Image must be filled.';
        return [
            'title.required_without_all' => $message,
            'description.required_without_all' => $message,
            'link.required_without_all' => $message,
            'image.required_without_all' => $message,
        ];
    }

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
        return self::getRules();
    }

    public function messages(): array
    {
        return self::getMessages();
    }

    public function attributes(): array
    {
        return self::getAttributes();
    }
}
