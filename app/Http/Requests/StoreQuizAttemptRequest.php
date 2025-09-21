<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizAttemptRequest extends FormRequest
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
        'user_id' => 'required|exists:users,id',
        'quiz_id' => 'required|exists:quizzes,id',
        'score' => 'required|integer|min:0|max:100',
        'passed' => 'required|boolean',
        'attempted_at' => 'required|date',
    ];
}
public function messages(): array
{
    return [
        'user_id.required' => 'User is required.',
        'user_id.exists' => 'The selected user does not exist.',

        'quiz_id.required' => 'Quiz is required.',
        'quiz_id.exists' => 'The selected quiz does not exist.',

        'score.required' => 'Score is required.',
        'score.integer' => 'Score must be a number.',
        'score.min' => 'Score must be at least 0.',
        'score.max' => 'Score must not exceed 100.',

        'passed.required' => 'Pass status is required.',
        'passed.boolean' => 'Pass status must be true or false.',

        'attempted_at.required' => 'Attempt date is required.',
        'attempted_at.date' => 'Attempt date must be a valid date.',
    ];
}
}
