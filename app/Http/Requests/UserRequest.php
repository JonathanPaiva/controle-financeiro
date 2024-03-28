<?php

namespace App\Http\Requests;

use App\Traits\HttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{

    use HttpResponses;
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
        $rules = [
            'name' => [
                'required',
                'min:3',
                'max:255'
            ],
            'email' => [
                'required',
                Rule::unique('users')
            ],
            'password' => [
                'required'
            ]
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator) {

        $errors = $validator->errors()->toArray();

        $responseError = $this->errorResponse('Data Invalid',422, $errors);

        throw new HttpResponseException($responseError);
    }
}
