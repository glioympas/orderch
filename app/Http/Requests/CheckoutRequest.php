<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $rules = [];

        if(!auth()->check()) {
            $rules['account_email'] = 'required|string|email|unique:users,email';
            $rules['account_password'] = 'required|string|min:6|max:16';
        }

        return array_merge($rules, [
            'street_address' => 'required|string',
            'country'  => 'required|string',
            'city'  => 'required|string',
            'contact_phone'  => 'required|string',
            'contact_email'  => 'required|string|email'
        ]);
    }
}
