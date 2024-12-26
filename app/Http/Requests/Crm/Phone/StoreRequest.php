<?php

namespace App\Http\Requests\Crm\Phone;

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
        $input = $this->all();
        $input['number'] = getOnlyNumbers($input['number']);
        $this->replace($input);

        return [
            'number' => 'required|integer|unique:phones',
            'site_id' => 'required|integer',
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
        ];
    }
}
