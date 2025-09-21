<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
        'quiz_id' => 'required|exists:quizzes,id',
        'question_text' => 'required|string|max:1000',
    ];
}
public function messages(): array
{
    return [
        'quiz_id.required' => 'Quiz is required.',
        'quiz_id.exists' => 'Quiz must exist.',
        'question_text.required' => 'Question text is required.',
        'question_text.max' => 'Question text must not exceed 1000 characters.',
    ];
}
}
