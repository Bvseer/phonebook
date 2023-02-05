<?php

namespace App\Http\Requests\Panel\UserController;

use App\Services\API\BaseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteRequest extends FormRequest
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
            'id' => ['required', 'integer', 'exists:contacts,id'],
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'not found',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $error = $validator->errors();
        throw new HttpResponseException(
            BaseService::sendError(reset($error), [], 400)
        );
    }
}
