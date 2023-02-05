<?php

namespace App\Http\Requests\Auth\RegisterController;

use App\Services\API\BaseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
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
            'surname' => ['required', 'string'],
            'patronymic' => ['required', 'string'],
            'name' => ['required', 'string', Rule::unique('users', 'name')->where(function ($q) {
                return $q->where(['surname' => $this->surname, 'patronymic' => $this->patronymic]);
            })],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'c_password' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'fullname has already been taken'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            BaseService::sendError('validation error', $validator->errors()->messages(), 400)
        );
    }
}
