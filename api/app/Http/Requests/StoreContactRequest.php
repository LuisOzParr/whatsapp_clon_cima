<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|numeric|digits:10|exists:users,phone_number',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('nombre'),
            'phone_number' => __('número de teléfono'),
        ];
    }

    public function messages()
    {
        return [
            'phone_number.exists' => 'El :attribute no esta registrado en '.config('app.name'),
        ];
    }
}
