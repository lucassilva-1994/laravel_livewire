<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRquest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required| min:3',
            'email' => 'required|email|unique:users'
        ];
    }
}
