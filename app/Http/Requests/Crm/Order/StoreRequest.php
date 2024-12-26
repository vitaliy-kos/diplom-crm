<?php

namespace App\Http\Requests\Crm\Order;

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
        $input = $this->all();
        $input['date_creation'] = date('Y-m-d H:i:s', strtotime($input['date_creation']));
        $this->replace($input);

        return [
            'client_id' => 'required|integer',
            'date_creation' => 'required|string',
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
        ];
    }
}
