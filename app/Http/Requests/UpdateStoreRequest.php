<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'store_name' => 'required',
        'store_email' => 'required|email',
        'store_phone' => 'required',
        'address_city' => 'required',
        'address_county' => 'required',
        'next_invoice_number' => 'required|numeric',
        'address_postcode' => 'required',
        'address_line_1' => 'required',
        'address_line_2' => 'nullable',
        'store_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust maximum file size as needed
        ];
    }
}
