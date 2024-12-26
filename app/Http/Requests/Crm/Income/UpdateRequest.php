<?php

namespace App\Http\Requests\Crm\Income;

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
        $input = $this->all();
        $input['sum'] = str_replace(' ', '', $input['sum']);
        $input['date'] = date('Y-m-d', strtotime($input['date']));
        $this->replace($input);

        return [
            'type_id' => 'required|integer',
            'sum' => 'required|integer',
            'date' => 'required|date',
            'comment' => 'nullable|string',
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
            'type_id.required' => 'Поле "Тип прихода" обязательное!',
            'type_id.integer' => 'Поле "Тип прихода" обязательное!',
            'sum.required' => 'Поле "Сумма" обязательное!',
            'sum.integer' => 'Поле "Сумма" должно быть числом!',
            'date.required' => 'Поле "Дата" обязательное!',
            'date.date' => 'Поле "Дата" должно быть датой!',
            'comment.string' => 'Поле "Комментарий" должно быть строкой!',
        ];
    }
}
