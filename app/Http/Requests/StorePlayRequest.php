<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayRequest extends FormRequest
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
            'total' => 'required|numeric',
            'pay' => '',
            'date' => 'required|date',
            'payment_form' => 'in:contado,credito',
            'payment_method' => 'in:efectivo,nequi',
            'lottery_id' => 'required'
        ];
    }
}
