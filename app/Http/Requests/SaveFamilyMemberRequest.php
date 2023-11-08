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
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'marital_status' => 'required|string|in:married,unmarried',
            'wedding_date' => 'nullable|date',
            'education' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}
