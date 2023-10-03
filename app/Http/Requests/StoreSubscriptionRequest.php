<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    /*
        if(auth()->user()){
            return true;
        } else {
            return false;
        }
    */
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
            'clientToken' => 'required|string',
            'paymentMethodNonce' => 'required|string',
            'plan_id' => 'required|exists:App\Models\Plan,id',
            'addons' => 'sometimes',
            'discounts' => 'sometimes'
        ];
    }
}
