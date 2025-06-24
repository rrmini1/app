<?php

namespace App\Http\Requests\Stage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:155',
            'content' => 'required|string',
            'start' => 'required|date|date_format:Y-m-d',
            'finish' => 'required|date|date_format:Y-m-d|after_or_equal:start',
            'price' => 'required|numeric|digits_between:1,10',
            'pay_status' => 'sometimes|accepted',
            'work_status' => 'required|in:on the go,completed',
        ];
    }
}
