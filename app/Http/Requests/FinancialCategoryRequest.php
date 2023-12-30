<?php

namespace App\Http\Requests;

use App\Helper\RedirectHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FinancialCategoryRequest extends FormRequest
{

    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data not valid, error: ' . implode(' ', $error));
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
            'category_name' => 'required|string|max:255',
        ];
    }
}
