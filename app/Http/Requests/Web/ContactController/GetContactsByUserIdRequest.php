<?php

namespace App\Http\Requests\Web\ContactController;

use App\Services\API\BaseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetContactsByUserIdRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:contacts,user_id']
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'no contact found by user_id ' . $this->user_id,
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->get('user_id');
        throw new HttpResponseException(
            BaseService::sendError(reset($error), [], 400)
        );
    }
}
