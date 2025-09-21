<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrackRequest extends FormRequest
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
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'instructor_id' => 'required|exists:users,id',
    ];
}

public function messages(): array
{
    return [
        'title.required' => 'Track title is required.',
        'title.string' => 'Track title must be a string.',
        'title.max' => 'Track title must not exceed 255 characters.',

        'description.string' => 'Description must be a string.',

        'instructor_id.required' => 'Instructor is required.',
        'instructor_id.exists' => 'The selected instructor does not exist.',
    ];
}
}
