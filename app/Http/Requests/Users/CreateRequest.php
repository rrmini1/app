<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
            'name'       => 'required|string|between:2,255',
            'last_name'  => 'required|string|between:2,255',
            'email'      => 'required|string|email|max:50|'. Rule::unique('users')->ignore($this->user),
            'phone'      => 'required|string|between:10,15',
            'password'   => 'required|string|min:8|confirmed',
        ];
    }
}
