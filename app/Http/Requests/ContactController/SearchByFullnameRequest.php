<?php

namespace App\Http\Requests\ContactController;

use App\Services\API\BaseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchByFullnameRequest extends FormRequest
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
            'name' => ['string', 'required_without_all:surname,patronymic'],
            'surname' => ['string', 'required_without_all:name,patronymic'],
            'patronymic' => ['string', 'required_without_all:name,surname'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            BaseService::sendError('validation error', $validator->errors()->messages(), 400)
        );
    }
}
