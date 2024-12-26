<?php

namespace App\Http\Requests\Crm\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => ['required', 'string', 'email',  Rule::unique('users')->ignore($this->user)],
            'password' => 'required|string',
            'role' => 'required|integer',
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
            'name.required' => 'Поле "Имя" обязательное!',
            'name.string' => 'Поле "Имя" должно быть строкой!',
            'email.unique' => 'Поле "Email" должно быть уникальным!',
            'role.integer' => 'Выберите права пользователя!',
            'role.required' => 'Выберите права пользователя!',
        ];
    }
}
