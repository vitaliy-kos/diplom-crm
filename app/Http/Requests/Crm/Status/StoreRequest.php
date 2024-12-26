<?php

namespace App\Http\Requests\Crm\Status;

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
            'name' => 'required|string|unique:statuses',
            'menu_title' => 'required|string',
            'action_title' => 'required|string',
            'color' => 'required|string',
            'icon' => 'required|string',
            'order' => 'required|integer|gt:0',
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
            'name.unique' => 'Поле "Название" уникальным!',
            'menu_title.required' => 'Поле "Заголовок меню" уникальным!',
            'menu_title.string' => 'Поле "Заголовок меню" уникальным!',
            'action_title.required' => 'Поле "Название действия" уникальным!',
            'action_title.string' => 'Поле "Название действия" уникальным!',
            'color.string' => 'Поле "Цвет" обязательное!',
            'icon.required' => 'Поле "Иконка" обязательное!',
            'order.integer' => 'В поле "Порядок вывода" должно быть число!',
            'order.gt' => '"Порядок вывода" должен быть больше нуля!',
        ];
    }
}
