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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date|before_or_equal:' . now()->subYears(21)->format('Y-m-d'),
            'mobile_no' => 'required|string|max:15',
            'address' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string|max:10',
            'marital_status' => 'required|string|in:married,unmarried',
            'wedding_date' => 'nullable|date',
            'hobbies' => 'array',
            'hobbies.*' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',

            // Define validation rules for family members using the array validation rule
            // 'family_name.*' => 'required|string|max:255',
            // 'family_birthdate.*' => 'required|date',
            // 'family_marital_status.*' => 'required|string',
            // 'family_wedding_date.*' => 'nullable|date',
            // 'family_education.*' => 'nullable|string',
            // 'family_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
