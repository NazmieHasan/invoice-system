<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name'      => ['required', 'string', 'max:255'],
            'customer_email'     => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'line_items_and_qty' => ['required', 'string', 'max:255'],
        ];
    }
}