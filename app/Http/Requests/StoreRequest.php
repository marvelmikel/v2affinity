<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'store_name' => 'required',
            'store_logo' => 'required|image|max:2048',
            'store_phone' => 'required',
            'store_email' => 'required|email',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'address_city' => 'required',
            'address_county' => 'required',
            'address_postcode' => 'required',
        ];
    }
}
