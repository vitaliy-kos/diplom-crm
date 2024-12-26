<?php

namespace App\Http\Requests\Crm\Client;

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
        $input['phone'] = intval(preg_replace( '/[^0-9]/', '', $input['phone'] ));
        $input['additional_phone'] = intval(preg_replace( '/[^0-9]/', '', $input['additional_phone'] ));
        $input['city_id'] = $input['city_id'] == "Не выбран" ? null : $input['city_id'];
        $this->replace($input);


        return [
            'last_name' => 'nullable|string',
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'city_id' => 'nullable|integer',
            'phone' => 'required|integer',
            'additional_phone' => 'nullable|integer',
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
            // 'type_id.required' => 'Поле "Тип прихода" обязательное!',
        ];
    }
}
