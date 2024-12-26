<?php

namespace App\Http\Requests\Crm\City;

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
            'name_ru' => ['required', 'string', Rule::unique('cities')->ignore($this->city)],
            'name_en' => ['required', 'string', Rule::unique('cities')->ignore($this->city)],
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
            'name_ru.required' => 'Поле "Название на русском" обязательное!',
            'name_en.required' => 'Поле "Название на английском" обязательное!',
            'name_ru.string' => 'Поле "Название на русском" должно быть строкой!',
            'name_en.string' => 'Поле "Название на английском" должно быть строкой!',
            'name_ru.unique' => 'Поле "Название на русском" должно быть уникальным!',
            'name_en.unique' => 'Поле "Название на английском" должно быть уникальным!',
        ];
    }
}
