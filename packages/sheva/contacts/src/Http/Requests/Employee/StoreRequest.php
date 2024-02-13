<?php

namespace Sheva\Contacts\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'phones' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Ім\'я" є обов\'язковим.',
            'name.string' => 'Поле "Ім\'я" повинно бути рядком.',
            'surname.required' => 'Поле "Прізвище" є обов\'язковим.',
            'surname.string' => 'Поле "Прізвище" повинно бути рядком.',
            'phones.required' => 'Поле "Телефон" є обов\'язковим.',
            'phones.array' => 'Поле "Телефон" повинно бути масивом.',
        ];
    }
}
