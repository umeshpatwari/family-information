<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFamilyMemberRequest extends FormRequest
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
            'Name' => 'required|string|max:255',
            'Birthdate' => 'required|date',
            'MaritalStatus' => 'required|string|in:married,unmarried',
            'WeddingDate' => 'nullable|date',
            'Education' => 'nullable|string',
            'Photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}
