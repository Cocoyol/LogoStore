<?php

namespace LogoStore\Http\Requests;

use LogoStore\Http\Requests\Request;

class CreateRequirementsLogoRequest extends Request
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
            'company' => 'required|max:255',
            'secondaryText' => 'required'
        ];
    }
}
