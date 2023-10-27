<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],  // New rule for surname
            'address' => ['required', 'string', 'max:255'],  // New rule for address
            'postal_code' => ['required', 'string', 'max:10'],  // New rule for postal_code
            'city' => ['required', 'string', 'max:255'],  // New rule for city
            'description' => ['string', 'max:300', 'nullable'], // Nullable
            'phone_number' => ['nullable', 'regex:/french_phone_regex/', 'unique:users'],
            'gender' => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            // Profile picture validation will be exec separately during the upload process.
        ];
    }    
}
