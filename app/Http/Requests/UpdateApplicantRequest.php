<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseBuilder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
{
    use ApiResponseBuilder;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user()->id,
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag();

        return $this->failure('validation error', $errors);
    }
}
