<?php

namespace App\Http\Requests;

use App\Helper\RedirectHelper as R;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'event_name' => 'required|string',
            'event_date' => 'required',
            'event_start' => 'required|string',
            'event_end' => 'required|string',
            'event_place' => 'required|string',
            'event_description' => 'nullable|string',
            'event_type' => 'required|in:1,0',
            'event_note' => 'nullable|string',
            'member_id' => 'nullable|array',
        ];
    }
}
