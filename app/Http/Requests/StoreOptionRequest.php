<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'question_id' => 'required|exists:questions,id',
        'option_text' => 'required|string|max:500',
        'is_correct' => 'required|boolean',
    ];
}
public function messages(): array
{
    return [
        'question_id.required' => 'Question is required.',
        'question_id.exists' => 'Question must exist.',
        'option_text.required' => 'Option text is required.',
        'option_text.max' => 'Option text must not exceed 500 characters.',
        'is_correct.required' => 'Correctness flag is required.',
        'is_correct.boolean' => 'Correctness must be true or false.',
    ];
}
}
