<?php

namespace App\Http\Requests;

use App\Traits\HttpResponses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DespesaRequest extends FormRequest
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
            'descricao' => [
                'required', 
                'min:3', 
                'max:255'
            ],
            'valor' => [
                'required',
                'numeric'
            ],
            'data' => [
                'required',
                'date'
            ],
            'categoria' =>[
                'nullable',
                Rule::in(['Alimentação', 'Saúde', 'Moradia',         
                'Transporte', 'Educação', 'Lazer', 'Imprevistos',
                'Outras', ''])
            ],
            'grupo' =>[
                'required',
                Rule::in(['Fixa', 'Variável'])
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
