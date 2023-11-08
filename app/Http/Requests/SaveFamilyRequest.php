<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFamilyRequest extends FormRequest
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
            'Surname' => 'required|string|max:255',
            'Birthdate' => 'required|date|before_or_equal:' . now()->subYears(21)->format('Y-m-d'),
            'MobileNo' => 'required|string|max:15',
            'Address' => 'required|string',
            'State' => 'required|string',
            'City' => 'required|string',
            'Pincode' => 'required|string|max:10',
            'MaritalStatus' => 'required|string|in:married,unmarried',
            'WeddingDate' => 'nullable|date',
            'Hobbies' => 'array',
            'Hobbies.*' => 'nullable|string|max:255',
            'Photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}
