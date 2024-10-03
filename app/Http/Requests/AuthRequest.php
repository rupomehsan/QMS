<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {



        return [
            'user_name' => 'sometimes|required',
            'email' => 'sometimes|required|email:rfc,dns|unique:users,email,' . $this->id,
            'phone'       => 'sometimes|required|max:11',
            'password'       => $this->isMethod('patch') ? 'sometimes' : 'required|string|min:6',
            'confirm_password'       => 'sometimes|required_with:password|same:password',
            'status'       => 'sometimes|required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException(validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }
}
