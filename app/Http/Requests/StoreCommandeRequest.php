<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client' => 'required|string|max:150',
            'total' => 'required|numeric|min:0',
            'date_commande' => 'required|date',
        ];
    }
}
