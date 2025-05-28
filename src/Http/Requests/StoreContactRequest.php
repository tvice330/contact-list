<?php

namespace Tvice\ContactList\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreContactRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phones' => 'required|array|min:1',
            'phones.*' => 'required|string|distinct|regex:/^\+?[0-9\s\-\(\)]{7,20}$/|unique:phones,number',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required'    => __('First name is required.'),
            'first_name.string'      => __('First name must be a valid string.'),
            'first_name.max'         => __('First name may not be greater than 255 characters.'),

            'last_name.required'     => __('Last name is required.'),
            'last_name.string'       => __('Last name must be a valid string.'),
            'last_name.max'          => __('Last name may not be greater than 255 characters.'),

            'phones.required'        => __('At least one phone number is required.'),
            'phones.array'           => __('Phones must be an array.'),
            'phones.min'             => __('At least one phone number must be provided.'),

            'phones.*.required'      => __('Each phone number is required.'),
            'phones.*.string'        => __('Each phone number must be a valid string.'),
            'phones.*.distinct'      => __('Phone numbers must be unique.'),
            'phones.*.regex' => __(
                'Each phone number must be in a valid format (7-20 digits, may include +, spaces, dashes, and parentheses).'
            ),
            'phones.*.unique'        => __('This phone number is already in use.'),
        ];
    }
}