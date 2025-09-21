<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
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
        'issued_at' => 'required|date',
        'certificate_url' => 'nullable|url',
    ];
}
public function messages(): array
{
    return [
        'user_id.required' => 'User is required.',
        'user_id.exists' => 'The selected user does not exist.',

        'track_id.required' => 'Track is required.',
        'track_id.exists' => 'The selected track does not exist.',

        'issued_at.required' => 'Issue date is required.',
        'issued_at.date' => 'Issue date must be a valid date.',

        'certificate_url.url' => 'Certificate URL must be a valid link.',
    ];
}
}
