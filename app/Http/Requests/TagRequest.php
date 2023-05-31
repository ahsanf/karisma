<?php

namespace App\Http\Requests;

use App\Helper\RedirectHelper as R;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return R::redirectBackStatus('warning', 'Data not valid, error: ' . implode(' ', $error));
        }

    }
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
            'tag_name' => 'required|string'
        ];
    }
}
