<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'address' => ['required', 'string', 'max:255'],  // New rule for address
            'postalCode' => ['required', 'string', 'max:10'],  // New rule for postalCode
            'city' => ['required', 'string', 'max:255'],  // New rule for city
            'description' => ['string', 'max:300', 'nullable'], // Nullable
            'phone_number' => ['nullable', 'regex:/french_phone_regex/', 'unique:users'],
            'gender' => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            // Profile picture validation will be exec separately during the upload process.
        ];
    }    
}
