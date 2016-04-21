<?php

namespace LogoStore\Http\Requests;

use LogoStore\Http\Requests\Request;

class CreateLogoRequest extends Request
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
            'code' => 'required|max:255',
            'date' => 'required|date',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:disponible,vendido',
            'category_id' => 'integer|exists:categories,id'
        ];
    }
}
