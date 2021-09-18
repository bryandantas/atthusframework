<?php

namespace App\Http\Requests\Admin;

use App\Enums\PermissionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->id() === (int) $this->route('id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:1',
            'newPassword' =>'required|same:confirmPassword|different:password|min:8',
            'confirmPassword' =>'required|same:newPassword|different:password|min:8'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Este campo é obrigatório',
            'email.email' => 'Este campo deve ser um email válido',
            'email.unique' => 'Este email já está cadastrado',
            '*.min' => 'A senha precisa ter pelo menos :min caracteres',
            '*.same' => 'A nova senha e a confirmação precisam combinar',
            '*.different' => 'A nova senha precisa ser diferente da atual'
        ];
    }
}
