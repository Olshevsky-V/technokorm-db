<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Разрешаем все запросы (можно добавить авторизацию)
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'categories' => 'sometimes|array',
            'tags' => 'sometimes|array',
            'image' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
        ];
    }
}