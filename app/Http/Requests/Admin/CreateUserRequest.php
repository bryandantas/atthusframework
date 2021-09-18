<?php

namespace App\Http\Requests\Admin;

use App\Enums\PermissionType;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionType::MANAGE_USERS);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo é obrigatório',
            'email.required' => 'Este campo é obrigatório',
            'email.email' => 'Este campo deve ser um email válido',
            'email.unique' => 'Este email já está cadastrado'
        ];
    }
}
