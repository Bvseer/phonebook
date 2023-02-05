<?php

namespace App\Http\Requests\Web\ContactController;

use App\Services\API\BaseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'contact_id' => ['required', 'integer', Rule::exists('contacts', 'id')->where('user_id', Auth::user()->getAuthIdentifier())],
        ];
    }

    public function messages()
    {
        return [
            'contact_id.exists' => 'not found',
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
