<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
        'track_id' => 'required|exists:tracks,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration' => 'required|integer|min:1',
        'order' => 'required|integer|min:1',
    ];
}

public function messages(): array
{
    return [
        'track_id.required' => 'Track is required.',
        'track_id.exists' => 'The selected track does not exist.',
        
        'title.required' => 'Course title is required.',
        'title.string' => 'Course title must be a string.',
        'title.max' => 'Course title must not exceed 255 characters.',
        
        'description.string' => 'Description must be a string.',
        
        'duration.required' => 'Course duration is required.',
        'duration.integer' => 'Duration must be a number.',
        'duration.min' => 'Duration must be at least 1 minute.',
        
        'order.required' => 'Course order is required.',
        'order.integer' => 'Order must be a number.',
        'order.min' => 'Order must be at least 1.',
    ];
}
}
