<?php

namespace App\Http\Requests\Auth\Api;

use App\Models\TeamUserCodes;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'code' => ['required', 'string', 'exists:' . TeamUserCodes::class . ',code'],
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'phone' => ['required', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'number' => ['required', 'integer'],
            'picture' => 'image|mimes:jpeg,png,jpg',
        ];
    }
}

