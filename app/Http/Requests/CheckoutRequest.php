<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_email' => [
                'required',
                'email',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:20',
            ],

            'shipping_address_line_1' => [
                'required',
                'string',
                'max:255',
            ],

            'shipping_address_line_2' => [
                'nullable',
                'string',
                'max:255',
            ],

            'shipping_city' => [
                'required',
                'string',
                'max:100',
            ],

            'shipping_state' => [
                'required',
                'string',
                'max:100',
            ],

            'shipping_postal_code' => [
                'required',
                'string',
                'max:20',
            ],

            'shipping_country' => [
                'required',
                'string',
                'max:100',
            ],

            'payment_method' => [
                'required',
                'in:cod,razorpay',
            ],
        ];
    }
}