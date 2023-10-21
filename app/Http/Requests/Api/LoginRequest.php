<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiFailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ApiFailedValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|string|exists:users',
            'password' => 'required|string',
        ];
    }
}
