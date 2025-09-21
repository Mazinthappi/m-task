<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'The course title is required.',
            'title.string'   => 'The course title must be a text value.',
            'title.max'      => 'The course title may not be greater than 255 characters.',

            'description.string' => 'The description must be text.',

            'price.required' => 'Please provide a price for the course.',
            'price.numeric'  => 'The price must be a number.',
            'price.min'      => 'The price must be at least 0.',
        ];
    }
}
