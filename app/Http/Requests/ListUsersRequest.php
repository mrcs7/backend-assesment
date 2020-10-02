<?php

namespace App\Http\Requests;

use App\ParentAp\Enums\DataProvidersEnum;
use App\ParentAp\Enums\StatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ListUsersRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'provider'=>[Rule::in(DataProvidersEnum::getConstList())],
            'balanceMin'=>'integer',
            'balanceMax'=>'integer',
            'status'=>[Rule::in(StatusEnum::getConstList())],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(validationErrors($validator->errors()->all()));
        }
    }
}
