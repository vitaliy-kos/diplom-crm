<?php

namespace App\Http\Requests\Crm\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                "required",
                "string",
                Rule::unique('sites')->ignore($this->site)
            ],
            'url' => [
                "required",
                "string",
                Rule::unique('sites')->ignore($this->site)
            ]
        ];
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название" обязательное!',
            'name.string' => 'Поле "Название" должно быть строкой!',
            'name.unique' => 'Поле "Название" должно быть уникальным!',
            'url.required' => 'Поле "url" обязательное!',
            'url.string' => 'Поле "url" должно быть строкой!',
            'url.unique' => 'Поле "url" должно быть уникальным!',
        ];
    }
}
