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
            'store_email' => 'required|email',
            'store_phone' => 'required',
            'address_city' => 'required',
            'address_county' => 'required',
            'address_postcode' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'nullable',
            'store_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust maximum file size as needed
        ];
        
    }
}
