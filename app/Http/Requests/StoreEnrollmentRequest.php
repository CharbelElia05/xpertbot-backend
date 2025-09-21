<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
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
        'track_id' => 'required|exists:tracks,id',
        'current_course_id' => 'nullable|exists:courses,id',
        'enrolled_at' => 'required|date',
        'completed_at' => 'nullable|date|after_or_equal:enrolled_at',
    ];
}
public function messages(): array
{
    return [
        'user_id.required' => 'User is required.',
        'user_id.exists' => 'The selected user does not exist.',

        'track_id.required' => 'Track is required.',
        'track_id.exists' => 'The selected track does not exist.',

        'current_course_id.exists' => 'The selected course does not exist.',

        'enrolled_at.required' => 'Enrollment date is required.',
        'enrolled_at.date' => 'Enrollment date must be a valid date.',

        'completed_at.date' => 'Completion date must be a valid date.',
        'completed_at.after_or_equal' => 'Completion date cannot be before enrollment date.',
    ];
}
}
