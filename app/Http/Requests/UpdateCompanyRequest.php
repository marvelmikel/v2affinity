<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone' => 'required',
            'company_email' => 'required',
            'company_number' => 'required',
            'vat_number' => 'required',
            'terms_conditions' => 'required',
        ];
    }
}
