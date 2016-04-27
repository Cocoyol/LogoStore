<?php

namespace LogoStore\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use LogoStore\Http\Requests\Request;

class CreateImagesLogoRequest extends Request
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
            /*'name' => 'max:255',
            'images' => 'required|image'*/
        ];
    }
}
