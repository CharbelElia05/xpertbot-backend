<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseProgressRequest extends FormRequest
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
        'course_id' => 'required|exists:courses,id',
        'completed_at' => 'nullable|date',
    ];
}
public function messages(): array
{
    return [
        'user_id.required' => 'User is required.',
        'user_id.exists' => 'User must exist.',
        'course_id.required' => 'Course is required.',
        'course_id.exists' => 'Course must exist.',
        'completed_at.date' => 'Completion date must be a valid date.',
    ];
}
}
