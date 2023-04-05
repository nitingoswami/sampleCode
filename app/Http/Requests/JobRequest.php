<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseBuilder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    use ApiResponseBuilder;

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
            'jobs_file' => 'file|min:100|max:15000|required_without:jobs_url',
            'jobs_url' => 'required_without:jobs_file',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag();

        return $this->failure('validation error', $errors);
    }
}
