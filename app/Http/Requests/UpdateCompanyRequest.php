<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required|max:45',
            'code' => 'required|max:4',
            'nit' => 'required|max:20',
            'dv' => 'required|max:1',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:12',
            'email' => 'required',
            'imageName' => '',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'in:activo,inactivo',
            'department_id' => 'required',
            'municipality_id' => 'required'
        ];
    }
}
