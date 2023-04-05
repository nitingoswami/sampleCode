<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseBuilder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class addEducationRequest extends FormRequest
{
    use ApiResponseBuilder;

    /**
     * Applicant searching Request .
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
            'school' => 'required',
            'start_date' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag();

        return $this->failure('validation error', $errors);
    }
}
