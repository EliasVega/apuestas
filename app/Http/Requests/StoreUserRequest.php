<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [

            'name'        => ['required', 'string', 'max:50'],
            'number'      => ['required', 'string', 'max:20'],
            'email'       => 'required|email|unique:users,email,'.$this->user->id,'|max:100',
            'password'    => ['required', 'string', 'min:6', 'confirmed'],
            'status'       => 'in:active,inactive',
            'roles'       => 'required'
        ];
    }
}
