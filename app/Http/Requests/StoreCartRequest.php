<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer'],
        ];
    }
}
