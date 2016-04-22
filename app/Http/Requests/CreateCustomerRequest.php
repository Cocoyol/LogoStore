<?php

namespace LogoStore\Http\Requests\Customer;

use LogoStore\Http\Requests\Request;

class CreateCustomerRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:customers',
            'phone' => 'required|max:255'
        ];
    }
}
