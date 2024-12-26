<?php

namespace App\Http\Requests\Crm\Client;

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
        $input['client']['phone'] = intval(preg_replace( '/[^0-9]/', '', $input['client']['phone'] ));
        $input['client']['additional_phone'] = intval(preg_replace( '/[^0-9]/', '', $input['client']['additional_phone'] ));
        $input['client']['city_id'] = $input['client']['city_id'] == "Не выбран" ? null : $input['client']['city_id'];
        $this->replace($input);

        return [
            'client.last_name' => 'nullable|string',
            'client.first_name' => 'nullable|string',
            'client.middle_name' => 'nullable|string',
            'client.city_id' => 'nullable|integer',
            'client.phone' => 'required|integer',
            'client.additional_phone' => 'nullable|integer',
            'client.comment' => 'nullable|string',
            'address.metro_station_id' => 'nullable|integer',
            'address.street' => 'nullable|string',
            'address.home' => 'nullable|string',
            'address.entrance' => 'nullable|string',
            'address.flat' => 'nullable|string',
            'address.floor' => 'nullable|string',
            'address.code' => 'nullable|string',
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
            'partner_id.integer' => 'Поле "Партнер" должно содержать ID партнера!',
            'sum.required' => 'Поле "Сумма" обязательное!',
            'sum.integer' => 'Поле "Сумма" должно быть числом!',
            'date.required' => 'Поле "Дата" обязательное!',
            'date.date' => 'Поле "Дата" должно быть датой!',
            'comment.string' => 'Поле "Комментарий" должно быть строкой!',
        ];
    }
}
