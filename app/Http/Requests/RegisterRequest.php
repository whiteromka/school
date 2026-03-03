<?php

namespace App\Http\Requests;

use App\Services\PasswordGeneratorService;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    protected $errorBag = 'default';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:3'],
        ];
    }

    public function credentials(): array
    {
        $password = (new PasswordGeneratorService())->hash($this->input('password'));
        return [
            'name' => $this->input('name'),
            'last_name' => $this->input('last_name'),
            'email' => $this->input('email'),
            'password' => $password,
            'password_verified' => 1
        ];
    }
}
