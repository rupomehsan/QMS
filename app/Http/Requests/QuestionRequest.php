<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;



class QuestionRequest extends FormRequest
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
            'subject_id' => 'sometimes|required',
            'question'       => 'sometimes|required',
            'options'     => 'sometimes|array',
            'answer'    => 'sometimes',
            'status'      => 'sometimes',
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
