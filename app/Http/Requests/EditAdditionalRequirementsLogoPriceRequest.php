<?php

namespace LogoStore\Http\Requests;

use LogoStore\Http\Requests\Request;

class EditAdditionalRequirementsLogoPriceRequest extends Request
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
            'text' => 'required|max:255',
            'price' => 'required|numeric'
        ];
    }
}