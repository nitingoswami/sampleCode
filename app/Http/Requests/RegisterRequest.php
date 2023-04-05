<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseBuilder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|unique:users,email,except,id',
            'password' => 'required|min:4|max:15',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->getMessageBag();

        return $this->failure('validation error', $errors);
    }
}
